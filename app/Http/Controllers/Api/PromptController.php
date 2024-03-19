<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Prompts\PromptResource;
use App\Models\Prompt;
use App\Traits\ResponseJson;
use Illuminate\Http\Request;

class PromptController extends Controller
{
    use ResponseJson;

    public function index()
    {
        try {
            $data = Prompt::get();
            return $this->successResponse(PromptResource::collection($data));
        }
        catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }
}
