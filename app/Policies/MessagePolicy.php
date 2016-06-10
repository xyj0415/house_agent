<?php

namespace App\Policies;

use App\User;
use App\Message;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
{
    use HandlesAuthorization;

    public function see_message(User $user, Message $message)
    {
        return ($user->id == $message->sender_id) || ($user->id == $message->receiver_id);
    }
}
