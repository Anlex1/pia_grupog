<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estudiante_asignaturas', function (Blueprint $table) {
            $table->bigInteger('estudiante_id');
            $table->string('asignatura_codigo', 10);
            $table->string('semestre', 10);
            $table->integer('año');
            $table->string('grupo', 10)->nullable();
            $table->decimal('nota_final', 3, 2)->nullable();
            $table->date('fecha_matricula')->default(DB::raw('CURRENT_DATE'));
            $table->timestamps();
            
            $table->primary(['estudiante_id', 'asignatura_codigo', 'semestre', 'año']);
            
            $table->foreign('estudiante_id')->references('id')->on('estudiantes')->onDelete('cascade');
            $table->foreign('asignatura_codigo')->references('codigo')->on('asignaturas');
        });
        
        // Agregar columna con tipo ENUM
        DB::statement("ALTER TABLE estudiante_asignaturas ADD COLUMN estado estado_asignatura DEFAULT 'matriculado'");
    }

    public function down(): void
    {
        Schema::dropIfExists('estudiante_asignaturas');
    }
};
