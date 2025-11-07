@extends('admin.layouts.app')

@section('page-title', 'Créer un Module')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.modules.index') }}" class="mr-4 text-gray-600 hover:text-gray-800">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <h1 class="text-3xl font-bold text-gray-800">
            <i class="fas fa-plus-circle mr-2 text-purple-600"></i>
            Créer un Nouveau Module
        </h1>
    </div>

    <form action="{{ route('admin.modules.store') }}" method="POST" class="glass-card">
        @csrf

        <!-- Module Name -->
        <div class="mb-6">
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-heading mr-2 text-purple-600"></i>
                Nom du Module <span class="text-red-500">*</span>
            </label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" 
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('name') border-red-500 @enderror"
                placeholder="Ex: Introduction au Laravel" required>
            @error('name')
                <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div class="mb-6">
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-align-left mr-2 text-purple-600"></i>
                Description
            </label>
            <textarea name="description" id="description" rows="5" 
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('description') border-red-500 @enderror"
                placeholder="Décrivez ce que les étudiants apprendront dans ce module...">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
            @enderror
        </div>

        <!-- Price -->
        <div class="mb-6">
            <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-tag mr-2 text-purple-600"></i>
                Prix (FCFA) <span class="text-red-500">*</span>
            </label>
            <input type="number" name="price" id="price" value="{{ old('price', 0) }}" min="0" step="100"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('price') border-red-500 @enderror"
                placeholder="Ex: 25000" required>
            @error('price')
                <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
            @enderror
        </div>

        <!-- Published Status -->
        <div class="mb-6">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}
                    class="w-5 h-5 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                <span class="ml-3 text-sm font-semibold text-gray-700">
                    <i class="fas fa-eye mr-2 text-purple-600"></i>
                    Publier ce module (visible pour les étudiants)
                </span>
            </label>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-4 pt-6 border-t border-gray-200">
            <button type="submit" class="flex-1 px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-smooth font-semibold hover-lift">
                <i class="fas fa-save mr-2"></i>Créer le Module
            </button>
            <a href="{{ route('admin.modules.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-smooth font-semibold">
                <i class="fas fa-times mr-2"></i>Annuler
            </a>
        </div>
    </form>

    <!-- Help Card -->
    <div class="mt-6 neo-card bg-blue-50 border-l-4 border-blue-500">
        <div class="flex items-start">
            <i class="fas fa-info-circle text-blue-500 text-xl mr-3 mt-1"></i>
            <div>
                <h4 class="font-semibold text-blue-800 mb-2">Astuce</h4>
                <p class="text-blue-700 text-sm">
                    Après avoir créé le module, vous pourrez y ajouter des chapitres, des leçons et des quiz pour structurer votre contenu de formation.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
