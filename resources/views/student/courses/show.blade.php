@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Module Header -->
        <div class="glass-card mb-8">
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $module->name }}</h1>
                    
                    @if($module->description)
                        <p class="text-lg text-gray-700 mb-6">{{ $module->description }}</p>
                    @endif

                    <div class="flex items-center gap-6 mb-6">
                        <div>
                            <p class="text-sm text-gray-600">Prix</p>
                            <p class="text-3xl font-bold text-purple-600">{{ number_format($module->price, 0, ',', ' ') }} FCFA</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Chapitres</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $module->chapters->count() }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Leçons</p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ $module->chapters->sum(fn($ch) => $ch->lessons->count()) }}
                            </p>
                        </div>
                    </div>

                    @if(!$hasAccess)
                        @auth
                            <a href="{{ route('student.courses.access', $module) }}" class="inline-block px-8 py-4 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-smooth font-bold text-lg">
                                <i class="fas fa-key mr-2"></i>Entrer le Code d'Accès
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-block px-8 py-4 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-smooth font-bold text-lg">
                                <i class="fas fa-sign-in-alt mr-2"></i>Se Connecter pour Accéder
                            </a>
                        @endauth
                    @else
                        <div class="px-6 py-3 bg-green-100 text-green-800 rounded-lg inline-flex items-center font-semibold">
                            <i class="fas fa-check-circle mr-2"></i>
                            Vous avez accès à ce cours
                        </div>
                    @endif
                </div>

                <div class="gradient-bg-primary rounded-lg flex items-center justify-center">
                    <i class="fas fa-book-reader text-9xl text-white opacity-75"></i>
                </div>
            </div>
        </div>

        <!-- Course Content -->
        <div class="glass-card">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">
                <i class="fas fa-list mr-2 text-purple-600"></i>
                Contenu du Cours
            </h2>

            <div class="space-y-4">
                @foreach($module->chapters->sortBy('order') as $chapter)
                    <div class="neo-card">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">
                                    <span class="text-purple-600">Chapitre {{ $chapter->order }}:</span>
                                    {{ $chapter->name }}
                                </h3>
                                @if($chapter->description)
                                    <p class="text-gray-600">{{ $chapter->description }}</p>
                                @endif
                            </div>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                                {{ $chapter->lessons->count() }} leçons
                            </span>
                        </div>

                        <div class="space-y-2">
                            @foreach($chapter->lessons->sortBy('order') as $lesson)
                                <div class="flex items-center justify-between p-3 bg-white rounded-lg">
                                    <div class="flex items-center gap-3">
                                        <i class="fas fa-{{ $lesson->video_url ? 'video' : 'file-alt' }} text-purple-600"></i>
                                        <span class="font-medium text-gray-900">{{ $lesson->name }}</span>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        @if($lesson->duration)
                                            <span class="text-sm text-gray-600">
                                                <i class="fas fa-clock mr-1"></i>
                                                {{ $lesson->duration }} min
                                            </span>
                                        @endif
                                        @if($hasAccess)
                                            <a href="{{ route('student.lessons.show', $lesson) }}" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition-smooth text-sm font-semibold">
                                                Voir
                                            </a>
                                        @else
                                            <span class="px-4 py-2 bg-gray-200 text-gray-600 rounded text-sm font-semibold">
                                                <i class="fas fa-lock mr-1"></i>Verrouillé
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
