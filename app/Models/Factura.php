<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = 'facturas';
    protected $primaryKey = 'idFactura';
    public $timestamps = false;

    public function tipoComprobantes()
    {
        return $this->hasMany(TipoComprobante::class, 'idFactura', 'idFactura');
    }
}
