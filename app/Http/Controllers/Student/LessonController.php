<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\UserProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    /**
     * Display the specified lesson.
     */
    public function show(Lesson $lesson)
    {
        // Check if user has access to this lesson's module
        $module = $lesson->chapter->module;
        
        $hasAccess = \App\Models\AccessCode::where('user_id', Auth::id())
            ->where('module_id', $module->id)
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->exists();

        if (!$hasAccess) {
            return redirect()->route('student.courses.access', $module)
                ->with('error', 'Vous devez avoir accès à ce module pour voir cette leçon!');
        }

        $lesson->load('chapter.module', 'quizzes.options');
        
        // Get user progress
        $progress = UserProgress::where('user_id', Auth::id())
            ->where('lesson_id', $lesson->id)
            ->first();

        return view('student.lessons.show', compact('lesson', 'progress'));
    }

    /**
     * Mark lesson as completed.
     */
    public function complete(Request $request, Lesson $lesson)
    {
        UserProgress::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'lesson_id' => $lesson->id,
            ],
            [
                'completed' => true,
                'completed_at' => now(),
            ]
        );

        return redirect()->back()
            ->with('success', 'Leçon marquée comme complétée!');
    }
}
