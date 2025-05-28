<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('proyecto_id');
            $table->bigInteger('evaluador_id');
            $table->timestamp('fecha_evaluacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->decimal('calificacion', 3, 2)->nullable();
            $table->text('observaciones')->nullable();
            $table->json('criterios_evaluacion')->nullable();
            $table->timestamps();
            
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->onDelete('cascade');
            $table->foreign('evaluador_id')->references('id')->on('evaluadores');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluaciones');
    }
};
