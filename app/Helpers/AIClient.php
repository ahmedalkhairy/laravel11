<?php

namespace App\Helpers;

use App\Models\AIRequest;
use App\Models\User;
use DateTime;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

const CONTROLLER_HEART_BEAT_EXPIRATION = 30;
const  WORKER_HEART_BEAT_INTERVAL = 15;

const LOGDIR = ".";

# Model Constants
const IGNORE_INDEX = -100;
const IMAGE_TOKEN_INDEX = -200;
const DEFAULT_IMAGE_TOKEN = "<image>";
const DEFAULT_IMAGE_PATCH_TOKEN = "<im_patch>";
const DEFAULT_IM_START_TOKEN = "<im_start>";
const DEFAULT_IM_END_TOKEN = "<im_end>";
const temperature = 0.2;
const top_p = 0.7;
const max_new_tokens = 1024;
const HEADERS = ["User-Agent" => "LLaVA Client"];


const SEP = "###";
const SEP2 = null;

class AIClient
{

    public function send($prompt, $image, $model_name, $controller_url, $worker_addr, $request, $instance)
    {
        $state = ConvTemplates::conv_llava_llama_2();


        $message = "<<SYS>>\n" . $state->system . "\n<</SYS>>\n\n";

        $message .= '<image>\n' . $prompt->value;
        $message = "[INST] " . $message . " [/INST]";

        $returnPil = false;
        $hash = md5($image);


        $image_new_path = Helpers::prepareImage($hash, $image, $returnPil);

        $decoded_image = (new Helpers)->decode_image($image_new_path);


        $sepStyle = SeparatorStyle::LLAMA_2;
//            "images" => "List of 1 images: ['{$hash}']",
        // Make requests

        $pload = [
            "model" => $model_name,
            "prompt" => $message,
            "temperature" => (float)temperature,
            "top_p" => (float)top_p,
            "max_new_tokens" => min((int)max_new_tokens, 1536),
            "stop" => $state->sep2,
        ];
        //     echo "==== request ====\n" . json_encode($pload, JSON_PRETTY_PRINT) . "\n";

        $pload['images'] = [$decoded_image];


        $headers = [
            'User-Agent: LLaVA Client',
            'Content-Type: application/json',
            // ... add more headers as needed
        ];

        $jsonBody = json_encode($pload);

        $request->request = $jsonBody;
        $request->start_execution_time = now();
        $request->save();


        // Define the endpoint, headers, and payload
        $url = $instance->ip . ':' . $controller_url . '/worker_generate_stream';  // Assuming $worker_addr is defined
        $headersArray = $headers;
        $dataString = $jsonBody;

// Initialize cURL session
        $ch = curl_init();


// Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headersArray);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 2334220);
        curl_setopt($ch, CURLOPT_VERBOSE, false);  // Enable verbose output // Enable verbose output

// Execute cURL session and get the response


// Buffer to hold the data
        $buffer = '';

// Set the write function to handle streaming data
        curl_setopt($ch, CURLOPT_WRITEFUNCTION, function ($ch, $chunk) use (&$buffer) {
            $buffer .= $chunk;

            // Check for a delimiter (e.g., newline for line-delimited JSON)
            while (($pos = strpos($buffer, "\n")) !== false) {
                // Extract one complete line
                $line = substr($buffer, 0, $pos);

                // Process the line (e.g., decode the JSON)
                $data = json_decode($line, true);
                if ($data !== null) {
                    // Do something with the data
                    print_r($data);
                }

                // Remove the processed line from the buffer
                $buffer = substr($buffer, $pos + 1);
            }

            return strlen($chunk);
        });

        $response = curl_exec($ch);

// Check for cURL errors
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch) . "\n";
        }

// Check the HTTP status code
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($httpCode !== 200) {
            echo "There was an issue with the request.\n";
        }

        $request->response = $buffer;
        $request->status = 'success';
        $request->end_execution_time = now();
        $request->save();


        // Close the cURL session
        curl_close($ch);

        return $buffer;

    }


}
