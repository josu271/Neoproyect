<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $fillable = [
    'idClientes','idEmpleado','idTipoComprobante','idMetodoPago',
    'ActivoPago','PeriodoMes','FechaPago'
];

    protected $table = 'pagos';
    protected $primaryKey = 'idPagos';  
    public $timestamps = false;

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'idClientes', 'idClientes');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'idEmpleado', 'idEmpleado');
    }

    public function tipoComprobante()
    {
        return $this->belongsTo(TipoComprobante::class, 'idTipoComprobante', 'idTipoComprobante');
    }

    public function metodoPago()
    {
        return $this->belongsTo(MetodoPago::class, 'idMetodoPago', 'idMetodoPago');
    }
}
