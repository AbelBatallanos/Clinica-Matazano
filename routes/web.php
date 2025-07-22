<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CitaMedicaController;
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

// Listar Usuarios
Route::middleware(["auth"])->group(function(){
    Route::get("/pacientes", [UsersController::class, "list"])->name("listUsuarios");
});


// Ver Historial Clinico
Route::middleware(["auth"])->group(function(){
    Route::get("/historialClinico", [HistorialClinicoController::class, "listar"])->name("VerHistorialClinico");

});

 Route::get("/consultar/citamedica", [CitaMedicaController::class, "index"])->name("citas.index");

//Crear Cita Medica
Route::middleware(["auth", "role:secretaria|paciente|admin"])->group(function(){
    Route::get("/citamedica", [CitaMedicaController::class, "create"])->name("crearCita");
    Route::post("/citamedica", [CitaMedicaController::class, "store"]);
});

// Secretaria 
Route::prefix("/secretaria")->middleware(["auth","role:secretaria"])->group(function(){
    
    Route::get("/consultar/citamedica", [CitaMedicaController::class, "index"]);
});

//  Paciente
Route::prefix("/paciente")->middleware(["auth"])->group(function(){
   
    Route::get("/historialClinico" ,[ HistorialClinicoController::class, "listar" ])->name("historialClinico");
});

