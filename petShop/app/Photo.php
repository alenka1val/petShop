<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use SoftDeletes;

    protected $dates = ['approved_at', 'deleted_at'];

    protected $fillable = [
        'product_id', 'filename',
    ];


    public function product()
    {
        return $this->belongsTo('App\Product');
    }

}
