@extends('admin.layouts.app')

@section('page-title', 'Gestion des Quiz')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-800">
        <i class="fas fa-question-circle mr-2 text-green-600"></i>
        Quiz
    </h1>
    <a href="{{ route('admin.quizzes.create') }}" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-smooth hover-lift font-semibold">
        <i class="fas fa-plus mr-2"></i>Créer un Quiz
    </a>
</div>

@if($quizzes->count() > 0)
    <div class="glass-card">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Module / Chapitre / Leçon</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Question</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Type</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Points</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Options</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quizzes as $quiz)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-smooth">
                            <td class="px-6 py-4">
                                <p class="text-xs text-gray-500">{{ $quiz->lesson->chapter->module->name }}</p>
                                <p class="text-xs text-gray-500">{{ $quiz->lesson->chapter->name }}</p>
                                <p class="font-semibold text-gray-800">{{ $quiz->lesson->name }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-800">{{ Str::limit($quiz->question, 60) }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-semibold">
                                    {{ strtoupper($quiz->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">
                                    {{ $quiz->points }} pts
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                                    {{ $quiz->options->count() }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.quizzes.show', $quiz) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded transition-smooth" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.quizzes.edit', $quiz) }}" class="p-2 text-yellow-600 hover:bg-yellow-50 rounded transition-smooth" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.quizzes.destroy', $quiz) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr?');">
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
            {{ $quizzes->links() }}
        </div>
    </div>
@else
    <div class="glass-card text-center py-16">
        <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Aucun quiz</h3>
        <p class="text-gray-600 mb-6">Commencez par créer votre premier quiz</p>
        <a href="{{ route('admin.quizzes.create') }}" class="inline-block px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-smooth font-semibold">
            <i class="fas fa-plus mr-2"></i>Créer un Quiz
        </a>
    </div>
@endif
@endsection
