@extends('admin.layouts.app')

@section('page-title', 'Gestion des Leçons')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-800">
        <i class="fas fa-file-alt mr-2 text-blue-600"></i>
        Leçons
    </h1>
    <a href="{{ route('admin.lessons.create') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-smooth hover-lift font-semibold">
        <i class="fas fa-plus mr-2"></i>Créer une Leçon
    </a>
</div>

@if($lessons->count() > 0)
    <div class="glass-card">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Module / Chapitre</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Leçon</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Ordre</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Durée</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Quiz</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lessons as $lesson)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-smooth">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-800">{{ $lesson->chapter->module->name }}</p>
                                <p class="text-sm text-gray-600">{{ $lesson->chapter->name }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-800">{{ $lesson->name }}</p>
                                @if($lesson->video_url)
                                    <p class="text-sm text-blue-600 mt-1">
                                        <i class="fas fa-video mr-1"></i>Vidéo
                                    </p>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-semibold">
                                    {{ $lesson->order }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ $lesson->duration ?? '-' }} min
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
                                    {{ $lesson->quizzes->count() }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.lessons.show', $lesson) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded transition-smooth" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.lessons.edit', $lesson) }}" class="p-2 text-yellow-600 hover:bg-yellow-50 rounded transition-smooth" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.lessons.destroy', $lesson) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded transition-smooth" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-200">
            {{ $lessons->links() }}
        </div>
    </div>
@else
    <div class="glass-card text-center py-16">
        <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Aucune leçon</h3>
        <p class="text-gray-600 mb-6">Commencez par créer votre première leçon</p>
        <a href="{{ route('admin.lessons.create') }}" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-smooth font-semibold">
            <i class="fas fa-plus mr-2"></i>Créer une Leçon
        </a>
    </div>
@endif
@endsection
