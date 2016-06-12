<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable = [
        'provider_id',
        'agent_id',
        'status',
    	'type',
        'name',
    	'city',
    	'district',
    	'address',
    	'price',
        'area',
        'buildyear',
    	'description'
    ];

    public function provider()
    {
    	return $this->belongsTo('App\User');
    }

    public function agent()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}
