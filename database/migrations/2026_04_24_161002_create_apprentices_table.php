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
        Schema::create('apprentices', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->string('email'); 
            $table->unsignedinteger('cell_number'); 
            
            //laves foraneas
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')
                ->references('id') 
                ->on('courses') 
                ->onDelete('cascade') 
                ->onUpdate('cascade') 
            ;

            $table->unsignedBigInteger('computer_id');
            $table->foreign('computer_id')
                ->references('id') 
                ->on('computers') 
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
        Schema::dropIfExists('apprentices');
    }
};
