<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Factura;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    //
    public function list(){
        $facturas = Factura::all();
        return redirect()->route("");
    }

    public function create(){ //Lleva a rellenar la factura

    }

    public function store(Request $request){ //Generar la factura



        
        return redirect()->route("");
    }

}
