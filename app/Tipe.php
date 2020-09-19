<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipe extends Model
{
    protected $tables = 'tipes';
    protected $guarded = ['id'];
    protected $connection = 'mysql';

    public function jajan()
    {
        return $this->hasOne('App\Kantin', 'tipe', 'id');
    }
}
