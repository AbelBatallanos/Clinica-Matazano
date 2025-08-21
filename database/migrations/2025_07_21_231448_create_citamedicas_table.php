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
        Schema::create('citamedica', function (Blueprint $table) {
            $table->id();
            $table->date("fechaconsulta");
            $table->date("fechacreacion");       
            $table->time("horaconsulta");

            $table->string("estado");
            $table->string("estadopago");

            $table->foreignId("medico_id")->constrained("medicos")->onDelete("cascade");
            $table->foreignId("paciente_id")->constrained("pacientes")->onDelete("cascade");
            $table->foreignId("consultorio_id")->constrained("consultorios")->onDelete("cascade");
            $table->foreignId("horarios_trabajo_id")->constrained("horarios_trabajo")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citamedica');
    }
};
