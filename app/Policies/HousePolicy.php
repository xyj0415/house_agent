<?php

namespace App\Policies;

use App\User;
use App\House;
use Illuminate\Auth\Access\HandlesAuthorization;

class HousePolicy
{
    use HandlesAuthorization;

    public function edit(User $user, House $house)
    {
        return $user->id == $house->provider_id;
    }

    public function delete(User $user, House $house)
    {
    	return ($user->id == $house->provider_id) && ($house->status == 'available');
    }

    public function contact(User $user, House $house)
    {
        return ($house->status == 'available') && ($user->id != $house->provider_id) && ($user->type != 'agent');
    }
}
