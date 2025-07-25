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
        Schema::create('medicos', function (Blueprint $table) {
            $table->id();
            $table->boolean('disponibilidad');
            $table->foreignId('usuario_id')->unique()->constrained('users')->onDelete('cascade');
            $table->foreignId('especialidad_id')->constrained("especialidades");          
            $table->timestamps();
        });

    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicos');
    }
};
