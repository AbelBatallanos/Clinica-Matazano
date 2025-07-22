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

    }
}
