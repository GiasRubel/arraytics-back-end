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
        Schema::create('quiz_question_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_question_id')->constrained(); // Foreign key referencing quiz_questions table
            $table->string('title');
            // Add more columns as needed for your quiz_question_options table
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_question_options');
    }
};
