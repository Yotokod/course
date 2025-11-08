@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <div class="mb-6 text-sm text-gray-600">
            <a href="{{ route('courses.index') }}" class="hover:text-purple-600">Cours</a>
            <i class="fas fa-chevron-right mx-2"></i>
            <a href="{{ route('courses.show', $lesson->chapter->module) }}" class="hover:text-purple-600">{{ $lesson->chapter->module->name }}</a>
            <i class="fas fa-chevron-right mx-2"></i>
            <span class="text-gray-900 font-semibold">{{ $lesson->name }}</span>
        </div>

        <!-- Lesson Header -->
        <div class="glass-card mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $lesson->name }}</h1>
            
            <div class="flex items-center gap-6 mb-4">
                <div class="flex items-center gap-2 text-gray-600">
                    <i class="fas fa-book-open"></i>
                    <span>{{ $lesson->chapter->name }}</span>
                </div>
                @if($lesson->duration)
                    <div class="flex items-center gap-2 text-gray-600">
                        <i class="fas fa-clock"></i>
                        <span>{{ $lesson->duration }} minutes</span>
                    </div>
                @endif
                @if($progress && $progress->completed)
                    <div class="flex items-center gap-2 text-green-600 font-semibold">
                        <i class="fas fa-check-circle"></i>
                        <span>Complété</span>
                    </div>
                @endif
            </div>

            @if(!$progress || !$progress->completed)
                <form action="{{ route('student.lessons.complete', $lesson) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-smooth font-semibold">
                        <i class="fas fa-check mr-2"></i>Marquer comme Complété
                    </button>
                </form>
            @endif
        </div>

        <!-- Video -->
        @if($lesson->video_url)
            <div class="glass-card mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-video mr-2 text-purple-600"></i>
                    Vidéo de la Leçon
                </h2>
                <div class="aspect-video bg-gray-900 rounded-lg flex items-center justify-center">
                    <div class="text-center">
                        <i class="fas fa-play-circle text-6xl text-white mb-4"></i>
                        <a href="{{ $lesson->video_url }}" target="_blank" class="inline-block px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-smooth font-semibold">
                            <i class="fas fa-external-link-alt mr-2"></i>Ouvrir la Vidéo
                        </a>
                    </div>
                </div>
            </div>
        @endif

        <!-- Content -->
        @if($lesson->content)
            <div class="glass-card mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-file-text mr-2 text-purple-600"></i>
                    Contenu de la Leçon
                </h2>
                <div class="prose max-w-none text-gray-700">
                    {!! nl2br(e($lesson->content)) !!}
                </div>
            </div>
        @endif

        <!-- Quizzes -->
        @if($lesson->quizzes->count() > 0)
            <div class="glass-card">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">
                    <i class="fas fa-question-circle mr-2 text-green-600"></i>
                    Quiz de Validation
                </h2>

                @if(session('quiz_score'))
                    <div class="mb-6 p-6 rounded-lg {{ session('quiz_passed') ? 'bg-green-50 border-2 border-green-500' : 'bg-yellow-50 border-2 border-yellow-500' }}">
                        <div class="flex items-center gap-4">
                            <i class="fas {{ session('quiz_passed') ? 'fa-check-circle text-green-600' : 'fa-exclamation-circle text-yellow-600' }} text-4xl"></i>
                            <div>
                                <h3 class="text-xl font-bold {{ session('quiz_passed') ? 'text-green-900' : 'text-yellow-900' }}">
                                    Score: {{ number_format(session('quiz_score'), 0) }}%
                                </h3>
                                <p class="{{ session('quiz_passed') ? 'text-green-700' : 'text-yellow-700' }}">
                                    {{ session('quiz_passed') ? 'Félicitations! Vous avez réussi le quiz.' : 'Continuez à étudier et réessayez!' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                @foreach($lesson->quizzes as $quiz)
                    <form action="{{ route('student.quizzes.submit', $quiz) }}" method="POST" class="neo-card mb-6">
                        @csrf

                        <h3 class="text-xl font-bold text-gray-900 mb-4">{{ $quiz->question }}</h3>

                        <div class="space-y-3">
                            @foreach($quiz->options as $option)
                                <label class="flex items-start p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-purple-500 transition-smooth">
                                    <input type="radio" name="answers[{{ $quiz->id }}]" value="{{ $option->id }}" required
                                        class="mt-1 w-5 h-5 text-purple-600 border-gray-300 focus:ring-purple-500">
                                    <span class="ml-3 text-gray-800">{{ $option->option_text }}</span>
                                </label>
                            @endforeach
                        </div>

                        <button type="submit" class="mt-6 w-full px-6 py-4 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-smooth font-bold text-lg">
                            <i class="fas fa-paper-plane mr-2"></i>Soumettre mes Réponses
                        </button>
                    </form>
                @endforeach

                <div class="neo-card bg-blue-50 border-l-4 border-blue-500">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-blue-500 text-xl mr-3 mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-blue-800 mb-2">Note</h4>
                            <p class="text-blue-700 text-sm">
                                Vous devez obtenir au moins 70% pour valider cette leçon. Vous pouvez retenter le quiz autant de fois que nécessaire.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Navigation -->
        <div class="mt-8 flex justify-between">
            <a href="{{ route('courses.show', $lesson->chapter->module) }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-smooth font-semibold">
                <i class="fas fa-arrow-left mr-2"></i>Retour au Cours
            </a>
        </div>
    </div>
</div>
@endsection
