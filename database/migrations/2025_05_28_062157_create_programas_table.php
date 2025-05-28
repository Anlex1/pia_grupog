<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programas', function (Blueprint $table) {
            $table->string('codigo', 10)->primary();
            $table->string('descripcion', 255);
            $table->string('departamento_codigo', 10);
            
            $table->foreign('departamento_codigo')->references('codigo')->on('departamentos');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programas');
    }
};
