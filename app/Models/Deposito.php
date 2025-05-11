<?php
// app/Models/Deposito.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
    protected $table = 'depositos';
    protected $primaryKey = 'idDeposito';
    public $timestamps = false;

    public function metodoPagos()
    {
        return $this->hasMany(MetodoPago::class, 'idDeposito', 'idDeposito');
    }
}
