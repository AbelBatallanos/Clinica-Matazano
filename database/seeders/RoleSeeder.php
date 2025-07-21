<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $admin = Role::create(["name" => "admin"]);
        $secretaria = Role::create(["name" => "secretaria"]);
        $medico =  Role::create(["name"=> "medico"]);
        $paciente =  Role::create(["name"=> "paciente"]);

        // Permisos ADMIN
        $permisoDashboardAdmin = Permission::create(["name"=> "dashboarAdmin"]);
        $permisoReportedUsoConsultorioAdmin = Permission::create(["name"=> "Reporte-HroUsoConsultorio"]);
        $permisoReporteGananciaAdmin = Permission::create(["name"=> "Reporte-Ganacias"]);
        $permisoReporteConsultasRealizadasAdmin = Permission::create(["name"=> "Reporte-Consultas-Realizadas"]);


        // Permisos Secretaria
        $permisoDashboardSecretaria = Permission::create(["name"=> "dashboarSecretaria"]);
        $permisoFacturacionSecretaria = Permission::create(["name"=> "Facturacion"]);
        // $permisoDashboardSecretaria = Permission::create(["name"=> "dashboarSecretaria"]);


        // Permisos Medico
        $permisoDashboardMedico = Permission::create(["name"=> "dashboarMedico"]);
      
        
        // Permisos Paciente
        $permisoDashboardPaciente = Permission::create(["name"=> "dashboarPaciente"]);
    
     

        //Permisos a la cuales mas de 1 puede entrar
        $permisoLogin = Permission::create(["name"=> "Login"]);
        $permisoRegister = Permission::create(["name"=> "Register"]);
        $permisoHistorialClinico= Permission::create(["name"=> "HistorialClinico"]);
        $permisoCitaMedica= Permission::create(["name"=> "CitaMedica"]);
        $permisoEntradasHistoria = Permission::create(["name"=> "EntradasHistoria"]);


        $admin->givePermissionTo(Permission::all());

        $secretaria->givePermissionTo([$permisoDashboardSecretaria, $permisoFacturacionSecretaria, $permisoLogin, 
                                    $permisoRegister, $permisoCitaMedica,  ]);
        $medico->givePermissionTo([$permisoDashboardMedico, $permisoEntradasHistoria, $permisoHistorialClinico, 
                            $permisoCitaMedica, $permisoRegister, $permisoLogin,  ]);

        $paciente->givePermissionTo([$permisoDashboardPaciente, $permisoHistorialClinico, $permisoCitaMedica, $permisoLogin, $permisoRegister ]);
    }
}
