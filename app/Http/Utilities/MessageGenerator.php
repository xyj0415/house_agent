<?php

namespace App\Http\Utilities;

use Auth;
use App\User;
use App\House;
use App\Message;
use Illuminate\Http\Request;

class MessageGenerator
{
	protected function save(Message $message)
	{
		$message->hasread = 0;
		$message->save();

		return $message;
	}

	protected function make_message_sender()
	{
		$message = new Message;
		$message->sender_id = Auth::user()->id;

		return $message;
	}

	protected function make_notification_sender()
	{
		$message = new Message;
		$message->sender_id = 0;

		return $message;
	}

	public function make_message(Request $request)
	{
		$message = $this->make_message_sender();
        $message->receiver_id = User::where('email', $request->input('receiver'))->first()->id;
        $message->subject = $request->input('subject');
        $message->content = $request->input('content');
       	return $this->save($message);
	}

	public function start_transaction(Request $request)
	{
		$message = $this->make_notification_sender();
        $message->receiver_id = House::find($request->input('house_id'))->agent_id;
        $message->subject = "Transaction Request";
        $message->content = 'The buyer '. User::find($request->input('buyer_id'))->name . ' wants to start a transaction! Please check in the transaction page.';
       	return $this->save($message);
	}

	public function house_authentication(Request $request)
	{
		$message = $this->make_notification_sender();
		$message->receiver_id = $request->input('agent_id');
		$message->subject = "House Authentication Request";
		$message->content = 'The seller '. User::find($request->input('provider_id'))->name . ' wants to ' . $request->input('type') . ' a house! Please check in the authentication page.';
       	return $this->save($message);
	}
}