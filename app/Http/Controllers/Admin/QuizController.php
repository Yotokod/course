<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizOption;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = Quiz::with('lesson.chapter.module')->paginate(15);
        return view('admin.quizzes.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lessons = Lesson::with('chapter.module')->get();
        return view('admin.quizzes.create', compact('lessons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'question' => 'required|string',
            'type' => 'required|in:mcq,true_false',
            'points' => 'required|integer|min:1',
            'options' => 'required|array|min:2|max:4',
            'options.*.text' => 'required|string',
            'options.*.is_correct' => 'boolean',
        ]);

        DB::transaction(function () use ($validated) {
            $quiz = Quiz::create([
                'lesson_id' => $validated['lesson_id'],
                'question' => $validated['question'],
                'type' => $validated['type'],
                'points' => $validated['points'],
            ]);

            foreach ($validated['options'] as $option) {
                QuizOption::create([
                    'quiz_id' => $quiz->id,
                    'option_text' => $option['text'],
                    'is_correct' => $option['is_correct'] ?? false,
                ]);
            }
        });

        return redirect()->route('admin.quizzes.index')
            ->with('success', 'Quiz créé avec succès!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
        $quiz->load('lesson.chapter.module', 'options');
        return view('admin.quizzes.show', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        $lessons = Lesson::with('chapter.module')->get();
        $quiz->load('options');
        return view('admin.quizzes.edit', compact('quiz', 'lessons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'question' => 'required|string',
            'type' => 'required|in:mcq,true_false',
            'points' => 'required|integer|min:1',
            'options' => 'required|array|min:2|max:4',
            'options.*.text' => 'required|string',
            'options.*.is_correct' => 'boolean',
        ]);

        DB::transaction(function () use ($validated, $quiz) {
            $quiz->update([
                'lesson_id' => $validated['lesson_id'],
                'question' => $validated['question'],
                'type' => $validated['type'],
                'points' => $validated['points'],
            ]);

            // Delete old options and create new ones
            $quiz->options()->delete();
            
            foreach ($validated['options'] as $option) {
                QuizOption::create([
                    'quiz_id' => $quiz->id,
                    'option_text' => $option['text'],
                    'is_correct' => $option['is_correct'] ?? false,
                ]);
            }
        });

        return redirect()->route('admin.quizzes.index')
            ->with('success', 'Quiz mis à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->route('admin.quizzes.index')
            ->with('success', 'Quiz supprimé avec succès!');
    }
}
