<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HistorialClinico;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HistorialClinicoController extends Controller
{
    //
    public function listar(){
        $histClinicos = HistorialClinico::all();
        return view("paciente.historialClinico" , compact("histClinicos"));
    }

    public function crearHistorial(Request $request): RedirectResponse
    {
        $request->validate([
            "paciente_id"=> ["required","date"],
            "horacreacion"=> ["required","time"],
            "paciente_id"=> ["required","date"],

        ]);

        $histcreado = HistorialClinico::create([
            "fechacreacion" => $request->fechacreacion,
            "horacreacion" => $request->horacreacion,
            "paciente_id" => $request->paciente_id,
        ]);
        return redirect(route('', absolute: false));
    }



    public function destroy(){

    }

}
