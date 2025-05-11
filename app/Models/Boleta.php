<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boleta extends Model
{
    protected $table = 'boletas';
    protected $primaryKey = 'idBoleta';
    public $timestamps = false;

    public function tipoComprobantes()
    {
        return $this->hasMany(TipoComprobante::class, 'idBoleta', 'idBoleta');
    }
}
