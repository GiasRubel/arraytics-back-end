<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use App\Models\Quiz\Quiz;
use App\Models\Quiz\QuizType;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        // Display a list of quizzes
        $quizzes = Quiz::all();
        return view('quizzes.index', compact('quizzes'));
    }

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        // Display the form for creating a new quiz
        $quizTypes = QuizType::all();
        return view('quizzes.create', compact('quizTypes'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        dd($request->all());
        // Validate and store the new quiz
        $request->validate([
            'title' => 'required|string|max:255',
            // Add more validation rules as needed
        ]);

        Quiz::create([
            'title' => $request->input('title'),
            // Add more fields as needed
        ]);

        return redirect()->route('quizzes.index')->with('success', 'Quiz created successfully!');
    }
}
