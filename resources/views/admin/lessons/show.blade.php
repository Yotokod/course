@extends('admin.layouts.app')

@section('page-title', $lesson->name)

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center">
            <a href="{{ route('admin.lessons.index') }}" class="mr-4 text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">{{ $lesson->name }}</h1>
        </div>
        <a href="{{ route('admin.lessons.edit', $lesson) }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-smooth font-semibold">
            <i class="fas fa-edit mr-2"></i>Modifier
        </a>
    </div>

    <!-- Lesson Info -->
    <div class="glass-card mb-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">
            <i class="fas fa-info-circle mr-2 text-blue-600"></i>
            Informations de la Leçon
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div>
                <p class="text-sm text-gray-600 mb-1">Module</p>
                <p class="text-lg font-bold text-gray-800">{{ $lesson->chapter->module->name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">Chapitre</p>
                <p class="text-lg font-bold text-gray-800">{{ $lesson->chapter->name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">Ordre</p>
                <p class="text-lg font-semibold text-gray-800">{{ $lesson->order }}</p>
            </div>
            @if($lesson->duration)
                <div>
                    <p class="text-sm text-gray-600 mb-1">Durée</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $lesson->duration }} min</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Content -->
    @if($lesson->content)
        <div class="glass-card mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">
                <i class="fas fa-file-text mr-2 text-blue-600"></i>
                Contenu
            </h2>
            <div class="prose max-w-none">
                {!! nl2br(e($lesson->content)) !!}
            </div>
        </div>
    @endif

    <!-- Video -->
    @if($lesson->video_url)
        <div class="glass-card mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">
                <i class="fas fa-video mr-2 text-blue-600"></i>
                Vidéo
            </h2>
            <a href="{{ $lesson->video_url }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-external-link-alt mr-2"></i>{{ $lesson->video_url }}
            </a>
        </div>
    @endif

    <!-- Quizzes -->
    <div class="glass-card">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-800">
                <i class="fas fa-question-circle mr-2 text-green-600"></i>
                Quiz ({{ $lesson->quizzes->count() }})
            </h2>
            <a href="{{ route('admin.quizzes.create') }}?lesson_id={{ $lesson->id }}" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-smooth font-semibold">
                <i class="fas fa-plus mr-2"></i>Ajouter un Quiz
            </a>
        </div>

        @if($lesson->quizzes->count() > 0)
            <div class="space-y-4">
                @foreach($lesson->quizzes as $quiz)
                    <div class="neo-inset p-6 rounded-lg">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $quiz->question }}</h3>
                                <div class="flex gap-3">
                                    <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded text-sm font-semibold">
                                        {{ strtoupper($quiz->type) }}
                                    </span>
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded text-sm font-semibold">
                                        {{ $quiz->points }} points
                                    </span>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.quizzes.show', $quiz) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.quizzes.edit', $quiz) }}" class="p-2 text-yellow-600 hover:bg-yellow-50 rounded" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </div>

                        <div class="space-y-2">
                            @foreach($quiz->options as $option)
                                <div class="flex items-center p-3 bg-white rounded {{ $option->is_correct ? 'border-2 border-green-500' : 'border border-gray-200' }}">
                                    @if($option->is_correct)
                                        <i class="fas fa-check-circle text-green-600 mr-3"></i>
                                    @else
                                        <i class="far fa-circle text-gray-400 mr-3"></i>
                                    @endif
                                    <span class="text-gray-800">{{ $option->option_text }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500 py-12">
                <i class="fas fa-inbox text-4xl mb-4 block text-gray-300"></i>
                Aucun quiz. Ajoutez votre premier quiz à cette leçon.
            </p>
        @endif
    </div>
</div>
@endsection
