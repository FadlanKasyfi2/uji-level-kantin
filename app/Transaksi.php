<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User','id_user','id');
    }

    public function order()
    {
        return $this->hasOne('App\Order','id_order','id');
    }
}
