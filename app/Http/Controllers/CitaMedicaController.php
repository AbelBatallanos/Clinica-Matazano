<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CitaMedica;
use App\Models\Especialidad;
use App\Models\Horariotrabajo;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Secretaria;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaMedicaController extends Controller
{
    public function index(){
        $citas = CitaMedica::all();
        return view("citaMedica.list_citasMedics", compact("citas"));
    }

    public function citasReservadas(Request $request)
    {
        $usuario =  Auth::user(); //Obtenemos el datos del usuario logeado
        $usuario_rol = Auth::user()->getRoleNames()->first();
      
        $datos = [];
        if($usuario_rol == "secretaria"){ //Cada Secretaria Ve las reservas que le corresponden 
            $secretaria = Secretaria::where("usuario_id", $usuario->id)->first();

            $horaActual = "7:35:00"; 
            $fecha_actual = "2025-09-02";
            
            $citas = CitaMedica::with(['paciente.usuario', 'medico.usuario', 'medico.especialidad','consultorio', 'horario'])->whereHas("horario", function($query) use ($secretaria, $horaActual, $fecha_actual) 
            {
                $query->where("secretaria_id", $secretaria->id)
                ->where("hora_ini", "<=", $horaActual)
                ->where("hora_fin", ">=", $horaActual)
                ->where("fecha_ini","<=", $fecha_actual)
                ->where("fecha_fin",">=", $fecha_actual);
            } )->get();

            $datos = $citas->map(function($cita){ // Ordenamos los datos de la bd
                return[
                    'id'=> $cita->id,
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
            
            return view("citaMedica.reservadas.citas_reservadas_secretaria", compact("datos"));
        }
        elseif($usuario_rol == "paciente"){
         
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
    }

   

    public function create(){
        // $medicos = Medico::with('usuario')->get();
        $especialidades = Especialidad::all();
        return view("citaMedica.create", compact("especialidades"));
    }

    public function store(Request $request){
        // dd($request->all());
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
      
        if(!$validated){
            return redirect()->route('Home')->with('success', 'No se pudo Crear');
        }

        try {
           $usuario = User::where('name', $request->name)->where("lastname", $request->lastname)->where("ci", $request->ci)->first();
            
            if(!$usuario) return redirect()->route('Home')->with('success', 'Paciente no registrado');
     
            $paciente = Paciente::where("usuario_id", $usuario->id)->first();
            $hora = Carbon::createFromFormat('H:i', $request->horaconsulta)->format('H:i:s');
            //Cambia el formato de horaconsulta a h:i:s
            
            $hora_trabajo = Horariotrabajo::where("fecha_ini", "<=", $request->fechaconsulta)
            ->where("fecha_fin", ">=", $request->fechaconsulta)
            ->where("hora_ini", "<=", $hora)
            ->where("hora_fin", ">=", $hora)
            ->where("medico_id",$request->medico_id)
            ->where("estado", 'Activo')
            ->where("especialidad_id",$request->especialidades)->first();

            // dd($hora_trabajo);
            CitaMedica::create([
                'fechaconsulta' => $request->fechaconsulta,
                'fechacreacion' => now(),
                'horaconsulta' => $request->horaconsulta,
                'estado' => 'recervado', 
                'estadopago' => 'pendiente', 
                'medico_id' => $request->medico_id,
                'paciente_id' => $paciente->id,
                "horarios_trabajo_id"=> $hora_trabajo->id,
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

    public function update(Request $request, $id){
        $citamedica = CitaMedica::where("id", $id)->first();

        $rules = [
            "horaconsulta" => "sometime|",
            "estado" => "sometime|",    
        ];

        $validated = $request->validate($rules);
        if(!$validated){
            return redirect()->route('Home')->with('success', 'No se pudo Actualizar');
        }
        try {
             $datos = [
            "horaconsulta" => $request->horaconsulta,
            "estado" => $request->estado,
            "update_at" => now(),
        ]; 
        $citamedica->update($datos);
        } catch (\Throwable $th) {
            
        }
       

    }

    public function destroy($id){
        try{
            $citamedica = CitaMedica::where("id", $id)->first(); 
            $citamedica->destroy();
            return redirect()->route("Home")->with("message", "Se elimmino Correctamente");
        }catch(\Throwable $th){

        }

    }
}
