<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';


//Rutas

//Publicas

Route::prefix("inicio")->group(function(){
    Route::get("/", function(){
        return view("loyouts.inicio");
    })->name("inicio");
    
});

//Admin
Route::prefix("admin")->group(function(){
    Route::get("/usuarios", []);
    Route::post("/usuarios", []);
    Route::put("/usuarios/{id}", []);
    Route::delete("/usuarios/{id}", []);

    Route::get("/Reporte-Ganancias");
    Route::get("/ReporteConsultasRealizadas");
    Route::post("");
    
});


//Secretaria


//Medico


//Paciente


