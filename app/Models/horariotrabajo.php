<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horariotrabajo extends Model
{
    //
     protected $table = 'horarios_trabajo';

    protected $fillable = ["medico_id", "secretaria_id", "especialidad_id", "consultorio_id", "fecha_ini", "fecha_fin",
    "hora_ini", "hora_fin", "estado"];


    public function consultorio(){
        return $this->belongsTo(Consultorio::class);
    }

    public function medico(){
        return $this->belongsTo(Medico::class);
    }

    public function secretaria(){
        return $this->belongsTo(Secretaria::class);
    }

}
