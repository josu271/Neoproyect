<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;  // <-- importar

class Empleado extends Authenticatable
{
    use HasFactory;  // <-- incluir

    protected $table = 'empleado';
    protected $primaryKey = 'idEmpleado';
    public $timestamps = false;

    protected $fillable = [
        'DNI',
        'NombreEmpleado',
        'ApellidopEmpleado',
        'ApellidomEmpleado',
        'TelefonoEmpleado',
        'RolEmpleado',
        'ActivoEmpleado',
        'ContrasenaEmpleado',
    ];

    protected $hidden = [
        'ContrasenaEmpleado',
    ];

    public function getAuthIdentifierName()
    {
        return 'DNI';
    }

    public function getAuthPassword()
    {
        return $this->ContrasenaEmpleado;
    }
}
