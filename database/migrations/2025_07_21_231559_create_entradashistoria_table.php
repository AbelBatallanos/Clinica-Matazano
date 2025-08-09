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
        Schema::create('entradashistoria', function (Blueprint $table) {
            $table->id();
            $table->date("fechaconsulta");

            $table->string("diagnostico");
            $table->string("tratamiento");
            $table->string("motivo");
            $table->string("receta");
            $table->string("observaciones");
            
            $table->foreignId("medico_id")->constrained("medicos")->onDelete("cascade");
            $table->foreignId("historialclinico_id")->constrained("historialesclinicos")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entradashistoria');
    }
};
