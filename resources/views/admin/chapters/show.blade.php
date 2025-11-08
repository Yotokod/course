@extends('admin.layouts.app')

@section('page-title', $chapter->name)

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center">
            <a href="{{ route('admin.chapters.index') }}" class="mr-4 text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">{{ $chapter->name }}</h1>
        </div>
        <a href="{{ route('admin.chapters.edit', $chapter) }}" class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-smooth font-semibold">
            <i class="fas fa-edit mr-2"></i>Modifier
        </a>
    </div>

    <!-- Chapter Info -->
    <div class="glass-card mb-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">
            <i class="fas fa-info-circle mr-2 text-purple-600"></i>
            Informations du Chapitre
        </h2>
        <div class="grid grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-gray-600 mb-1">Module</p>
                <p class="text-lg font-bold text-gray-800">{{ $chapter->module->name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">Ordre</p>
                <p class="text-lg font-semibold text-gray-800">{{ $chapter->order }}</p>
            </div>
        </div>
        @if($chapter->description)
            <div class="mt-6 pt-6 border-t border-gray-200">
                <p class="text-sm text-gray-600 mb-2">Description</p>
                <p class="text-gray-800">{{ $chapter->description }}</p>
            </div>
        @endif
    </div>

    <!-- Lessons -->
    <div class="glass-card">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-800">
                <i class="fas fa-file-alt mr-2 text-purple-600"></i>
                Leçons ({{ $chapter->lessons->count() }})
            </h2>
            <a href="{{ route('admin.lessons.create') }}?chapter_id={{ $chapter->id }}" class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-smooth font-semibold">
                <i class="fas fa-plus mr-2"></i>Ajouter une Leçon
            </a>
        </div>

        @if($chapter->lessons->count() > 0)
            <div class="space-y-4">
                @foreach($chapter->lessons->sortBy('order') as $lesson)
                    <div class="neo-inset p-6 rounded-lg">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-gray-800 mb-2">
                                    <span class="text-purple-600">{{ $lesson->order }}.</span>
                                    {{ $lesson->name }}
                                </h3>
                                @if($lesson->duration)
                                    <p class="text-sm text-gray-600 mb-2">
                                        <i class="fas fa-clock mr-1"></i>
                                        {{ $lesson->duration }} minutes
                                    </p>
                                @endif
                                @if($lesson->video_url)
                                    <p class="text-sm text-blue-600 mb-2">
                                        <i class="fas fa-video mr-1"></i>
                                        Vidéo disponible
                                    </p>
                                @endif
                                @if($lesson->quizzes->count() > 0)
                                    <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded text-sm font-semibold">
                                        <i class="fas fa-question-circle mr-1"></i>
                                        {{ $lesson->quizzes->count() }} quiz
                                    </span>
                                @endif
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.lessons.show', $lesson) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.lessons.edit', $lesson) }}" class="p-2 text-yellow-600 hover:bg-yellow-50 rounded" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500 py-12">
                <i class="fas fa-inbox text-4xl mb-4 block text-gray-300"></i>
                Aucune leçon. Ajoutez votre première leçon à ce chapitre.
            </p>
        @endif
    </div>
</div>
@endsection
