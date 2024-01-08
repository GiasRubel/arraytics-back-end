<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained(); // Foreign key referencing quizzes table
            $table->foreignId('quiz_type_id')->constrained('quiz_types'); // Foreign key referencing quiz_types table
            $table->string('title');
            // Add more columns as needed for your quiz_questions table
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quiz_questions');
    }
}
