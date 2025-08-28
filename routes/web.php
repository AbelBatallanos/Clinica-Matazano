<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CitaMedicaController;
use App\Http\Controllers\EntradasHistoriaController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\HistorialClinicoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Models\Secretaria;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::prefix("inicio")->middleware(["auth"])->group(function(){
    Route::get("/", [HomeController::class, "home"])->name("Home");
    Route::get("/Perfil", [HomeController::class, "perfil"])->name("Perfil-Usuario");
});

Route::prefix("Mi-Perfil")->middleware("auth")->group(function(){
    Route::get("/{id}", [UsersController::class, "editar_perfil"])->name("editar-perfil");
    Route::put("/{id}", [UsersController::class, "update"]);
    Route::delete("/{id}", [UsersController::class, "destroy"])->name("eliminar-cuenta");

    //Aqui no se si seria password y email o nada porque mejor es hacer el form en uno y no separarlo por partes 
    Route::put("password", [UsersController::class, "password"])->name("actualizar-password");
});

//Funcionalidad Usuarios
Route::prefix("Usuarios")->middleware(["auth"])->group(function(){
    
    Route::get("/Editar-Perfil/{id}", [UsersController::class, "edit"])->name("Editar-Usuario");
    Route::put("/Editar-Perfil/{id}", [UsersController::class, "update"]); 
    Route::delete("/{id}", [UsersController::class, ""])->name("eliminar-usuario");
    
    Route::get("/Pacientes", [UsersController::class, "getAllPacientes"])->name("listar-Usuarios");
    
    //Dudas porque Ya existe listado de cada rol asi que aun no desarrolles esto
    Route::middleware(["role:admin|secretaria"])->group(function(){
        Route::get("/Funcionarios", [UsersController::class, "getAllWorkers"])->name("Listar-Funcionarios");

        Route::get("/Crear-Usuario", [UsersController::class, "create"])->name("Crear-Usuario");
        Route::post("/Crear-Usuario", [UsersController::class, "store"]);

        Route::delete("/Eliminar-Usuario/{id}", [UsersController::class, "destroy"])->name("Eliminar-Usuario");
    });
});

//Historial Clinico
Route::prefix("Historial-Clinico")->middleware(["auth"])->group(function(){

    Route::middleware(["role:admin|medico"])->group(function(){
        Route::get("/Historiales" ,[ HistorialClinicoController::class, "listar" ])->name("HistorialesClinicos");
        Route::get("/Editar-Historial/{id}" ,[ HistorialClinicoController::class, "show" ]);
        Route::put("/Editar-Historial/{id}" ,[ HistorialClinicoController::class, "update" ]);
    });
    
    Route::middleware(["auth", "role:admin"])->group(function(){
        Route::delete("/Eliminar-Historial/{id}" ,[ HistorialClinicoController::class, "destroy" ]);
    });

    Route::middleware(["auth", "role:paciente"])->group(function(){
        Route::get("/Mi-Historial" ,[ HistorialClinicoController::class, "MiHistorial" ])->name("Mi-historial");
    });
});

//Entradas Historia
Route::prefix("Nuevo/Historial")->middleware(["auth", "role:admin|medico"])->group(function(){
    Route::get("/Historial-Paciente/{id}", [EntradasHistoriaController::class , "historialPaciente"]);//Muestra todos los historiales del usuario especifico 

    Route::get("/CrearNueva-Historia", [EntradasHistoriaController::class , "create"]);
    Route::post("/CrearNueva-Historia", [EntradasHistoriaController::class , "store"]);
    Route::get("/Editar-Historia/{id}", [EntradasHistoriaController::class , "show"]);
    Route::put("/Editar-Historia", [EntradasHistoriaController::class , "update"]);
    Route::delete("/Eliminar-Historia", [EntradasHistoriaController::class  , "destroy"]); 
});

// Cita Medica
Route::prefix("Cita-Medica")->group(function(){
    Route::middleware(["auth", "role:secretaria|paciente"])->group(function(){
        Route::get("Reservadas", [CitaMedicaController::class, "citasReservadas"])->name("Citas-Reservadas");//Para que puedan ver todas sus citas realizadas
        Route::get("/Reservar", [CitaMedicaController::class, "create"])->name("crearCita");//Crea Citas
        Route::post("/Reservar", [CitaMedicaController::class, "store"]);

        Route::middleware(["auth", "role:medico|secretaria"])->group(function(){
            Route::get("/Editar-Cita/{id}", [CitaMedicaController::class, "show"])->name("showCita");
            Route::put("/Editar-Cita/{id}", [CitaMedicaController::class, "update"]);
            Route::delete("/Eliminar-Cita", [CitaMedicaController::class, "destroy"])->name("deleteCita");
        });     
    });
});

//Secretaria
Route::prefix("Secretaria")->middleware("role:admin")->group(function(){
    Route::get("/", [Secretaria::class, "listar"])->name("listar-secretaria");
    Route::get("/{id}", [Secretaria::class, "show"])->name("mostrar-secretaria");

    Route::get("/Crear", [Secretaria::class, "create"])->name("crear-secretaria");
    Route::post("/Crear", [Secretaria::class, "store"]);

    Route::get("/Editar/{id}", [Secretaria::class, "edit"])->name("actualizar-secretaria");
    Route::put("Editar/{id}", [Secretaria::class, "update"]);

    Route::delete("Eliminar/{id}", [Secretaria::class, "destroy"])->name("eliminar-secretaria");
});

//Medico
Route::prefix("Medico")->middleware("role:admin")->group(function(){
    Route::get("/", [MedicoController::class, "listar"])->name("listar-medico");
    Route::get("/{id}", [MedicoController::class, "show"])->name("mostrar-medico");

    Route::get("Crear", [MedicoController::class, "create"])->name("crear-medico");
    Route::post("Crear", [MedicoController::class, "store"]);

    Route::get("Editar/{id}", [MedicoController::class, "edit"])->name("actualizar-medico");
    Route::put("Editar/{id}",[MedicoController::class, "update"]);
    Route::delete("Eliminar/{id}", [MedicoController::class, "delete"])->name("eliminar-medico");
});

//Pacientes
Route::prefix("Pacientes")->middleware(["auth","role:admin|medico|secretaria"])->group(function(){
    Route::get("/", [PacienteController::class, "listar"])->name("listar-paciente");
    Route::get("/{id}", [PacienteController::class, "show"])->name("mostrar-paciente");

    Route::delete("/{id}", [PacienteController::class, "destroy"])->name("eliminar-paciente");
});


// Factura-Secretaria 
Route::prefix("/Factura")->middleware(["auth","role:secretaria"])->group(function(){

    Route::get("/Generar-Factura", [FacturaController::class, "store"]);
    Route::get("/Generar-Factura", [FacturaController::class, "create"]);
    Route::post("/Historial/Facturas", [FacturaController::class, "index"]);
});



// Admin 
Route::prefix("/admin")->middleware(["auth", "role:admin"])->group(function(){
    Route::get("/users", [UsersController::class, "list"])->name("list_users"); //Lista todos los usuarios hasta con roles 
    Route::get("/reportesGanancias", [AdminController::class, "reporteGanancias"])->name("reporteGanancia");
   
    Route::get("/reportesConsultasRealizadas", [AdminController::class, "reporteConsultasRealizadas"])->name("reporteConsultasRealizadas");

});
