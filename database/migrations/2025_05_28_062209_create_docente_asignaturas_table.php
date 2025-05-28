<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('docente_asignaturas', function (Blueprint $table) {
            $table->bigInteger('docente_id');
            $table->string('asignatura_codigo', 10);
            $table->date('fecha_asignacion')->default(DB::raw('CURRENT_DATE'));
            $table->boolean('activo')->default(true);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            
            $table->primary(['docente_id', 'asignatura_codigo']);
            
            $table->foreign('docente_id')->references('id')->on('docentes')->onDelete('cascade');
            $table->foreign('asignatura_codigo')->references('codigo')->on('asignaturas');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('docente_asignaturas');
    }
};

