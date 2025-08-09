<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CitaMedica;
use App\Models\Especialidad;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaMedicaController extends Controller
{
    public function index(){
        $citas = CitaMedica::all();
        return view("citaMedica.list_citasMedics", compact("citas"));
    }

    public function citasReservadas(Request $request){
        $usuario =  Auth::user(); //Obtenemos el datos del usuario logeado
        $usuario_rol = Auth::user()->getRoleNames()->first();
        if($usuario_rol == "secretaria"){
            $citas = CitaMedica::with(['paciente', 'medico'])->get();

            $datos = $citas->map(function($cita){
                return[
                    'hora'=> $cita->horaconsulta,
                    'fecha' => $cita->fechaconsulta,
                    'usuario_id' => $cita->paciente->usuario_id,
                ];
            });     
            dd($datos);
        }
        elseif($usuario_rol == "paciente"){
            $citas  = CitaMedica::where("paciente_id", $usuario->id)->get();
            dd($citas);
        }
        
        // $citas = CitaMedica::where("paciente_id", $paciente_id)->get();
        



        // return view("citaMedica.mis_citas", compact("citas"));
    }

   

    public function create(){
        // $medicos = Medico::with('usuario')->get();
        $especialidades = Especialidad::all();
        return view("citaMedica.create", compact("especialidades"));
    }

    public function store(Request $request){
        $rules = [
            "fechaconsulta" => ['required', 'date'],
            "horaconsulta" => ['required', 'date_format:H:i'],
            "medico_id" => ['required', 'exists:medicos,id'],
            "name" => "required|string|max:100",
            "lastname"  => "required|string|max:100",
            "ci" => "required|string",
         ];
        
        $validated = $request->validate($rules);

        $usuario = User::where('name', $request->name)->where("lastname", $request->lastname)->first();

        // dd($request->medico_id);
        $paciente = Paciente::where("usuario_id", $usuario->id)->first();
        
        CitaMedica::create([
            'fechaconsulta' => $request->fechaconsulta,
            'fechacreacion' => now(),
            'horaconsulta' => $request->horaconsulta,
            'estado' => 'activo', 
            'estadopago' => 'pendiente', 
            'medico_id' => $request->medico_id,
            'paciente_id' => $paciente->id,
            'consultorio_id' => 1,
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        return redirect()->route('Home')->with('success', '¡Cita creada con éxito!');

    }

    public function show($id){

    }

    public function update(){

    }

    public function destroy($id){

    }
}
