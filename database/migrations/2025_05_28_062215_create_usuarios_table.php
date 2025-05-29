<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('username', 50)->unique();
            $table->string('email', 255)->unique();
            $table->timestamp('emailVerifiedAt')->nullable();
            $table->string('password', 255);
            $table->boolean('activo')->default(true);
            $table->string('rememberToken', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
