<?php
// app/Models/Yape.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Yape extends Model
{
    protected $table = 'yape';
    protected $primaryKey = 'idYape';
    public $timestamps = false;

    public function metodoPagos()
    {
        return $this->hasMany(MetodoPago::class, 'idYape', 'idYape');
    }
}
