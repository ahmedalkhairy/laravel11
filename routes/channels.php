<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat', function () {
//    return $user->id === \App\Models\Property::find($propertyId)->updated_by;
    return true; 
});

