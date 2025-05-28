<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proyecto_asignaturas', function (Blueprint $table) {
            $table->bigInteger('proyecto_id');
            $table->string('asignatura_codigo', 10);
            $table->bigInteger('docente_id');
            $table->string('grupo', 10)->nullable();
            $table->integer('semestre')->nullable();
            $table->integer('año')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            
            $table->primary(['proyecto_id', 'asignatura_codigo']);
            
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->onDelete('cascade');
            $table->foreign('asignatura_codigo')->references('codigo')->on('asignaturas');
            $table->foreign('docente_id')->references('id')->on('docentes');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proyecto_asignaturas');
    }
};
