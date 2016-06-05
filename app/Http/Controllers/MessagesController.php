<?php

namespace App\Http\Controllers;

use App\Message;

use Illuminate\Http\Request;

use App\Http\Requests;

class MessagesController extends Controller
{
    public function index()
    {
    	$received = Message::where('receiver_id', \Auth::user()->id)->get();

    	$sent = Message::where('sender_id', \Auth::user()->id)->get();

    	return view('message.index', compact('received', 'sent'));
    }
}
