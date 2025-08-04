<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CitaMedicaController;
use App\Http\Controllers\EntradasHistoriaController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\HistorialClinicoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
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


//Funcionalidad Usuarios
Route::prefix("Usuarios")->middleware(["auth"])->group(function(){
   
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

//Historial Clinico
Route::prefix("Historial-Clinico")->middleware(["auth"])->group(function(){

    Route::middleware(["role:admin|medico|secretaria"])->group(function(){
        Route::get("/Historiales" ,[ HistorialClinicoController::class, "index" ])->name("HistorialesClinicos");
        Route::get("/Crear" ,[ HistorialClinicoController::class, "listar" ])->name("Crear-Historial");
        Route::post("/Crear" ,[ HistorialClinicoController::class, "store" ]);
        Route::get("/Editar-Historial/{id}" ,[ HistorialClinicoController::class, "show" ]);
        Route::put("/Editar-Historial/{id}" ,[ HistorialClinicoController::class, "update" ]);
    });
    
    Route::middleware(["auth", "role:admin"])->group(function(){
        Route::put("/Eliminar-Historial/{id}" ,[ HistorialClinicoController::class, "destroy" ]);
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
    Route::get("/Editar-Historia", [EntradasHistoriaController::class , "show"]);
    Route::put("/Editar-Historia", [EntradasHistoriaController::class , "update"]);
    Route::delete("/Eliminar-Historia", [EntradasHistoriaController::class  , "destroy"]); 
});


// Cita Medica
Route::prefix("Cita-Medica")->group(function(){
    Route::middleware(["auth", "role:secretaria|paciente"])->group(function(){
        Route::get("Mis-Citas", [CitaMedicaController::class, "misCitas"])->name("Mis-Citas");//Para que puedan ver todas sus citas realizadas
        Route::get("/Reservar", [CitaMedicaController::class, "create"])->name("crearCita");
        Route::post("/Reservar", [CitaMedicaController::class, "store"]);
        Route::get("/Editar-Cita/{id}", [CitaMedicaController::class, "show"])->name("showCita");
        Route::put("/Editar-Cita/{id}", [CitaMedicaController::class, "update"]);
        Route::delete("Cancelar-Cita", [ CitaMedicaController::class , "cancelarCita"] );

        Route::middleware(["auth", "role:medico|secretaria"])->group(function(){
            Route::delete("/Eliminar-Cita", [CitaMedicaController::class, "destroy"])->name("deleteCita");
        });
        
    });
});


// Secretaria 
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
