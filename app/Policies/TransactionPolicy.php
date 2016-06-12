<?php

namespace App\Policies;

use App\User;
use App\Transaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization;

    protected static function is_buyer(User $user, Transaction $transaction)
    {
        return $user->id == $transaction->buyer_id;
    }

    protected static function is_provider(User $user, Transaction $transaction)
    {
        return $user == $transaction->house->provider;
    }

    protected static function is_agent(User $user, Transaction $transaction)
    {
        return $user == $transaction->house->agent;
    }

    protected function is_available($status)
    {
        return ($status != 'finished') && ($status != 'cancelled') && ($status != 'both confirmed');
    }

    public function see_transaction(User $user, Transaction $transaction)
    {
        return !(self::is_provider($user, $transaction) && ($transaction->status == 'buyer to agent'));
    }

    public function contact_provider(User $user, Transaction $transaction)
    {
        return self::is_agent($user, $transaction) && ($transaction->status == 'buyer to agent');
    }

    public function start_transaction(User $user, Transaction $transaction)
    {
        return self::is_provider($user, $transaction) && ($transaction->status == 'agent to provider');
    }

    public function confirm(User $user, Transaction $transaction)
    {
        $status = $transaction->status;
        return (self::is_buyer($user, $transaction) && ($status == 'transacting' || $status == 'provider confirmed')) ||
               (self::is_provider($user, $transaction) && ($status == 'transacting' || $status == 'buyer confirmed')) ||
               (self::is_agent($user, $transaction) && ($status == 'both confirmed'));
    }

    public function cancel(User $user, Transaction $transaction)
    {
        return self::is_available($transaction->status) && (self::is_buyer($user, $transaction) || self::is_provider($user, $transaction));
    }
}

