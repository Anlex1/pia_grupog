<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyectoId');
            $table->unsignedBigInteger('evaluadorId');
            $table->timestamp('fechaEvaluacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->decimal('calificacion', 3, 2)->nullable();
            $table->text('observaciones')->nullable();
            $table->json('criteriosEvaluacion')->nullable();
            $table->timestamps();

            $table->foreign('proyectoId')->references('id')->on('proyectos')->onDelete('cascade');
            $table->foreign('evaluadorId')->references('id')->on('evaluadores')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluaciones');
    }
};
