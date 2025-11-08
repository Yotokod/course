@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center mb-8">
            <a href="{{ route('tickets.index') }}" class="mr-4 text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <h1 class="text-3xl font-bold text-gray-900">
                <i class="fas fa-plus-circle mr-3 text-purple-600"></i>
                Créer un Ticket de Support
            </h1>
        </div>

        <form action="{{ route('tickets.store') }}" method="POST" class="glass-card">
            @csrf

            <div class="mb-6">
                <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-tag mr-2 text-purple-600"></i>
                    Sujet <span class="text-red-500">*</span>
                </label>
                <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('subject') border-red-500 @enderror"
                    placeholder="Ex: Problème d'accès à un cours">
                @error('subject')
                    <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-align-left mr-2 text-purple-600"></i>
                    Description <span class="text-red-500">*</span>
                </label>
                <textarea name="description" id="description" rows="10" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('description') border-red-500 @enderror"
                    placeholder="Décrivez votre problème en détail...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4 pt-6 border-t border-gray-200">
                <button type="submit" class="flex-1 px-6 py-4 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-smooth font-bold text-lg">
                    <i class="fas fa-paper-plane mr-2"></i>Envoyer le Ticket
                </button>
                <a href="{{ route('tickets.index') }}" class="px-6 py-4 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-smooth font-semibold">
                    <i class="fas fa-times mr-2"></i>Annuler
                </a>
            </div>
        </form>

        <div class="mt-8 neo-card bg-blue-50 border-l-4 border-blue-500">
            <div class="flex items-start">
                <i class="fas fa-info-circle text-blue-500 text-xl mr-3 mt-1"></i>
                <div>
                    <h4 class="font-semibold text-blue-800 mb-2">Conseils pour un Meilleur Support</h4>
                    <ul class="text-blue-700 text-sm space-y-1 list-disc list-inside">
                        <li>Soyez aussi précis que possible dans votre description</li>
                        <li>Incluez des captures d'écran si nécessaire</li>
                        <li>Mentionnez le cours ou module concerné</li>
                        <li>Notre équipe vous répondra dans les 24-48 heures</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
