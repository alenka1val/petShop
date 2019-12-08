<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'order_id', 'product_id', 'quantity'
    ];

    public function order()
    {
        return $this->hasOne('App\Order');
    }

    public function product()
    {
        return $this->hasOne('App\Product');
    }


}
