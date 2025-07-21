<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('especialidades')->insert([
            "nombre" => "Traumatologia",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('especialidades')->insert([
            "nombre" => "Dermatologia",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('especialidades')->insert([
            "nombre" => "Cardiologia",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('especialidades')->insert([
            "nombre" => "Neulogia",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('especialidades')->insert([
            "nombre" => "Oncologia",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('especialidades')->insert([
            "nombre" => "Pediatria",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('especialidades')->insert([
            "nombre" => "Gastroenterología",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('especialidades')->insert([
            "nombre" => "Oftalmología",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
