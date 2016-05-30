<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\House;

use App\Http\Requests;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('agent', ['only' => ['auth']]);
    }

    public function show($id)
    {
    	$user = User::find($id);

    	return view('users.show', compact('user'));
    }

    public function upgradeRequest()
    {
    	\Auth::user()->update(['type' => 'unauthorizedseller']);

    	flash()->info('Your request has been sent!', 'Please wait for the authorization.');

    	$user = \Auth::user();

    	return redirect()->back();
    }

    public function auth()
    {
        $users = User::where('type', 'unauthorizedseller')->get();

        $houses = House::where('status', 'unauthenticated')->where('agent_id', \Auth::user()->id)->get();

        return view('users.auth', compact('users', 'houses'));
    }

    public function houseAuth(Request $request)
    {
        $action = $request->get('action');
        $house_id = $request->get('house_id');
        
        if ($action == 'agree')
            House::find($house_id)->update(['status' => 'available']);
        else if ($action == 'reject')
            House::find($house_id)->update(['status' => 'rejected']);
        return redirect()->back();
    }

    public function buyerAuth(Request $request)
    {
        $action = $request->get('action');
        $user_id = $request->get('user_id');

        if ($action == 'agree')
            User::find($user_id)->update(['type' => 'seller']);
        else if ($action == 'reject')
            User::find($user_id)->update(['type' => 'buyer']);
        return redirect()->back();
    }
}
