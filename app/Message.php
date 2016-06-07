<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $fillable = [
		'sender_id',
		'receiver_id',
		'subject',
		'content',
		'hasread'
	];

	public function sender()
	{
		return $this->belongsTo('App\User');
	}

	public function receiver_id()
	{
		return $this->belongsTo('App\User');
	}
}
