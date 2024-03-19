<?php

namespace App\Helpers;

use App\Models\Server;
use Illuminate\Support\Facades\Log;

class Vast
{
    function search_offers($gpu_name, $min_disk, $num_gpus, $min_mem)
    {
//        $cmd = "vastai search offers gpu_name=$gpu_name num_gpus=$num_gpus 'gpu_ram \> $min_mem' 'disk_space \> $min_disk'  2>&1";
        $cmd = 'vastai search offers gpu_name=' . $gpu_name . ' num_gpus=' . $num_gpus . ' "gpu_ram > ' . $min_mem . '" "disk_space > ' . $min_disk . '" 2>&1';
        $output = shell_exec($cmd);
        $output = str_replace('NV Driver', 'NV_Driver', $output);
        $lines = explode("\n", trim($output));
        $data = [];
        foreach ($lines as $line) {
            $fields = explode(" ", $line);
            $cleanedArray = array_filter($fields);
            $data[] = $cleanedArray;
        }
        $keys = $data[0];

        $cleanedKeys = array_values($keys);
        $result = [];

        for ($i = 1; $i < count($data); $i++) {

            $cleanedvalues = array_values($data[$i]);

            $result[] = array_combine($cleanedKeys, $cleanedvalues);
        }
        return $result;
    }

    function find_lowest_price_id($offer_data)
    {

        $lowest_price = 1000;
        $lowest_id = null;

        for ($i = 0; $i < count($offer_data); $i++) {  // Skip the header row
            $price_per_hr = floatval($offer_data[$i]['$/hr']);
            if ($price_per_hr < $lowest_price) {
                $lowest_price = $price_per_hr;
                $lowest_id = $offer_data[$i]['ID'];
            }
        }

        return $lowest_id;

    }


    function create_instance(string $vast_server_id, Server $serverRecord)
    {
        $vast_key = env('VAST_API_KEY');

        ///convert this to sh command file
        $cmd = "vastai create instance $vast_server_id --api-key $vast_key --image nvidia/cuda:12.0.1-devel-ubuntu20.04 --disk {$serverRecord->min_storage} --direct --env \"-e XNAME=SellenvoAi_{$serverRecord->name} -p 10000:10000 -p 40000:40000 -p 7860:7860 -p 22:22\"";

//        $cmd = "vastai create instance $vast_server_id --api-key $vast_key --image nvidia / cuda:12.0.1 - devel - ubuntu20.04--disk {
//        $serverRecord->min_storage} --direct --env \"-e XNAME=SellenvoAi_{$serverRecord->name} -p 10000:10000 -p 40000:40000 -p 7860:7860 -p 22:22\"";
//        dd($cmd);

        $output = shell_exec($cmd);


        activity()->performedOn($serverRecord)->log('instance creation command sent');

        if (str_contains($output, 'failed with error')) {
            activity()->performedOn($serverRecord)->withProperties($output)->log('failed with error');
            Log::error($output);

            return $output;
        }

        $cleanedStr = str_replace(["Started. ", "\n"], "", $output);
        $jsonStr = str_replace("'", '"', $cleanedStr);
        $validJsonStr = str_replace("True", "true", $jsonStr);
        $array = json_decode($validJsonStr, true);

        activity()->performedOn($serverRecord)->withProperties($array)->log('instance creation response');
        return $array;

    }

    function check_instance_status($instance)
    {
        $url = "https://console.vast.ai/api/v0/instances?api_key=" . env('VAST_API_KEY');
        $headers = [
            'Accept' => 'application/json'
        ];

        // Sleep for 20 seconds before checking again
        $response = file_get_contents($url, false, stream_context_create(['http' => ['header' => $headers]]));
        $response_data = json_decode($response, true);


        if (is_array($response_data) && isset($response_data['instances'])) {
            $instances = $response_data['instances'];
            foreach ($instances as $instance_info) {

                if ((string)$instance->vast_id == (string)$instance_info['id']) {
//                    activity()->performedOn($instance)->withProperties($instance_info)->log('instance info response');

                    return $instance_info;

                }
            }
        }

        return null;
    }


    function delete_instance($instance)
    {

        $url = "https://console.vast.ai/api/v0/instances/{$instance->vast_id}/?api_key=" . env('VAST_API_KEY');

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            // Handle error
            echo 'Curl error: ' . curl_error($ch);
        }

        curl_close($ch);

        $res = json_decode($response, true);
        return $res;

    }

    function stop_instance($instance)
    {

//     $url = "https://console.vast.ai/api/v0/instances/{$instance->vast_id}/?api_key=" . env('VAST_API_KEY');
//
//        $ch = curl_init($url);
//        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        $data = '{"state": "rebooting"}';
//
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // Attach the raw data
//        $response = curl_exec($ch);

        $cmd = "vastai stop instance {$instance->vast_id} 2>&1";
        $output = shell_exec($cmd);

//
//
//        if (curl_errno($ch)) {
//            // Handle error
//            echo 'Curl error: ' . curl_error($ch);
//        }
        activity()->performedOn($instance)->withProperties($output)->log('instance stopped');

        return $output;
    }

    function start_instance($instance)
    {

        $url = "https://console.vast.ai/api/v0/instances/{$instance->vast_id}/?api_key=" . env('VAST_API_KEY');

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = '{"state": "running"}';
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // Attach the raw data
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            // Handle error
            echo 'Curl error: ' . curl_error($ch);
        }

        curl_close($ch);

        $res = json_decode($response, true);
        activity()->performedOn($instance)->withProperties($response)->log('instance started');

        return $res;

    }

    public function sync_data(Server $instance)
    {
        activity()->performedOn($instance)->log('start syncing data method on Vast file ');


        $cmd = "ssh -o StrictHostKeyChecking=no -i '" . env('VAST_KEY_PATH') . "' root@" . $instance->ip . " -p " . $instance->ssh_port . " 'pwd' 2>&1";
        $output1 = shell_exec($cmd);
        Log::info($output1);
//        activity()->performedOn($instance)->log($output1);

        sleep(1);

        $copy_command = "scp -i '" . env('VAST_KEY_PATH') . "' -P " . $instance->ssh_port . " /var/www/html/ai_server_scripts/sync_script.sh root@" . $instance->ip . ":/root/sync_script.sh  2>&1";
        $output2 = shell_exec($copy_command);
        Log::info($output2);
        activity()->performedOn($instance)->log($output2);

        sleep(1);
        $copy_command2 = "scp -i '" . env('VAST_KEY_PATH') . "' -P " . $instance->ssh_port . " /var/www/html/ai_server_scripts/sync_data.py root@" . $instance->ip . ":/root/sync_data.py  2>&1";
        $output3 = shell_exec($copy_command2);
        Log::info($output3);
        sleep(1);
        activity()->performedOn($instance)->log($output3);


        $copy_command2 = "ssh -o StrictHostKeyChecking=no -i '" . env('VAST_KEY_PATH') . "' root@" . $instance->ip . " -p " . $instance->ssh_port . " 'chmod +x /root/sync_script.sh' 2>&1";
        $output4 = shell_exec($copy_command2);
        Log::info($output4);
        activity()->performedOn($instance)->log($output4);

        sleep(2);

        $copy_command2 = "ssh -o StrictHostKeyChecking=no -i '" . env('VAST_KEY_PATH') . "' root@" . $instance->ip . " -p " . $instance->ssh_port . " '/bin/bash' './sync_script.sh' 2>&1";
        $output5 = shell_exec($copy_command2);
        Log::info($output5);
        activity()->performedOn($instance)->log($output5);


        $instance->is_syncing = false;
        $instance->moved_data = true;
        $instance->save();
        return 1;


    }


    public function run_model(Server $instance)
    {

        $cmd = "ssh -o StrictHostKeyChecking=no -i '" . env('VAST_KEY_PATH') . "' root@" . $instance->ip . " -p " . $instance->ssh_port . " 'pwd' 2>&1";
        $output1 = shell_exec($cmd);
        Log::info($output1);
        sleep(1);


        $copy_command = "scp -i '" . env('VAST_KEY_PATH') . "' -P " . $instance->ssh_port . " /var/www/html/ai_server_scripts/run_model.sh root@" . $instance->ip . ":/root/run_model.sh  2>&1";
        $output2 = shell_exec($copy_command);
        Log::info($output2);
        sleep(1);

        $copy_command2 = "ssh -o StrictHostKeyChecking=no -i '" . env('VAST_KEY_PATH') . "' root@" . $instance->ip . " -p " . $instance->ssh_port . " 'chmod +x /root/run_model.sh' 2>&1";
        $output4 = shell_exec($copy_command2);
        Log::info($output4);
        sleep(2);

        $copy_command2 = "ssh -o StrictHostKeyChecking=no -i '" . env('VAST_KEY_PATH') . "' root@" . $instance->ip . " -p " . $instance->ssh_port . " '/bin/bash' './run_model.sh' 2>&1";
        $output5 = shell_exec($copy_command2);
        Log::info($output5);

        $instance->is_syncing = false;
        $instance->moved_data = true;
        $instance->save();
        return 1;


    }


}
