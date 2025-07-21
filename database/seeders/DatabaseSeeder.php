<?php

namespace Database\Seeders;

use App\Models\Paciente;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(UsuarioSeeder::class);
        $this->call(SecretariaSeeder::class);
        $this->call(PacienteSeeder::class);
        $this->call(EspecialidadSeeder::class);
        $this->call(ConsultorioSeeder::class);
        $this->call(MedicoSeeder::class);
        // $this->call(::class);



        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
