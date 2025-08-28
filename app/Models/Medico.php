<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Medico extends Model
{
    protected $table = 'medicos';

    protected $fillable = [
        "disponibilidad",
        "especialidad_id",
        "usuario_id",
    ];

    public function citamedica(){
        return $this->hasMany(CitaMedica::class);
    }

    public function usuario(){
        return $this->belongsTo(User::class, "usuario_id");
        //Practicamente biene ser la FK de Medico que se relaciona con su campo usuario_id con User
    }

    public function especialidad(){
        return $this->belongsTo(Especialidad::class, "especialidad_id");
    }
    
    public function horariotrabajo(){
        return $this->hasMany(Horariotrabajo::class);
    }
    
}
