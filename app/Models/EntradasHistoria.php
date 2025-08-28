<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntradasHistoria extends Model
{
    protected $fillable = [];

    public function historial(){
        return $this->belongsTo(HistorialClinico::class);
    }
}
