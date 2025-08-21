<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CitaMedica extends Model
{
    //
    protected $table = 'citamedica';

    protected $fillable = ["fechaconsulta", "fechacreacion", "horaconsulta", "estado",
    "estadopago", "consultorio_id", "medico_id", "paciente_id", "horarios_trabajo_id"];

    public function paciente(){

        return $this->belongsTo(Paciente::class);
    }

    public function medico(){
        return $this->belongsTo(Medico::class);
    }

    public function consultorio(){
        return $this->belongsTo(Consultorio::class);
    }

    public function horario(){
        return $this->belongsTo(horariotrabajo::class);
    }
}
