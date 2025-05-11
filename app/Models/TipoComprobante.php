<?php
// app/Models/TipoComprobante.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoComprobante extends Model
{
    protected $table = 'tipo_comprobante';
    protected $primaryKey = 'idTipoComprobante';
    public $timestamps = false;

    public function factura()
    {
        return $this->belongsTo(Factura::class, 'idFactura', 'idFactura');
    }

    public function boleta()
    {
        return $this->belongsTo(Boleta::class, 'idBoleta', 'idBoleta');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'idTipoComprobante', 'idTipoComprobante');
    }
}
