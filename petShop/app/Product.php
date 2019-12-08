<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $dates = ['approved_at', 'deleted_at'];

    protected $fillable = [
        'name', 'animal', 'categories', 'price', 'description', 'on_stock'
    ];

    public function parameters()
    {
        return $this->hasMany('App\Parameter');
    }

    public function orderitem()
    {
        return $this->hasOne('App\OrderItem');
    }

    public function photos()
    {
        return $this->hasMany('App\Photo');
    }

}
