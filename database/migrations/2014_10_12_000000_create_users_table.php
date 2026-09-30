<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('rol', ['admin', 'instructor', 'aprendiz'])->default('aprendiz');
            $table->string('name');
            $table->string('documento')->unique();
            $table->string('email')->unique();
            $table->string('celular');
            $table->timestamp('email_verified_at')->nullable();

            $table->string('password');
            
            $table->string('two_factor_code')->nullable();
            $table->dateTime('two_factor_expires_at')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};