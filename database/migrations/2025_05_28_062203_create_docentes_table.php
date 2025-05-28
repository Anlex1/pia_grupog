<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('docentes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('identificacion', 20)->unique();
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('email', 255)->unique();
            $table->string('telefono', 20)->nullable();
            $table->string('programa_codigo', 10);
            $table->timestamps();
            
            $table->foreign('programa_codigo')->references('codigo')->on('programas');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('docentes');
    }
};
