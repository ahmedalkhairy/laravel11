<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;

class TestController extends Controller
{
    public function listenToAll(): \Illuminate\Http\JsonResponse
    {
        Broadcast::channel('*') // Listen to all channels (use with caution in production)
        ->listen(function ($event) {
            logger()->info('Received broadcast event:', $event->name, $event->data);
        });

        return response()->json(['message' => 'Listening to all channels']);
    }
}
