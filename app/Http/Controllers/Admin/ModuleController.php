<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modules = Module::with('creator', 'chapters')->paginate(10);
        return view('admin.modules.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.modules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'is_published' => 'boolean',
        ]);

        $validated['created_by'] = Auth::id();
        $validated['is_published'] = $request->has('is_published');

        Module::create($validated);

        return redirect()->route('admin.modules.index')
            ->with('success', 'Module créé avec succès!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        $module->load('chapters.lessons.quizzes');
        return view('admin.modules.show', compact('module'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module)
    {
        return view('admin.modules.edit', compact('module'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Module $module)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'is_published' => 'boolean',
        ]);

        $validated['is_published'] = $request->has('is_published');

        $module->update($validated);

        return redirect()->route('admin.modules.index')
            ->with('success', 'Module mis à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        $module->delete();

        return redirect()->route('admin.modules.index')
            ->with('success', 'Module supprimé avec succès!');
    }
}
