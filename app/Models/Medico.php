<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Medico extends Model
{
    //
    protected $fillable = [
        "disponibilidad",
        "especialidad_id",
        "usuario_id",
    ];



    public function usuario()
{
    return $this->belongsTo(User::class);
}
}
