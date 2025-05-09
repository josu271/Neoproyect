<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Cliente extends Model
{
    protected $table      = 'clientes';
    protected $primaryKey = 'idClientes';

    // ← desactiva el manejo automático de created_at / updated_at
    public $timestamps = false;

    protected $fillable = [
      'DNI','NombreCliente','ApellidopCliente','ApellidomCliente',
      'TelefonoCliente','UbicacionCliente','CiudadCliente','ActivoCliente'
    ];

    public function suscripcion()
    {
        return $this->hasOne(Suscripcion::class,'idCliente','idClientes')
                    ->where('Estado','activa')
                    ->withDefault();
    }
}
