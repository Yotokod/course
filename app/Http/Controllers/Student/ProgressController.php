<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\UserProgress;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    /**
     * Display user's progress dashboard.
     */
    public function index()
    {
        $progress = UserProgress::where('user_id', Auth::id())
            ->with('lesson.chapter.module')
            ->get()
            ->groupBy('lesson.chapter.module.id');

        $modules = Module::whereIn('id', $progress->keys())
            ->with('chapters.lessons')
            ->get();

        $stats = [];
        foreach ($modules as $module) {
            $totalLessons = $module->chapters->sum(function ($chapter) {
                return $chapter->lessons->count();
            });

            $completedLessons = $progress[$module->id]->where('completed', true)->count();
            
            $stats[$module->id] = [
                'total' => $totalLessons,
                'completed' => $completedLessons,
                'percentage' => $totalLessons > 0 ? ($completedLessons / $totalLessons) * 100 : 0,
            ];
        }

        return view('student.progress.index', compact('modules', 'stats'));
    }
}
