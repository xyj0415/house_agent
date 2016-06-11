<?php

namespace App\Http\Utilities;

use Auth;
use User;
use House;
use Message;
use Transaction;
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
		$message->content = 'The provider '. User::find($request->input('provider_id'))->name . ' wants to ' . $request->input('type') . ' a house! Please check in the authentication page.';
       	return $this->save($message);
	}

	public function authentication_success(Request $request)
	{
		$house = House::find($request->input('house_id'));
		$message = $this->make_notification_sender();
		$message->receiver_id = $house->provider_id;
		$message->subject = "House Authentication Success";
		$message->content = "The agent " . User::find($house->agent_id)->name . " has authenticated your house " . $house->name . ". The house is available now.";
		return $this->save($message);
	}

	public function authentication_fail(Request $request)
	{
		$house = House::find($request->input('house_id'));
		$message = $this->make_notification_sender();
		$message->receiver_id = $house->provider_id;
		$message->subject = "House Authentication Failed";
		$message->content = "Sorry, the agent " . User::find($house->agent_id)->name . " has rejected your house " . $house->name . ".";
		return $this->save($message);
	}

	public function transaction_cancel(Request $request)
	{
		$transaction = Transaction::find($request->input('id'));
		$house = House::find($transaction->house_id);
		if (\Auth::user()->id == $house->provider_id)
		{
			$type = 'provider';
		}
		else
		{
			$type = 'seller';
		}
		$message = $this->make_notification_sender();
		$message->receiver_id = $house->agent_id;
		$message->subject = "Transaction cancelled";
		$message->content = "Sorry, the " . $type . " " . \Auth::user()->name . " cancelled the transaction.";
		$this->save($message);

		$message = $this->make_notification_sender();
		if ($type == 'provider')
		{
			$message->receiver_id = $transaction->buyer_id;
		}
		else
		{
			$message->receiver_id = $house->provider_id;
		}
		$message->subject = "Transaction cancelled";
		$message->content = "Sorry, the " . $type . " " . \Auth::user()->name . " cancelled the transaction.";
		return $this->save($message);
	}
}