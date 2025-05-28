<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('facultades', function (Blueprint $table) {
            $table->string('codigo', 10)->primary();
            $table->string('descripcion', 255);
            $table->string('institucion_codigo', 10);
            
            $table->foreign('institucion_codigo')->references('codigo')->on('instituciones');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facultades');
    }
};