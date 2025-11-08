@extends('admin.layouts.app')

@section('page-title', 'Modifier le Chapitre')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.chapters.index') }}" class="mr-4 text-gray-600 hover:text-gray-800">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <h1 class="text-3xl font-bold text-gray-800">
            <i class="fas fa-edit mr-2 text-purple-600"></i>
            Modifier le Chapitre
        </h1>
    </div>

    <form action="{{ route('admin.chapters.update', $chapter) }}" method="POST" class="glass-card">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label for="module_id" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-book mr-2 text-purple-600"></i>
                Module <span class="text-red-500">*</span>
            </label>
            <select name="module_id" id="module_id" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                @foreach($modules as $module)
                    <option value="{{ $module->id }}" {{ old('module_id', $chapter->module_id) == $module->id ? 'selected' : '' }}>
                        {{ $module->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-heading mr-2 text-purple-600"></i>
                Nom du Chapitre <span class="text-red-500">*</span>
            </label>
            <input type="text" name="name" id="name" value="{{ old('name', $chapter->name) }}" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
        </div>

        <div class="mb-6">
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-align-left mr-2 text-purple-600"></i>
                Description
            </label>
            <textarea name="description" id="description" rows="4"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">{{ old('description', $chapter->description) }}</textarea>
        </div>

        <div class="mb-6">
            <label for="order" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-sort-numeric-up mr-2 text-purple-600"></i>
                Ordre <span class="text-red-500">*</span>
            </label>
            <input type="number" name="order" id="order" value="{{ old('order', $chapter->order) }}" min="0" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
        </div>

        <div class="flex gap-4 pt-6 border-t border-gray-200">
            <button type="submit" class="flex-1 px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-smooth font-semibold hover-lift">
                <i class="fas fa-save mr-2"></i>Enregistrer les Modifications
            </button>
            <a href="{{ route('admin.chapters.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-smooth font-semibold">
                <i class="fas fa-times mr-2"></i>Annuler
            </a>
        </div>
    </form>
</div>
@endsection
