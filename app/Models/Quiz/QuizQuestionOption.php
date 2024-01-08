<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestionOption extends Model
{
    use HasFactory;

    protected $fillable = ['quiz_question_id', 'title'];

    public function quizQuestion(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(QuizQuestion::class);
    }
}
