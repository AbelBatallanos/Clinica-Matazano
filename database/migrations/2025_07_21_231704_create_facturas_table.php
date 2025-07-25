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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->date("fechaemision");
            $table->string("estadopago");
            $table->string("metodopago");
            $table->string("detalleservicio");
            $table->decimal("monto");
            $table->foreignId("paciente_id")->constrained("pacientes")->onDelete("cascade");
            $table->foreignId("citamedica_id")->constrained("citamedica")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
