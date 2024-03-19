<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VastLogsController extends Controller
{
    public function store(Request $request)
    {
        $content = $request->getContent();
//        $content = $request->input('content');
        Log::info($content);
        $ip = $request->ip();
        $instance = Server::where('ip', $ip)->first();

        if ($instance) {

            if(str_contains($content,'Data sync completed successfully.' || $content==='Data sync completed successfully.')){
                $instance->moved_data=1;
                $instance->is_syncing=0;
                $instance->save();
            }else {
                Log::info($content);
            }
            activity()->performedOn($instance)->withProperties($content)->log('server setup progress');
        }
    }
}
