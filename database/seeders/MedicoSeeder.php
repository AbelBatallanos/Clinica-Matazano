<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use App\Models\Medico;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MedicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $medico_1 = User::create([
            "name"=> "Alejandra",
            "lastname" => "Montero Coca",
            "email" => "Alejandra@gmail.com",
            "password" => Hash::make("12345678"),
            "fnacimiento" => '1992-09-21',
            "nameuser" => "Alejandra",
            "telf" => "62157833",
            "ci" => "77854452",
        ]);
        $medico_1->assignRole('medico');

        $medico_2 = User::create([
            "name"=> "Pablo",
            "lastname" => "Gomez Sambrana",
            "email" => "Pablo@gmail.com",
            "password" => Hash::make("12345678"),
            "fnacimiento" => '1985-07-21',
            "nameuser" => "Pablito",
            "telf" => "74563434",
            "ci" => "68834122",
        ]);
        $medico_2->assignRole('medico');

        Medico::create([
            "disponibilidad" => 1,
            "especialidad_id" =>  2,
            "usuario_id" => $medico_1->id,
        ]);

        Medico::create([
            "disponibilidad" => 1,
            "especialidad_id" => 1,
            "usuario_id" => $medico_2->id,
        ]);
        




    }
}
