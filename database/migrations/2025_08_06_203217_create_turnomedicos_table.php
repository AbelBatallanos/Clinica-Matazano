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
        Schema::create('turnomedicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId("medico_id")->constrained("medicos")->onDelete("cascade")->onUpdate("cascade");
            $table->foreignId("consultorio_id")->constrained("consultorios")->onDelete("cascade")->onUpdate("cascade");
            $table->foreignId("turno_id")->constrained("turnos")->onDelete("cascade")->onUpdate("cascade");
            $table->date("fecha");
            $table->time("hora_ini");
            $table->time("hora_fin");
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turnosmedicos');
    }
};
