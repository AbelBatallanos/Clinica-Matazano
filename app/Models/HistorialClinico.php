<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialClinico extends Model
{
    
    protected $fillable = [
        "fechaCreacion",
        "HoraCreacion",
        "paciente_id",
    ];

}
