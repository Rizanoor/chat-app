<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('presence.chat', function ($user) {
    return ['id' => $user->id, 'name' => $user->name];
});

Broadcast::channel('dashboard.{id}', function ($user, $id) {
    return $user->id === (int) $id;
});

