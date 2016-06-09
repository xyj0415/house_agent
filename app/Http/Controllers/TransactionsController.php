<?php

namespace App\Http\Controllers;

use App\User;
use App\House;
use App\Message;
use App\Transaction;
use App\Http\Requests;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    protected static function make_notification(Request $request)
    {
        $message = new Message;
        $message->sender_id = 0;
        $message->receiver_id = House::find($request->input('house_id'))->agent_id;
        $message->subject = "Transaction Request";
        $message->content = 'The buyer '. User::find($request->input('buyer_id'))->name . ' wants to start a transaction! Please check in the transaction page.';
        $message->hasread = 0;
        return $message;
    }

    public function index()
    {
        $transactions = Transaction::join('houses', 'transactions.house_id', '=', 'houses.id')
                                   ->where('transactions.status', '<>', 'cancelled')
                                   ->where('buyer_id', \Auth::user()->id)
                                   ->orwhere('provider_id', \Auth::user()->id)
                                   ->orwhere('agent_id', \Auth::user()->id)
                                   ->select('transactions.id', 'house_id', 'buyer_id', 'transactions.status as status', 'provider_id', 'agent_id')->get();
        return view('transactions.index', compact('transactions'));
    }

    public function store(Request $request)
    {
    	Transaction::create($request->only(['house_id', 'buyer_id', 'status']));

        House::find($request->input('house_id'))->update(['status' => 'transacting']);

        $message = self::make_notification($request);

        $message->save();

    	flash()->success('Your request has been sent!', 'Please wait for the response.');

    	return redirect()->back();
    }

    public function update(Request $request)
    {
        $transaction = Transaction::find($request->input('id'));
        $status = $transaction->status;

        if ($request->action == 'cancel')
        {
            $transaction->update(['status' => 'cancelled']);
            
            House::find($transaction->house_id)->update(['status' => 'available']);
        }
        elseif ($request->action == 'continue')
        {
            if ($status == 'buyer_to_agent')
            {
                $transaction->update(['status' => 'agent to provider']);
            }
            else if ($status == 'agent to provider')
            {
                $transaction->update(['status' => 'transacting']);
            }
        }
        elseif ($request->action == 'confirm')
        {
            if ($status == 'transacting')
            {
                if (\Auth::user()->id == $transaction->buyer_id)
                {
                    $transaction->update(['status' => 'buyer confirmed']);
                }
                else
                {
                    $transaction->update(['status' => 'provider confirmed']);
                }
            }
            elseif ($status == 'buyer confirmed' || $status == 'provider confirmed')
            {
                $transaction->update(['status' => 'both confirmed']);
            }
            elseif ($status == 'both confirmed')
            {
                $transaction->update(['status' => 'finished']);
                House::find($transaction->house_id)->status = 'sold';
            }
        }
    	return redirect()->back();
    }
}
