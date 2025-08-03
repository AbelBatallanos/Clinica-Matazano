<?php

namespace Database\Seeders;

use App\Models\HistorialClinico;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paciente_1 = User::create([
            "name"=> "Mario",
            "lastname" => "Armando Redondo",
            "email" => "Mario@gmail.com",
            "password" => Hash::make("12345678"),
            "fnacimiento" => '1985-07-21',
            "nameuser" => "Mario",
            "telf" => "74446712",
            "ci" => "45234712",
        ]);
        $paciente_1->assignRole('paciente');

        $paciente_2 = User::create([
            "name"=> "adriana",
            "lastname" => "Guasase Ramos",
            "email" => "Adrianita@gmail.com",
            "password" => Hash::make("12345678"),
            "fnacimiento" => '1985-07-21',
            "nameuser" => "Adriana",
            "telf" => "74563434",
            "ci" => "68834122",
        ]);
        $paciente_2->assignRole('paciente');

        $paciente_3 = User::create([
            "name"=> "Ana Belen",
            "lastname" => "Justiniano Seas",
            "email" => "Belen@gmail.com",
            "password" => Hash::make("12345678"),
            "fnacimiento" => '1985-07-21',
            "nameuser" => "Belen",
            "telf" => "78456451",
            "ci" => "6989344",
        ]);
        $paciente_3->assignRole('paciente');


        $pac_1 = Paciente::create([
            "usuario_id" => $paciente_1->id,
        ]);
        $pac_2 = Paciente::create([
            "usuario_id" => $paciente_2->id,
        ]);
        $pac_3 = Paciente::create([
            "usuario_id" => $paciente_3->id,
        ]);

        /// Historial Clinico
        DB::table("historialesclinicos")->insert([
            "fechacreacion"=> "2025-07-22",
            "horacreacion"=> "13:41:54",
            "paciente_id"=> $pac_1->id,
            "created_at"=> now(),
            "updated_at"=> now(),
        ]);
        DB::table("historialesclinicos")->insert([
            "fechacreacion"=> "2025-03-12",
            "horacreacion"=> "02:41:44",
            "paciente_id"=> $pac_2->id,
             "created_at"=> now(),
            "updated_at"=> now(),
        ]);
        DB::table("historialesclinicos")->insert([
            "fechacreacion"=> "2025-05-02",
            "horacreacion"=> "09:18:54",
            "paciente_id"=> $pac_3->id,
             "created_at"=> now(),
            "updated_at"=> now(),
        ]);

    }
}
