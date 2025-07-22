<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SecretariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $secretaria_1 = User::create([
            "name"=> "Paola",
            "lastname" => "Moreno Añez",
            "email" => "Paolita@gmail.com",
            "password" => Hash::make("12345678"),
            "fnacimiento" => '1985-07-21',
            "nameuser" => "Paola",
            "telf" => "74563434",
            "ci" => "68834122",
        ]);
        $secretaria_1->assignRole('secretaria');

        $secretaria_2 = User::create([
            "name"=> "Micaela",
            "lastname" => "Perez Sambrana",
            "email" => "Micaela@gmail.com",
            "password" => Hash::make("12345678"),
            "fnacimiento" => '1985-02-21',
            "nameuser" => "Micaela",
            "telf" => "74563434",
            "ci" => "68834122",
        ]);
        $secretaria_2->assignRole('secretaria');

        DB::table('secretarias')->insert([
            "usuario_id" => $secretaria_1->id,
            "created_at"=> now(),
            "updated_at" => now(),
        ]);

        DB::table('secretarias')->insert([
            "usuario_id" => $secretaria_2->id,
            "created_at"=> now(),
            "updated_at" => now(),
        ]);
    }
}
