<?php

namespace App\Http\Controllers;

use App\Enum\RequestStatusEnum;
use App\Helpers\Helpers;
use App\Helpers\Vast;
use App\Jobs\ProcessImageAttributes;
use App\Models\AIRequest;
use App\Models\Prompt;
use App\Models\Server;
use Illuminate\Http\Request;

class RequestsController extends Controller
{

    public function index(Request $request)
    {
        // Request Status Cases
        $statuses = RequestStatusEnum::cases();
        $data = AIRequest::query()
            ->when(!empty($request['status']), function ($query) use($request) {
                $query->where('status', RequestStatusEnum::tryFrom($request['status'])?->value);
            })
            ->when(!empty($request['search']), function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('identifier', 'LIKE', "%{$request['search']}%")
                        ->orWhere('category', 'LIKE', "%{$request['search']}%")
                        ->orWhere('id', 'LIKE', "%{$request['search']}%")
                        ->orWhere('server_ip', 'LIKE', "%{$request['search']}%");
                });
            })
            ->latest('id')
            ->get();

        return view('requests.index', ['items' => $data, 'statuses' => $statuses]);
    }

    public function show($id)
    {
        $item = AIRequest::find($id);
        $item->parsed_response= (new Helpers)->clean_string($item->response);
        $jsonData = json_decode($item->parsed_response, true);


        return view('requests.show', ['item' => $item,'json_data' => $jsonData]);
    }

    public function destroy($id)
    {
        $item = AIRequest::find($id);
        $item->delete();
        return back()->with(['success' => 'request deleted successfully']);
    }

    public function retry($id)
    {
        $ai_request = AIRequest::find($id);
        $instance = Server::where('status', 'active')->first();
        if ($instance) {

            $prompt = Prompt::where('key', $ai_request->category)->first();
            if ($prompt) {
                ProcessImageAttributes::dispatch($prompt, $ai_request->category, $ai_request, $instance);
                return response()->json(['success' => 'Request retry sent', 'data' => $ai_request], 200);

            } else {
                return response()->json(['error' => 'Not found category'], 404);
            }

        } else {
            return response()->json(['error' => 'No active AI server'], 404);

        }
    }

}
