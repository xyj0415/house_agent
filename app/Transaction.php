<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
     protected $fillable = [
        'house_id',
        'buyer_id',
        'status',
    ];

    public function house()
    {
    	return $this->belongsTo('App\House');
    }

    public function buyer()
    {
    	return $this->belongsTo('App\User');
    }
}
