<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CitaMedica extends Model
{
    //
    protected $table = 'citamedica';

    protected $fillable = ["fechaconsulta", "fechacreacion", "horaconsulta", "estado",
    "estadopago", "consultorio_id", "medico_id", "paciente_id"];

    public function paciente(){

        return $this->belongsTo(Paciente::class);
    }

    public function medico(){
        return $this->belongsTo(Medico::class);
    }
}
