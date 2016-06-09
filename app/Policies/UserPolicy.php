<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    protected static function is_current_user(User $current_user, User $user)
    {
        return $current_user->id == $user->id;
    }

    public function see_profile(User $current_user, User $user)
    {
        return self::is_current_user($current_user, $user) || ($current_user->type == 'agent');
    }

    public function edit_profile(User $current_user, User $user)
    {
        return self::is_current_user($current_user, $user);
    }

    public function become_seller(User $current_user, User $user)
    {
        return self::is_current_user($current_user, $user) && ($current_user->type == 'buyer');
    }
}
