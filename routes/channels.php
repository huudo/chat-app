<?php

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
use App\Comment;
use App\Page;
Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('commentroom.{toUserId}', function ($user,$toUserId) {
	$listUser = Comment::where('page_id','=',$toUserId)->pluck('user_id')->toArray();
    return in_array($user->id, $listUser);
});
