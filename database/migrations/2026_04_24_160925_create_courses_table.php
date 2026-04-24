<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->integer('course_number'); 
            $table->date('day');

            //laves foraneas
            $table->unsignedBigInteger('area_id');
            $table->foreign('area_id')
                ->references('id') 
                ->on('areas') 
                ->onDelete('cascade') 
                ->onUpdate('cascade') 
            ;

            $table->unsignedBigInteger('training_center_id');
            $table->foreign('training_center_id')
                ->references('id') 
                ->on('training_centers') 
                ->onDelete('cascade') 
                ->onUpdate('cascade') 
            ;


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
