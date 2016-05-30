<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Http\Requests;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function show()
    {
        $transactions = Transaction::join('houses', 'transactions.house_id', '=', 'houses.id')
                                   ->where('buyer_id', \Auth::user()->id)
                                   ->orwhere('provider_id', \Auth::user()->id)
                                   ->orwhere('agent_id', \Auth::user()->id)
                                   ->select('transactions.id', 'house_id', 'buyer_id', 'transactions.status as status', 'provider_id', 'agent_id')->get();

        return view('transactions.show', compact('transactions'));
    }

    public function store(Request $request)
    {
    	Transaction::create($request->only(['house_id', 'buyer_id', 'status']));

    	flash()->success('Your request has been sent!', 'Please wait for the response.');

    	return redirect()->back();
    }

    public function update(Request $request)
    {
        $transaction = Transaction::find($request->input('id'));
        if ($request->action == 'cancel')
        {
            $transction->update(['status' => 'cancelled']);
        }
        else
        {
            if ($transaction->status == 'buyer_to_agent')
            {
                $transaction->update(['status' => 'agent_to_seller']);
            }
            else if ($transaction->status == 'agent_to_seller')
            {
                $transaction->update(['status' => 'transacting']);
            }
        }
    	return redirect()->back();
    }
}
