<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 255);
            $table->text('descripcion')->nullable();
            $table->date('fechaInicio')->nullable();
            $table->date('fechaFin')->nullable();
            $table->unsignedBigInteger('tipoProyectoId');
            $table->timestamps();

            $table->foreign('tipoProyectoId')->references('id')->on('tiposProyecto')->onDelete('cascade');
        });

        // Agregar columna con tipo ENUM
        DB::statement("ALTER TABLE proyectos ADD COLUMN estado estado_proyecto DEFAULT 'planificado'");
    }

    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
