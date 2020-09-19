<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kantin extends Model
{
    protected $guarded = ['id'];
    protected $tables = 'kantins';
    protected $connection = 'mysql';

    public function jenis()
    {
        return $this->belongsTo('App\Tipe', 'tipe', 'id');
    }

    protected $fillable = [
        'id','nama_menu' , 'harga','tipe','gambar'
    ];

    public function order()
    {
        return $this->hasMany('App\Order','id_makanan','id');
    }
    
}
