<?php
// app/Models/MetodoPago.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Yape;
use App\Models\Deposito;
use App\Models\Pago;
use App\Models\TipoComprobante;

class MetodoPago extends Model
{
    protected $table = 'metodo_pago';
    protected $primaryKey = 'idMetodoPago';
    public $timestamps = false;

    public function yape()
    {
        return $this->belongsTo(Yape::class, 'idYape', 'idYape');
    }

    public function deposito()
    {
        return $this->belongsTo(Deposito::class, 'idDeposito', 'idDeposito');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'idMetodoPago', 'idMetodoPago');
    }
}
