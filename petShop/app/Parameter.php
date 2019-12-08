<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    protected $dates = ['approved_at', 'deleted_at'];

    protected $fillable = [
        'product_id', 'value', 'type',
    ];

    public function product()
    {
        return $this->belongsTo('App\Parameters');
    }
}
