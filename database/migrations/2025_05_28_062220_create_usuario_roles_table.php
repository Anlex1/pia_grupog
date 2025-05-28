<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuario_roles', function (Blueprint $table) {
            $table->bigInteger('usuario_id');
            $table->bigInteger('rol_id');
            $table->timestamp('fecha_asignacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            
            $table->primary(['usuario_id', 'rol_id']);
            
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('rol_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuario_roles');
    }
};
