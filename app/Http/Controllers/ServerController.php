<?php

namespace App\Http\Controllers;

use App\Enum\ServerStatusEnum;
use App\Helpers\Vast;
use App\Jobs\CreateServerJob;
use App\Jobs\VastAi\CreateInstanceJob;
use App\Jobs\VastAi\RunModelJob;
use App\Jobs\VastAi\StartServer;
use App\Jobs\VastAi\StopServer;
use App\Jobs\VastAi\SyncDataToInstanceJob;
use App\Models\Server;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ServerController extends Controller
{

    public function index(Request $request)
    {
        // Server Status Cases
        $statuses = ServerStatusEnum::cases();
        $data = Server::query()
            ->when(!empty($request['search']), function ($query) use ($request) {
                $query->where('name', 'LIKE', "%{$request['search']}%")
                    ->orWhere('ip', 'LIKE', "%{$request['search']}%")
                    ->orWhere('ssh_port', 'LIKE', "%{$request['search']}%")
                    ->orWhere('worker_port', 'LIKE', "%{$request['search']}%")
                    ->orWhere('controller_port', 'LIKE', "%{$request['search']}%")
                    ->orWhere('gpu_name', 'LIKE', "%{$request['search']}%")
                    ->orWhere('count_gpu', 'LIKE', "%{$request['search']}%")
                    ->orWhere('min_ram', 'LIKE', "%{$request['search']}%")
                    ->orWhere('min_storage', 'LIKE', "%{$request['search']}%")
                    ->orWhere('id', 'LIKE', "%{$request['search']}%");
            })
            ->when(!empty($request['status']), function ($query) use($request) {
                $query->where('status', ServerStatusEnum::tryFrom($request['status'])?->value);
            })
            ->get();

        return view('servers.index', ['items' => $data, 'statuses' => $statuses]);
    }


    public function create()
    {
        return view('servers.create');
    }

    public function show($id)
    {
        $item = Server::find($id)->load('logs');

        return view('servers.show', ['item' => $item]);
    }


    public function server_status($id)
    {
        $instance = Server::find($id);
        $status = (new Vast)->check_instance_status($instance);

        $instance->status_data = $status;
        if ($status['cur_state'] == 'running') {
            $instance->status = 'active';
            $instance->ip = $status['public_ipaddr'];
            $instance->name = $status['extra_env'][0][1];
            $instance->controller_port = $status['ports']['10000/tcp'][1]['HostPort'];
            $instance->worker_port = $status['ports']['40000/tcp'][1]['HostPort'];
            $instance->ssh_port = $status['ports']['22/tcp'][1]['HostPort'];
            $instance->save();
        }
        if ($status['actual_status'] == 'exited' || $status['actual_status'] == 'stopped') {
            $instance->status = 'stopped';
        }
        return response()->json($status);
    }


    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'gpu_name' => 'required|string',
            'count_gpu' => 'required|integer',
            'min_ram' => 'required|integer',
            'min_storage' => 'required|integer',

        ]);

        // Create a new Prompt model instance with the validated data

        $item = new Server();
        $item->name = $request->input('name');
        $item->gpu_name = $request->input('gpu_name');
        $item->count_gpu = $request->input('count_gpu');
        $item->min_ram = $request->input('min_ram');
        $item->min_storage = $request->input('min_storage');
        $item->status_data = "[]";
        $item->ip = "";
        $item->ssh_port = "";
        $item->worker_port = "";
        $item->controller_port = "";
        $item->status = "pending";
        $item->save();
        // Save the changes to the database

        $server = CreateInstanceJob::dispatchSync($item);
        $check = Server::find($item->id);

        if ($check) {
            return redirect()->route('servers.index')->with('success', 'creating server!');
        } else {
            return back()->withErrors(['error' => 'server not created , check logs']);
        }
    }

    public function delete_instance($id)
    {
        $server = Server::find($id);
        $response = (new Vast)->delete_instance($server);
        if ($response && $response['success'] == true) {
            $server->delete();
            return redirect()->route('servers.index')->with(['success' => 'instance deleted successfully']);
        } else {
            $server->delete();
            return redirect()->route('servers.index')->withErrors(['error' => 'error happend , please head to https://cloud.vast.ai/instances/']);
        }
    }

    public function sync($id)
    {
        $instance_record = Server::find($id);
        if ($instance_record->is_syncing == 1) {
            return response()->json(['success' => 'instance already syncing , not finished', 'data' => $instance_record]);

        }

        $instance_record->is_syncing = 1;
        $instance_record->save();

        SyncDataToInstanceJob::dispatchSync($instance_record);

        return response()->json(['success' => 'instance started sync  successfully', 'data' => $instance_record]);
    }

    public function run_model($id)
    {
        $instance_record = Server::find($id);
        RunModelJob::dispatch($instance_record);
    }

    public function stop_server($id)
    {
        $instance_record = Server::find($id);
        StopServer::dispatch($instance_record);
        return response()->json(['success' => 'instance stopped  successfully', 'data' => $instance_record]);
    }

    public function start_server($id)
    {
        $instance_record = Server::find($id);
        StartServer::dispatch($instance_record);
        return response()->json(['success' => 'instance stopped  successfully', 'data' => $instance_record]);
    }
}
