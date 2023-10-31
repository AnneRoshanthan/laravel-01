<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('blog.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('postforall', function ($user) {
    return $user;
});


Broadcast::channel('user-status', function ($user) {
    return $user;
});

Broadcast::channel('chat', function ($user) {
    // return (int) $user->id === (int) $roomId;
    // Log::info($user);
    // Log::info('Whisper received: ' . $roomId);
    return $user;
});

