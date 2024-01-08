<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use App\Models\Quiz\Quiz;
use App\Models\Quiz\QuizType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function index()
    {
        // Display a list of quizzes
        $quizzes = Quiz::all();
        return view('quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        // Display the form for creating a new quiz
        $quizTypes = QuizType::all();
        return view('quizzes.create', compact('quizTypes'));
    }

    public function store(Request $request)

    {
        // Validate the request data if needed

        return DB::transaction(function () use ($request) {
            // Create and save the Quiz
            $quiz = Quiz::create([
                'title' => $request->input('title'),
            ]);

            // Store Quiz Questions
            foreach ($request->input('questions') as $questionData) {
                $question = $quiz->quizQuestions()->create([
                    'title' => $questionData['quiz_question_title'],
                    'quiz_type_id' => $questionData['quiz_question_type'],
                ]);

                // Store Quiz Question Options if available
                if (isset($questionData['options'])) {
                    $question->quizQuestionOptions()->createMany(
                        array_map(function ($optionTitle) {
                            return ['title' => $optionTitle];
                        }, $questionData['options'])
                    );
                }
            }

// Redirect with flash message
            return redirect()->route('quizzes.index')->with('success', 'Quiz created successfully!');
        });
    }
}
