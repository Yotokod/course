<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Module;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chapters = Chapter::with('module')->paginate(15);
        return view('admin.chapters.index', compact('chapters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modules = Module::where('is_published', true)->get();
        return view('admin.chapters.create', compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'module_id' => 'required|exists:modules,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'required|integer|min:0',
        ]);

        Chapter::create($validated);

        return redirect()->route('admin.chapters.index')
            ->with('success', 'Chapitre créé avec succès!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chapter $chapter)
    {
        $chapter->load('module', 'lessons.quizzes');
        return view('admin.chapters.show', compact('chapter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chapter $chapter)
    {
        $modules = Module::all();
        return view('admin.chapters.edit', compact('chapter', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chapter $chapter)
    {
        $validated = $request->validate([
            'module_id' => 'required|exists:modules,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'required|integer|min:0',
        ]);

        $chapter->update($validated);

        return redirect()->route('admin.chapters.index')
            ->with('success', 'Chapitre mis à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chapter $chapter)
    {
        $chapter->delete();

        return redirect()->route('admin.chapters.index')
            ->with('success', 'Chapitre supprimé avec succès!');
    }
}
