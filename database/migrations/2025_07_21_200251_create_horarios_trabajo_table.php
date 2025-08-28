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
        Schema::create('horarios_trabajo', function (Blueprint $table) {
            $table->id();
            $table->date("fecha_ini");
            $table->date("fecha_fin");
            $table->time("hora_ini");
            $table->time("hora_fin");
            $table->string("estado");

            $table->foreignId("medico_id")->constrained("medicos")->onDelete("cascade")->onUpdate("cascade");
            $table->foreignId("secretaria_id")->constrained("secretarias")->onDelete("cascade")->onUpdate("cascade");
            $table->foreignId("especialidad_id")->constrained("especialidades")->onDelete("cascade")->onUpdate("cascade");
            $table->foreignId("consultorio_id")->constrained("consultorios")->onDelete("cascade")->onUpdate("cascade");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios_trabajo');
    }
};
