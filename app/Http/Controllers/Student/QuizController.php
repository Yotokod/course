<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\UserProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    /**
     * Submit quiz answers and calculate score.
     */
    public function submit(Request $request, Quiz $quiz)
    {
        $request->validate([
            'answers' => 'required|array',
        ]);

        $quiz->load('options', 'lesson');
        
        $correctAnswers = 0;
        $totalQuestions = $quiz->options->count();

        foreach ($request->answers as $optionId) {
            $option = $quiz->options->find($optionId);
            if ($option && $option->is_correct) {
                $correctAnswers++;
            }
        }

        $score = ($correctAnswers / $totalQuestions) * 100;

        // Update user progress
        $progress = UserProgress::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'lesson_id' => $quiz->lesson_id,
            ],
            [
                'quiz_score' => $score,
                'completed' => $score >= 70, // Pass threshold
                'completed_at' => $score >= 70 ? now() : null,
            ]
        );

        return redirect()->back()->with([
            'quiz_score' => $score,
            'quiz_passed' => $score >= 70,
            'success' => $score >= 70 ? 'Quiz réussi!' : 'Score enregistré. Continuez à apprendre!',
        ]);
    }
}
