<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipos_proyecto', function (Blueprint $table) {
            $table->string('codigo', 10)->primary();
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipos_proyecto');
    }
};
