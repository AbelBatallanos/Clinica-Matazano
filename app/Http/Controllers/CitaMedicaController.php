<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CitaMedica;
use App\Models\Medico;
use App\Models\Paciente;
use Illuminate\Http\Request;

class CitaMedicaController extends Controller
{
    public function index(){
        $citas = CitaMedica::all();
        return view("citaMedica.list_citasMedics", compact("citas"));
    }

    public function create(){
        $medicos =Medico::with('usuario')->get();
        return view("citaMedica.create", compact("medicos"));
    }

    public function store(Request $request){
         $request->validate([
            "fechaconsulta" => ['required', 'date'],
            "horaconsulta" => ['required', 'date_format:H:i'],
            "medico_id" => ['required', 'exists:medicos,id'],
        ]);

        // Encontrar el paciente que corresponde al usuario autenticado
        $paciente = Paciente::where('usuario_id', auth()->id())->first();

        if (!$paciente) {
            return back()->withErrors(['error' => 'No se encontró un paciente asociado al usuario']);
        }

        CitaMedica::create([
            'fechaconsulta' => $request->fechaconsulta,
            'horaconsulta' => $request->horaconsulta,
            'estado' => 'reserva', // Puedes ajustar este valor
            'estadopago' => 'pendiente', // Puedes ajustar este también
            'medico_id' => $request->medico_id,
            'paciente_id' => $paciente->id,
        ]);
        // dd('Redireccionando...');
        return redirect()->route('citas.index')->with('success', '¡Cita creada con éxito!');

    }
}
