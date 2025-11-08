@extends('admin.layouts.app')

@section('page-title', 'Créer une Leçon')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.lessons.index') }}" class="mr-4 text-gray-600 hover:text-gray-800">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <h1 class="text-3xl font-bold text-gray-800">
            <i class="fas fa-plus-circle mr-2 text-blue-600"></i>
            Créer une Nouvelle Leçon
        </h1>
    </div>

    <form action="{{ route('admin.lessons.store') }}" method="POST" class="glass-card">
        @csrf

        <div class="mb-6">
            <label for="chapter_id" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-list mr-2 text-blue-600"></i>
                Chapitre <span class="text-red-500">*</span>
            </label>
            <select name="chapter_id" id="chapter_id" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('chapter_id') border-red-500 @enderror">
                <option value="">Sélectionnez un chapitre</option>
                @foreach($chapters as $chapter)
                    <option value="{{ $chapter->id }}" {{ old('chapter_id', request('chapter_id')) == $chapter->id ? 'selected' : '' }}>
                        {{ $chapter->module->name }} > {{ $chapter->name }}
                    </option>
                @endforeach
            </select>
            @error('chapter_id')
                <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-heading mr-2 text-blue-600"></i>
                Titre de la Leçon <span class="text-red-500">*</span>
            </label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                placeholder="Ex: Votre première application Laravel">
            @error('name')
                <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-file-text mr-2 text-blue-600"></i>
                Contenu de la Leçon
            </label>
            <textarea name="content" id="content" rows="15"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('content') border-red-500 @enderror"
                placeholder="Écrivez le contenu de votre leçon ici...">{{ old('content') }}</textarea>
            <p class="text-sm text-gray-500 mt-1">Vous pouvez utiliser Markdown ou du HTML simple</p>
            @error('content')
                <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div>
                <label for="video_url" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-video mr-2 text-blue-600"></i>
                    URL Vidéo (optionnel)
                </label>
                <input type="url" name="video_url" id="video_url" value="{{ old('video_url') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('video_url') border-red-500 @enderror"
                    placeholder="https://youtube.com/...">
                @error('video_url')
                    <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="duration" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-clock mr-2 text-blue-600"></i>
                    Durée (minutes)
                </label>
                <input type="number" name="duration" id="duration" value="{{ old('duration') }}" min="0"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('duration') border-red-500 @enderror"
                    placeholder="30">
                @error('duration')
                    <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="order" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-sort-numeric-up mr-2 text-blue-600"></i>
                    Ordre <span class="text-red-500">*</span>
                </label>
                <input type="number" name="order" id="order" value="{{ old('order', 1) }}" min="0" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('order') border-red-500 @enderror"
                    placeholder="1">
                @error('order')
                    <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex gap-4 pt-6 border-t border-gray-200">
            <button type="submit" class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-smooth font-semibold hover-lift">
                <i class="fas fa-save mr-2"></i>Créer la Leçon
            </button>
            <a href="{{ route('admin.lessons.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-smooth font-semibold">
                <i class="fas fa-times mr-2"></i>Annuler
            </a>
        </div>
    </form>

    <!-- TinyMCE Integration Note -->
    <div class="mt-6 neo-card bg-blue-50 border-l-4 border-blue-500">
        <div class="flex items-start">
            <i class="fas fa-lightbulb text-blue-500 text-xl mr-3 mt-1"></i>
            <div>
                <h4 class="font-semibold text-blue-800 mb-2">Astuce - Éditeur Riche</h4>
                <p class="text-blue-700 text-sm">
                    Pour un éditeur riche avec mise en forme, vous pouvez utiliser TinyMCE. L'éditeur actuel supporte le Markdown pour une mise en forme simple.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- TinyMCE CDN (commented for later activation) -->
<!--
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#content',
        height: 500,
        plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount',
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help'
    });
</script>
-->
@endsection
