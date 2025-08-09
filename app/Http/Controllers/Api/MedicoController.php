<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{


    public function medicoEspecialidad(Request $request)
    {
        // dd($request->all());
        $especialidad_id = $request->input('especialidad_id');

        $medicos = Medico::with(["usuario", "especialidad"])->where("especialidad_id",$especialidad_id)->get();
        
        return response()->json($medicos);
        //  \Log::info('Datos recibidos:', $request->all());
        //  return response()->json(['debug' => $request->all()]);
    }

}
