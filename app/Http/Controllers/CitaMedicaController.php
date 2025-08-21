<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CitaMedica;
use App\Models\Especialidad;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Secretaria;
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
       
        $usuario_rol = Auth::user()->getRoleNames()->first();
      
        $datos = [];
        if($usuario_rol == "secretaria"){
            $secretaria = Secretaria::where("usuario_id", Auth::user()->id)->first();
            // dd($secretaria->id);
            $horaActual = now()->format('H:i:s'); 

            $citas = CitaMedica::with(['paciente.usuario', 'medico.usuario', 'medico.especialidad','consultorio'])->whereHas("horario", function($query) use ($secretaria, $horaActual) 
            {
                $query->where("secretaria_id", $secretaria->id)
                ->where("hora_ini", "<=", $horaActual)
                ->where("hora_fin", ">=", $horaActual);
            } )->get();
            $datos = $citas->map(function($cita){ // Ordenamos los datos de la bd
                return[
                    'paciente' => $cita->paciente->usuario->name." ".$cita->paciente->usuario->lastname,
                    'hconsulta'=> $cita->horaconsulta,
                    'fconsulta' => $cita->fechaconsulta,
                    'medico' => $cita->medico->usuario->name." ".$cita->medico->usuario->lastname,
                    'consultorio' => $cita->consultorio->nhabitacion,
                    'especialidad' => $cita->medico->especialidad->nombre,
                    'estado' => $cita->estado,
                    'estadopago' => $cita->estadopago,
                    'fcreacion' => $cita->fechacreacion,
                ];
            });     
            // dd($datos);
            return view("citaMedica.reservadas.citas_reservadas_secretaria", compact("datos"));
        }
        elseif($usuario_rol == "paciente"){
            $usuario =  Auth::user(); //Obtenemos el datos del usuario logeado
            $paciente = Paciente::where("usuario_id", $usuario->id)->first();

            $citas  = CitaMedica::with(["medico.usuario", "paciente.usuario", 'medico.especialidad' ,"consultorio"])->where("paciente_id", $paciente->id)->get();
            $datos = $citas->map(function($cita){  // Ordenamos los datos de la bd
                return [
                    'fconsulta' => $cita->fechaconsulta,
                    'hconsulta' => $cita->horaconsulta,
                    'medico' => $cita->medico->usuario->name." ".$cita->medico->usuario->lastname,
                    'consultorio' => $cita->consultorio->nhabitacion,
                    'especialidad' => $cita->medico->especialidad->nombre,
                    'fcreacion' => $cita->fechacreacion,
                    'estadopago' => $cita->estadopago,
                    'estado' => $cita->estado
                ];
            });
            // dd($datos);
            return view("citaMedica.reservadas.citas_reservadas_paciente", compact("datos") );
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
        // dd($request->all());
        $turno = "";
        $rules = [
            "fechaconsulta" => ['required', 'date'],
            "horaconsulta" => ['required', 'date_format:H:i'],
            "especialidades" => 'required|exists:especialidades,id',
            "medico_id" => ['required', 'exists:medicos,id'],
            "name" => "required|string|max:100",
            "lastname"  => "required|string|max:100",
            "ci" => "required|string",
         ];
        
        $validated = $request->validate($rules);
        // dd(explode(":",$request->horaconsulta)[1]);
        if($request->horaconsulta <= "12"){
            $turno = "1";
        }
        $turno = "2";
        
        if(!$validated){
            return redirect()->route('Home')->with('success', 'No se pudo Crear');
        }
        try {
           $usuario = User::where('name', $request->name)->where("lastname", $request->lastname)->where("ci", $request->ci)->first();
            

            if(!$usuario) return redirect()->route('Home')->with('success', 'Paciente no registrado');

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
        } catch (\Throwable $th) {
            
        }
        

    }

    public function show($id){
        $cita = CitaMedica::where("id", $id)->first();

        if(!$cita) return redirect()->route("Home")->with(["error" => "No Se encontro esa Cita Medica"]);

        return ;
    }

    public function update(){

    }

    public function destroy($id){

    }
}
