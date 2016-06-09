<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Message;
use App\Http\Requests;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
    	$received = Message::where('receiver_id', Auth::user()->id)->get();

    	$sent = Message::where('sender_id', Auth::user()->id)->get();

    	$message_unread_num = $notification_unread_num = 0;

    	foreach($received as $message)
    	{
    		if ($message->hasread == 0)
    			if ($message->sender_id == 0)
    				$notification_unread_num++;
    			else
    				$message_unread_num++;
    	}

    	return view('messages.index', compact('received', 'sent','message_unread_num', 'notification_unread_num'));
    }

    public function store(Request $request)
    {
    	if (User::where('email', $request->receiver)->first() == null)
    	{
    		flash()->error('Error!', 'User does not exist!');
    		return redirect()->back();
    	}
        messageGen($request);

    	flash()->success('Success!', 'Your message has been sent!');
    	return redirect()->back();
    }

    public function show($id)
    {
        $message = Message::find($id);
        if ($message == null)
        {
            flash()->error('Error!', 'Message does not exist!');
            return redirect()->back();
        }
        if (Auth::user()->id == $message->receiver_id)
        {
        	Message::find($id)->update(['hasread' => 1]);
        }
    	return view('messages.show', compact('message'));
    }
}
