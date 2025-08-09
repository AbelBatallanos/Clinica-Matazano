<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TurnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $turnos = ["mañana", "tarde", "noche"];

        foreach($turnos as $turno){
            DB::table('turnos')->insert([
            "nombre" => $turno,
            "created_at"=> now(),
            "updated_at"=> now(),
        ]);
        }
    }
}
