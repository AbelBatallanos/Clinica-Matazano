<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $admin = User::create([
            "name"=> "Erick Alexander",
            "lastname" => "Patton Chavez",
            "email" => "patton@gmail.com",
            "password" => Hash::make("12345678"),
            "fnacimiento" => '1995-07-21',
            "nameuser" => "Erick Patton",
            "telf" => "77903454",
            "ci" => "96345511",
        ]);
        $admin->assignRole('admin');

        $secretaria_1 = User::create([
            "name"=> "Paola",
            "lastname" => "Moreno Añez",
            "email" => "Paolita@gmail.com",
            "password" => Hash::make("12345678"),
            "fnacimiento" => '1985-07-21',
            "nameuser" => "Paolita",
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
            "nameuser" => "Micaelita",
            "telf" => "74563434",
            "ci" => "68834122",
        ]);
        $secretaria_2->assignRole('secretaria');

    }
}
