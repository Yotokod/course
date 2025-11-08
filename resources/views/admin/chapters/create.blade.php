@extends('admin.layouts.app')

@section('page-title', 'Créer un Chapitre')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.chapters.index') }}" class="mr-4 text-gray-600 hover:text-gray-800">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <h1 class="text-3xl font-bold text-gray-800">
            <i class="fas fa-plus-circle mr-2 text-purple-600"></i>
            Créer un Nouveau Chapitre
        </h1>
    </div>

    <form action="{{ route('admin.chapters.store') }}" method="POST" class="glass-card">
        @csrf

        <div class="mb-6">
            <label for="module_id" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-book mr-2 text-purple-600"></i>
                Module <span class="text-red-500">*</span>
            </label>
            <select name="module_id" id="module_id" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('module_id') border-red-500 @enderror">
                <option value="">Sélectionnez un module</option>
                @foreach($modules as $module)
                    <option value="{{ $module->id }}" {{ old('module_id') == $module->id ? 'selected' : '' }}>
                        {{ $module->name }}
                    </option>
                @endforeach
            </select>
            @error('module_id')
                <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-heading mr-2 text-purple-600"></i>
                Nom du Chapitre <span class="text-red-500">*</span>
            </label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('name') border-red-500 @enderror"
                placeholder="Ex: Introduction aux concepts de base">
            @error('name')
                <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-align-left mr-2 text-purple-600"></i>
                Description
            </label>
            <textarea name="description" id="description" rows="4"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('description') border-red-500 @enderror"
                placeholder="Décrivez le contenu de ce chapitre...">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="order" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-sort-numeric-up mr-2 text-purple-600"></i>
                Ordre <span class="text-red-500">*</span>
            </label>
            <input type="number" name="order" id="order" value="{{ old('order', 1) }}" min="0" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('order') border-red-500 @enderror"
                placeholder="1">
            <p class="text-sm text-gray-500 mt-1">L'ordre d'affichage du chapitre dans le module</p>
            @error('order')
                <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-4 pt-6 border-t border-gray-200">
            <button type="submit" class="flex-1 px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-smooth font-semibold hover-lift">
                <i class="fas fa-save mr-2"></i>Créer le Chapitre
            </button>
            <a href="{{ route('admin.chapters.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-smooth font-semibold">
                <i class="fas fa-times mr-2"></i>Annuler
            </a>
        </div>
    </form>
</div>
@endsection
