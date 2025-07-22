<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('historialesclinicos', function (Blueprint $table) {
            $table->id();
            $table->date("fechacreacion");
            $table->time("horacreacion");
            $table->foreignId('paciente_id')->constrained("pacientes");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historiales_clinicos');
    }
};
