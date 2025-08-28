<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HorarioTrabajoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hrTrabajos_datos = [ 
            [
                'fecha_ini' => '2025-10-01',
                'fecha_fin' => '2025-10-31',
                'hora_ini' => '14:00:00',
                'hora_fin' => '18:30:00',
                'estado' => "Activo",

                "medico_id"=> "1",
                "secretaria_id"=> "2",
                "especialidad_id"=> "2",
                "consultorio_id"=> "1"
            ],
            [
                'fecha_ini' => '2025-08-01',
                'fecha_fin' => '2025-09-30',
                'hora_ini' => '14:00:00',
                'hora_fin' => '18:30:00',
                'estado' => "Inhabilitado",

                "medico_id"=> "2",
                "secretaria_id"=> "1",
                "especialidad_id"=> "1",
                "consultorio_id"=> "2"
            ],
            [
                'fecha_ini' => '2025-08-01',
                'fecha_fin' => '2025-08-31',
                'hora_ini' => '07:30:00',
                'hora_fin' => '12:00:00',
                'estado' => "Activo",

                "medico_id"=> "1",
                "secretaria_id"=> "2",
                "especialidad_id"=> "2",
                "consultorio_id"=> "1"
            ],
            [
                'fecha_ini' => '2025-09-01',
                'fecha_fin' => '2025-09-30',
                'hora_ini' => '07:30:00',
                'hora_fin' => '12:00:00',
                'estado' => "Activo",

                "medico_id"=> "2",
                "secretaria_id"=> "1",
                "especialidad_id"=> "1",
                "consultorio_id"=> "2"
            ],
]; 
        foreach($hrTrabajos_datos as $hrTbj){
            DB::table('horarios_trabajo')->insert([
            "fecha_ini"=> $hrTbj["fecha_ini"],
            "fecha_fin"=> $hrTbj["fecha_fin"],
            "hora_ini"=> $hrTbj["hora_ini"],
            "hora_fin"=> $hrTbj["hora_fin"],
            "estado"=> $hrTbj["estado"],

            "medico_id"=> $hrTbj["medico_id"],
            "secretaria_id"=> $hrTbj["secretaria_id"],
            "especialidad_id"=> $hrTbj["especialidad_id"],
            "consultorio_id"=> $hrTbj["consultorio_id"],
            "created_at" => now(),
            "updated_at" => now()
        ]);
        }
        
    }
}
