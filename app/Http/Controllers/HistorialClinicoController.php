<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CitaMedica;
use App\Models\EntradasHistoria;
use App\Models\HistorialClinico;
use App\Models\Medico;
use App\Models\Paciente;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistorialClinicoController extends Controller
{
    //
    public function listar(){
        $histClinicos = HistorialClinico::all();
        $medico = Medico::where("usuario_id" ,Auth::user()->id)->first();
        
        $horaActual = "7:35:00"; 
        $fecha_actual = "2025-09-02";
        // dd($medico);
        $citas = CitaMedica::with(['paciente.usuario',  'horario'])->whereHas("horario", function($query) use ($medico, $horaActual, $fecha_actual) 
            {
                $query->where("medico_id", $medico->id)
                ->where("hora_ini", "<=", $horaActual)
                ->where("hora_fin", ">=", $horaActual)
                ->where("fecha_ini","<=", $fecha_actual)
                ->where("fecha_fin",">=", $fecha_actual);
            } )->get();

        // $historiales = [];
        // foreach ($citas as $value) {
        
        //    $historiaUser = HistorialClinico::with("paciente.usuario")->where("paciente_id", $value["paciente_id"])->first();
           
        //     $historiales[] = $historiaUser->paciente;
        // }
        // dd($historiales);

        $historiales = $citas->map(function($cita) {
            $historiaUser = HistorialClinico::with("paciente.usuario")->where('paciente_id', $cita->paciente_id)->first();
            return [
                "historia_id" => $historiaUser->id,
                "usuario_id" => $historiaUser->paciente->usuario->id,
                "nombre" => $historiaUser->paciente->usuario->name,
                "apellidos" => $historiaUser->paciente->usuario->lastname,
                "ci" => $historiaUser->paciente->usuario->ci,
                "telefono" => $historiaUser->paciente->usuario->telf,
                "fechacreada" => $historiaUser->fechacreacion,
                "horacreada" => $historiaUser->horacreacion,
            ];
            // dd($historiales);
        });
        // dd($historiales);
        return view("paciente.historialClinico" , compact("historiales"));
    }

    public function crearHistorial(Request $request): RedirectResponse
    {
        $request->validate([
            "paciente_id"=> ["required","exists:paciente,id"],
            "horacreacion"=> ["required","time"],
            "fechacreacion"=> ["required","date"],

        ]);

        $histcreado = HistorialClinico::create([
            "fechacreacion" => $request->fechacreacion,
            "horacreacion" => $request->horacreacion,
            "paciente_id" => $request->paciente_id,
        ]);
    }

    public function MiHistorial(){ //Listar para Paciente
        try {
            $usuario = Auth::user();

            if(!$usuario){ //No existe ese usuario
                return redirect()->route(""); //I must do a route for error or not found 
            }
            $paciente = Paciente::where("usuario_id",$usuario->id)->first();  
            $historial = HistorialClinico::where("paciente_id", $paciente->id);
            $historiales = EntradasHistoria::where("historial_id", $historial->id)->get();
            
            return view("historial_clinico.listar_paciente", compact("historiales"));
        } catch (\Throwable $th) {
            //throw $th;
        }
       
    }



    public function destroy(){

    }

}
