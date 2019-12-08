<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $dates = ['approved_at', 'deleted_at'];

    protected $fillable = [
        'user_id', 'address_id', 'status', 'transport', 'payment', 'creditCard', 'cvc', 'expiry'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function address()
    {
        return $this->belongsTo('App\Address');
    }

    public function orderitems()
    {
        return $this->hasMany('App\OrderItem');
    }
}
