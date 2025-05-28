<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asignaturas', function (Blueprint $table) {
            $table->string('codigo', 10)->primary();
            $table->string('descripcion', 255);
            $table->integer('creditos')->nullable();
            $table->string('programa_codigo', 10);
            
            $table->foreign('programa_codigo')->references('codigo')->on('programas');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asignaturas');
    }
};
