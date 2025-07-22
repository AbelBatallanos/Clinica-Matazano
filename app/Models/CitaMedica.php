<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CitaMedica extends Model
{
    //
    protected $table = 'citamedica';

    protected $fillable = ["fechaconsulta", "horaconsulta", "estado",
    "estadopago", "medico_id", "paciente_id"];
}
