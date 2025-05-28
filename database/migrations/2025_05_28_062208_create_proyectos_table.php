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
            $table->bigIncrements('id');
            $table->string('titulo', 255);
            $table->text('descripcion')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->string('tipo_proyecto_codigo', 10);
            $table->timestamps();
            
            $table->foreign('tipo_proyecto_codigo')->references('codigo')->on('tipos_proyecto');
        });
        
        // Agregar columna con tipo ENUM
        DB::statement("ALTER TABLE proyectos ADD COLUMN estado estado_proyecto DEFAULT 'planificado'");
    }

    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};