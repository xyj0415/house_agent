<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
    	view()->share('user', \Auth::user());
    	view()->share('unread_messages_num', \App\Message::where('hasread', 0)->where('receiver_id', \Auth::user()->id)->count());
    	view()->share('unprocessed_user_auth_num', \App\User::where('type', 'unauthorizedseller')->count());
    	view()->share('unprocessed_house_auth_num', \App\House::where('status', 'unauthenticated')->count());
    }
}
