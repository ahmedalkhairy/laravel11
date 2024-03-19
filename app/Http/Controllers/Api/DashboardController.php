<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AIRequests\AIRequestResource;
use App\Models\AIRequest;
use App\Models\Prompt;
use App\Models\Server;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [];
        $data['active_servers'] = Server::where('status', 'running')->count();
        $data['stopped'] = Server::where('status', 'stopped')->count();
        $data['last_servers'] = Server::where('status', 'running')->limit(5)->orderBy('id','desc')->get();
        $data['success_requests'] = AIRequest::where('status', 'success')->count();
        $data['pending_requests'] = AIRequest::where('status', 'pending')->count();
        $last_requests = AIRequest::select('id','status','created_at','category','image','server_id')->limit(5)->latest('id')->get();
        $data['last_requests'] = AIRequestResource::collection($last_requests);
        return response()->json([
            'data' => $data
        ]);


    }
}
