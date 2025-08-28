<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Secretaria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SecretariaController extends Controller
{    
    public function listar(){
        $secretarias = Secretaria::all();
        return view("", compact("secretarias"));
    }

    public function show(Request $id){
        $secretaria = Secretaria::with("usuario")->where("id", $id)->first();
        $secretaria = $secretaria->usuario;
        return view("", compact("secretaria"));
    }

    public function create(){

        return view();
    }

    public function store(Request $request){

        $validated = $request->validate([
            'nameuser' => ['required', 'string', 'lowercase','max:20'],
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'lowercase','max:100'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'ci' => ['required', 'string'],
            'password' => ['required', 'confirmed', "min:8", "max:25"],
            'telefono' => ["required","string","min:7","max:15"],
            'fechanacimiento' => ["required", "date"],
        ]);

        if($validated){
            return view(); //dtos incorrect
        }
        $usuario = User::create([
            'nameuser' => $request->nameuser,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'ci' => $request->ci,
            'password' => Hash::make($request->password),
            'fnacimiento' => $request->fechanacimiento,
        ]);

        Secretaria::create([
            "usuario_id" => $usuario->id
        ]);        

        return view(); // Se creo exitosamente
    }

    public function edit($id){
        $secretaria = Secretaria::findOrFail($id)->first();
        return view("", compact("secretaria"));  //archivo update
    }

    public function update(Request $request, $id){
        $secretaria = Secretaria::where("id",$id)->first();
        $usuario = User::where("id", $secretaria->usuario_id)->first();
        $validated = $request->validate([
            'nameuser' => ['sometime', 'string', 'lowercase','max:20'],
            'name' => ['sometime', 'string', 'max:255'],
            'lastname' => ['sometime', 'string', 'lowercase','max:100'],
            'email' => ['sometime', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'ci' => ['sometime', 'string'],
            'password' => ['sometime', 'confirmed', "min:8", "max:25"],
            'telefono' => ["sometime","string","min:7","max:15"],
            'fechanacimiento' => ["sometime", "date"],
        ]);

        if(!$validated){
            return view();
        }

        $usuario->update($request->all());
    }

    public function destroy(Request $id){
        $usuario_rol = Auth::user()->getRoleNames()->first();
        $secretaria = Secretaria::findOrFail($id)->first();

        if(!($usuario_rol == "admin")){
            return view(""); //No puede eliminar a secretaria 
        }

        $secretaria->delete();
        return view(); // Enviar un mensaje que se elimino con exito debes investigar como
    }
}
