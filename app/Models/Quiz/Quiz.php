<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function quizQuestions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(QuizQuestion::class);
    }
}
