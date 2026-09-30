<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->enum('program_type', ['tecnico', 'tecnologo']);
            $table->string('course_name'); 
            $table->string('course_number')->unique();
            $table->date('start_date');
            $table->date('end_date');

            $table->unsignedBigInteger('environment_id');
            $table->foreign('environment_id')
                ->references('id') 
                ->on('environments') 
                ->onDelete('cascade') 
                ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
