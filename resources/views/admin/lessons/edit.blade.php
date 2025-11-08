@extends('admin.layouts.app')

@section('page-title', 'Modifier la Leçon')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.lessons.index') }}" class="mr-4 text-gray-600 hover:text-gray-800">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <h1 class="text-3xl font-bold text-gray-800">
            <i class="fas fa-edit mr-2 text-blue-600"></i>
            Modifier la Leçon
        </h1>
    </div>

    <form action="{{ route('admin.lessons.update', $lesson) }}" method="POST" class="glass-card">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label for="chapter_id" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-list mr-2 text-blue-600"></i>
                Chapitre <span class="text-red-500">*</span>
            </label>
            <select name="chapter_id" id="chapter_id" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @foreach($chapters as $chapter)
                    <option value="{{ $chapter->id }}" {{ old('chapter_id', $lesson->chapter_id) == $chapter->id ? 'selected' : '' }}>
                        {{ $chapter->module->name }} > {{ $chapter->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-heading mr-2 text-blue-600"></i>
                Titre de la Leçon <span class="text-red-500">*</span>
            </label>
            <input type="text" name="name" id="name" value="{{ old('name', $lesson->name) }}" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>

        <div class="mb-6">
            <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-file-text mr-2 text-blue-600"></i>
                Contenu de la Leçon
            </label>
            <textarea name="content" id="content" rows="15"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('content', $lesson->content) }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div>
                <label for="video_url" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-video mr-2 text-blue-600"></i>
                    URL Vidéo
                </label>
                <input type="url" name="video_url" id="video_url" value="{{ old('video_url', $lesson->video_url) }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label for="duration" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-clock mr-2 text-blue-600"></i>
                    Durée (minutes)
                </label>
                <input type="number" name="duration" id="duration" value="{{ old('duration', $lesson->duration) }}" min="0"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label for="order" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-sort-numeric-up mr-2 text-blue-600"></i>
                    Ordre <span class="text-red-500">*</span>
                </label>
                <input type="number" name="order" id="order" value="{{ old('order', $lesson->order) }}" min="0" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
        </div>

        <div class="flex gap-4 pt-6 border-t border-gray-200">
            <button type="submit" class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-smooth font-semibold hover-lift">
                <i class="fas fa-save mr-2"></i>Enregistrer les Modifications
            </button>
            <a href="{{ route('admin.lessons.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-smooth font-semibold">
                <i class="fas fa-times mr-2"></i>Annuler
            </a>
        </div>
    </form>
</div>
@endsection
