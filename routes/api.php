<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MedicoController;

Route::get('/test', function () {
    return response()->json(['mensaje' => 'Ruta test funcionando']);
});


Route::prefix('Cita-Medica')->group(function () {
    Route::post('/medico_especialidad', [MedicoController::class, 'medicoEspecialidad']);
});
