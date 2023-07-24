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

Broadcast::channel('channel_posts', function ($user) {
    $flag = $user->role == 1 ? true : false;
    return $flag;
});

Broadcast::channel('notification.{id}', function ($user, $id) {
    
    $flag = $user->id == $id ? true : false;
    return $flag;
});
