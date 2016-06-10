<?php

namespace App\Http\Controllers;

use Auth;
use User;
use House;
use Message;
use Transaction;
use App\Http\Requests;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
        $this->middleware('agent', ['only' => ['auth', 'checkAuth']]);
    }

    public function show($id)
    {
    	$user = User::find($id);

    	return view('users.show', compact('user'));
    }

    public function showHouse()
    {
        $sold = House::where('provider_id', Auth::user()->id)->get();
        $bought = House::whereIn('id', Transaction::where('buyer_id', Auth::user()->id)->where('status', 'finished')->pluck('house_id'))->get();
        return view('users.show_house', compact('sold', 'bought'));
    }

    public function upgradeRequest()
    {
    	Auth::user()->update(['type' => 'unauthorizedseller']);

    	flash()->info('Your request has been sent!', 'Please wait for the authorization.');

    	$user = Auth::user();

    	return redirect()->back();
    }

    public function auth()
    {
        $users = User::where('type', 'unauthorizedseller')->get();

        $houses = House::where('status', 'unauthenticated')->where('agent_id', Auth::user()->id)->get();

        return view('users.auth', compact('users', 'houses'));
    }

    public function checkAuth(Request $request)
    {
        $type = $request->get('type');
        $action = $request->get('action');
        if ($type == 'user')
        {
            $user_id = $request->get('user_id');

            if ($action == 'agree')
                User::find($user_id)->update(['type' => 'seller']);
            else if ($action == 'reject')
                User::find($user_id)->update(['type' => 'buyer']);
        }
        else if ($type == 'house')
        {
            $house_id = $request->get('house_id');

            if ($action == 'agree')
                House::find($house_id)->update(['status' => 'available']);
            else if ($action == 'reject')
                House::find($house_id)->update(['status' => 'rejected']);
        }

        return redirect()->back();
    }
}
