<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsultorioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [ 
            ["nhabitacion"=>"12345", "disponibilidad"=>"activo"],
            ["nhabitacion"=>"67890", "disponibilidad"=>"activo"]
        ]; 
        foreach($values as $consultorio){
            DB::table('consultorios')->insert([
            "nhabitacion" => $consultorio["nhabitacion"],
            "disponibilidad" => $consultorio["disponibilidad"],
            "created_at"=> now(),
            "updated_at" => now(),
        ]);
        }
        

    }
}
