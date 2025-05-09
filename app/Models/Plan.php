<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'planes';
    protected $primaryKey = 'idPlan';
    public $timestamps = true;
    protected $fillable = ['nombrePlan','precio'];
}
