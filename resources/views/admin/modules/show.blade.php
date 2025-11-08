@extends('admin.layouts.app')

@section('page-title', $module->name)

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center">
            <a href="{{ route('admin.modules.index') }}" class="mr-4 text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">{{ $module->name }}</h1>
        </div>
        <a href="{{ route('admin.modules.edit', $module) }}" class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-smooth font-semibold">
            <i class="fas fa-edit mr-2"></i>Modifier
        </a>
    </div>

    <!-- Module Info -->
    <div class="glass-card mb-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">
            <i class="fas fa-info-circle mr-2 text-purple-600"></i>
            Informations du Module
        </h2>
        <div class="grid grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-gray-600 mb-1">Prix</p>
                <p class="text-lg font-bold text-gray-800">{{ number_format($module->price, 0, ',', ' ') }} FCFA</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">Statut</p>
                <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold {{ $module->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                    {{ $module->is_published ? 'Publié' : 'Brouillon' }}
                </span>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">Créé par</p>
                <p class="text-lg font-semibold text-gray-800">{{ $module->creator->name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">Date de création</p>
                <p class="text-lg font-semibold text-gray-800">{{ $module->created_at->format('d/m/Y') }}</p>
            </div>
        </div>
        @if($module->description)
            <div class="mt-6 pt-6 border-t border-gray-200">
                <p class="text-sm text-gray-600 mb-2">Description</p>
                <p class="text-gray-800">{{ $module->description }}</p>
            </div>
        @endif
    </div>

    <!-- Chapters -->
    <div class="glass-card">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-800">
                <i class="fas fa-list mr-2 text-purple-600"></i>
                Chapitres ({{ $module->chapters->count() }})
            </h2>
            <button class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-smooth font-semibold">
                <i class="fas fa-plus mr-2"></i>Ajouter un Chapitre
            </button>
        </div>

        @if($module->chapters->count() > 0)
            <div class="space-y-4">
                @foreach($module->chapters as $chapter)
                    <div class="neo-inset p-6 rounded-lg">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-gray-800 mb-2">
                                    <span class="text-purple-600">{{ $chapter->order }}.</span>
                                    {{ $chapter->name }}
                                </h3>
                                @if($chapter->description)
                                    <p class="text-gray-600 mb-4">{{ $chapter->description }}</p>
                                @endif
                                
                                <!-- Lessons -->
                                @if($chapter->lessons->count() > 0)
                                    <div class="mt-4 space-y-2">
                                        @foreach($chapter->lessons as $lesson)
                                            <div class="flex items-center text-sm text-gray-700 bg-white p-3 rounded">
                                                <i class="fas fa-file-alt text-blue-500 mr-3"></i>
                                                <span class="flex-1">{{ $lesson->name }}</span>
                                                @if($lesson->quizzes->count() > 0)
                                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-semibold">
                                                        {{ $lesson->quizzes->count() }} quiz
                                                    </span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-sm text-gray-500 italic">Aucune leçon dans ce chapitre</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500 py-12">
                <i class="fas fa-inbox text-4xl mb-4 block text-gray-300"></i>
                Aucun chapitre. Commencez par ajouter votre premier chapitre.
            </p>
        @endif
    </div>
</div>
@endsection
