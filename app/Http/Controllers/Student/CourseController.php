<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\AccessCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display course catalog.
     */
    public function index()
    {
        $modules = Module::where('is_published', true)
            ->with('chapters')
            ->paginate(12);
        
        return view('student.courses.index', compact('modules'));
    }

    /**
     * Display the specified course.
     */
    public function show(Module $module)
    {
        if (!$module->is_published) {
            abort(404);
        }

        $hasAccess = false;
        if (Auth::check()) {
            $hasAccess = AccessCode::where('user_id', Auth::id())
                ->where('module_id', $module->id)
                ->where(function ($query) {
                    $query->whereNull('expires_at')
                        ->orWhere('expires_at', '>', now());
                })
                ->exists();
        }

        $module->load('chapters.lessons');
        
        return view('student.courses.show', compact('module', 'hasAccess'));
    }

    /**
     * Show access code entry form.
     */
    public function accessForm(Module $module)
    {
        return view('student.courses.access', compact('module'));
    }

    /**
     * Verify and store access code.
     */
    public function verifyAccess(Request $request, Module $module)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $accessCode = AccessCode::where('code', $request->code)
            ->where('module_id', $module->id)
            ->whereNull('used_at')
            ->first();

        if (!$accessCode || $accessCode->isExpired()) {
            return back()->with('error', 'Code d\'accès invalide ou expiré!');
        }

        $accessCode->update([
            'user_id' => Auth::id(),
            'used_at' => now(),
        ]);

        return redirect()->route('student.courses.show', $module)
            ->with('success', 'Accès accordé avec succès!');
    }

    /**
     * Display user's enrolled courses.
     */
    public function myCourses()
    {
        $accessCodes = AccessCode::where('user_id', Auth::id())
            ->with('module.chapters')
            ->get();

        return view('student.courses.my-courses', compact('accessCodes'));
    }
}
