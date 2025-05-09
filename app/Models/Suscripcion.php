<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suscripcion extends Model
{
    protected $table      = 'suscripciones';
    protected $primaryKey = 'idSuscripcion';

    // ya lo tenías desactivado, está bien:
    public $timestamps = false;

    protected $fillable = [
      'idCliente','idPlan','FechaInicio','FechaFin','Estado'
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class,'idPlan','idPlan')
                    ->withDefault(['nombrePlan'=>'—']);
    }
}
