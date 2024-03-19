<?php

namespace App\Http\Controllers\Api;

use App\Enum\ServerStatusEnum;
use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AIRequest\StoreAIRequest;
use App\Jobs\ProcessImageAttributes;
use App\Jobs\VastAi\StartServer;
use App\Models\AIRequest;
use App\Models\Category;
use App\Models\Prompt;
use App\Models\Server;
use App\Services\PromptService;
use App\Traits\ResponseJson;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AIRequestController extends Controller
{
    public function __construct(public PromptService $promptService)
    {
    }

    use ResponseJson;

    public function image_attributes(StoreAIRequest $request)
    {
        try {
            // Find the active server
            $instance = Server::where('status', 'active')->first();
            // Dispatch start server when not exists the active server
            if (!$instance) {
                $instance = Server::orderBy('id', 'desc')->first();
                if($instance) {
                    StartServer::dispatchSync($instance);
                    sleep(3);
                }
            }

            // Throw exception if the instance is not active
            if($instance?->status != ServerStatusEnum::ACTIVE->value) {
                throw new \Exception('No active ai server', 422);
            }
            // Find the prompt by category
            $prompt = Prompt::where('key', $request->get('category'))->first();
            // Retrieve and store image
            $client = new Client();
            $response = $client->get($request->get('image_url'));
            $imageData = $response->getBody()->getContents();
            $filename = Carbon::now()->timestamp . '.' . uniqid() . '.' . pathinfo($request->get('image_url'), PATHINFO_EXTENSION);
            $image = 'images/' . $filename;
            Storage::disk('public')->put($image, $imageData);

            Log::info('request received');
//            $image_path = Helpers::getImage($request->get('image_url'));
            // Insert the AIRequest to DB
            $ai_request = AIRequest::create([
                'server_ip' => $instance->ip,
                'identifier' => uniqid(),
                'category' => $request->get('category'),
                'image' => $image,
                'image_url' => $request->get('image_url'),
                'image_path' => $image,
                'request' => []
            ]);
            ProcessImageAttributes::dispatch($prompt, $request->get('category'), $ai_request, $instance);
            return response()->json(['message' => 'request sent', 'key' => $ai_request->identifier]);
//            return $this->successResponse(['key' => $ai_request->identifier]);
        }
        catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 403);
//            return $this->errorResponse($exception->getMessage());
        }
    }

    public function get_response($token)
    {
        $ai_request = AIRequest::where('identifier', $token)->firstOrFail();
//        $diff_minutes = now()->diffInMinutes($ai_request->created_at);
        if(!$ai_request->response && config('app.env') == 'local') {
            $ai_request = AIRequest::whereNotNull('response')->latest('id')->firstOrFail();
        }
        // Search for the last occurrence of the specified string
        $response = $ai_request->response;
        $response = (new Helpers)->clean_string($response);
        $response = json_decode($response, true);

        $properties = [];
        $attributes = Category::where('name', $ai_request->category)->first()->attributes;
        $collection = collect($attributes)->whereIn('name', array_keys($response));

        foreach ($response as $key => $item) {
            $property = $collection->firstWhere('name', $key);
            if($property) {
                unset($property['is_active']);
                $property['value'] = $item;
            } else {
                $property = [
                    'name' => $key,
                    'type' => 'string',
                    'values' => [],
                    'validation' => [],
                    'description' => '',
                    'amazon_key_path' => '',
                    'value' => $item,
                ];
            }
            $properties[] = $property;
        }

        return response()->json(['response' => $properties]);

    }
}
