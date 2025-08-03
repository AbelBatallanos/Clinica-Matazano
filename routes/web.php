<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CitaMedicaController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\HistorialClinicoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Models\HistorialClinico;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::get("/panel", [HomeController::class, "home"])->name("home");


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Admin 

Route::prefix("/admin")->middleware(["auth"])->group(function(){
    Route::get("/users", [UsersController::class, "list"])->name("list_users"); //Lista todos los usuarios hasta con roles 
    Route::get("/reportesGanancias", [AdminController::class, "reporteGanancias"])->name("reporteGanancia");
   
    Route::get("/reportesConsultasRealizadas", [AdminController::class, "reporteConsultasRealizadas"])->name("reporteConsultasRealizadas");

});

//Funcionalidad Usuarios
Route::prefix("Usuarios")->middleware(["auth"])->group(function(){
    Route::get("/Perfil", [UsersController::class, "perfil"])->name("Perfil-Usuario");
    Route::get("/Editar-Usuario/{id}", [UsersController::class, "list"])->name("Editar-Usuario");
    Route::put("/Editar-Usuario/{id}", [UsersController::class, "list"]); 
    Route::delete("/Eliminar-Usuario/{id}", [UsersController::class, "destroy"])->name("Eliminar-Usuario");

    Route::middleware(["role:admin|secretaria"])->group(function(){
        Route::get("/Pacientes", [UsersController::class, "getAllPacientes"])->name("listUsuarios");
        Route::get("/Funcionarios", [UsersController::class, "getAllWorkers"])->name("Listar-Funcionarios");
        Route::get("/Crear-Usuario", [UsersController::class, "create"])->name("Crear-Usuario");
        Route::post("/Crear-Usuario", [UsersController::class, "store"]);
    });
});


Route::middleware(["auth", "role:secretaria|paciente"])->group(function(){
    

});

//Historial Clinico
Route::prefix("Historial-Clinico")->middleware(["auth", "rule:admin|medico|secretaria"])->group(function(){
    Route::get("/Historiales" ,[ HistorialClinicoController::class, "index" ])->name("HistorialesClinicos");
    Route::get("/Crear" ,[ HistorialClinicoController::class, "listar" ])->name("Crear-Historial");
    Route::post("/Crear" ,[ HistorialClinicoController::class, "store" ]);
    Route::get("/Editar-Historial/{id}" ,[ HistorialClinicoController::class, "show" ]);
    Route::put("/Editar-Historial/{id}" ,[ HistorialClinicoController::class, "update" ]);
    
    Route::middleware(["auth", "rule:admin"])->group(function(){
        Route::put("/Eliminar-Historial/{id}" ,[ HistorialClinicoController::class, "destroy" ]);
    });
    
});


 Route::get("/consultar/citamedica", [CitaMedicaController::class, "index"])->name("citas.index");

// Cita Medica
Route::prefix("Cita-Medica")->group(function(){
    Route::middleware(["auth", "role:medico|secretaria|paciente"])->group(function(){
        Route::get("/Reservar", [CitaMedicaController::class, "create"])->name("crearCita");
        Route::post("/Reservar", [CitaMedicaController::class, "store"]);
        Route::get("/Editar-Cita/{id}", [CitaMedicaController::class, "show"])->name("showCita");
        Route::put("/Editar-Cita/{id}", [CitaMedicaController::class, "update"]);

        Route::middleware(["auth", "rule:medico|secretaria"])->group(function(){
            Route::delete("/Eliminar-Cita", [CitaMedicaController::class, "destroy"])->name("deleteCita");
        });
    });
});

// Secretaria 
Route::prefix("/home/secretaria")->middleware(["auth","role:secretaria"])->group(function(){
    
    Route::get("/consultar/citamedica", [CitaMedicaController::class, "index"]);
    Route::get("/factura/citamedica", [FacturaController::class, "create"]);
    Route::post("/factura/citamedica", [FacturaController::class, "store"]);
});

//  Paciente
Route::prefix("/paciente")->middleware(["auth"])->group(function(){
   
    Route::get("/historialClinico" ,[ HistorialClinicoController::class, "listar" ])->name("historialClinico");
});

