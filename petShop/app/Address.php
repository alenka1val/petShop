<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    protected $dates = ['approved_at', 'deleted_at'];

    protected $fillable = [
        'zip', 'address', 'city'
    ];


    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
