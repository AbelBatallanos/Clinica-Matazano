<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialClinico extends Model
{
    protected $table = 'historialesclinicos';

    protected $fillable = [
        "fechaCreacion",
        "HoraCreacion",
        "paciente_id",
    ];

}
