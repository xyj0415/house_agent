<?php

namespace App\Http\Controllers;

use App\User;
use App\Message;

use Illuminate\Http\Request;

use App\Http\Requests;

class MessagesController extends Controller
{
    public function index()
    {
    	$received = Message::where('receiver_id', \Auth::user()->id)->get();

    	$sent = Message::where('sender_id', \Auth::user()->id)->get();

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
    	$message = New Message;

    	$message->sender_id = \Auth::user()->id;
    	$message->receiver_id = User::where('email', $request->input('receiver'))->first()->id;
    	$message->subject = $request->input('subject');
    	$message->content = $request->input('content');
    	$message->hasread = 0;
    	$message->save();

    	flash()->success('Success!', 'Your message has been sent!');
    	return redirect()->back();
    }

    public function show($id)
    {
    	Message::find($id)->update(['hasread' => 1]);
    	$message = Message::find($id);

    	return view('messages.show', compact('message'));
    }
}
