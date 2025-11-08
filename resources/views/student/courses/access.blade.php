@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="glass-card">
            <div class="text-center mb-8">
                <i class="fas fa-key text-6xl text-purple-600 mb-4"></i>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Entrez votre Code d'Accès</h1>
                <p class="text-lg text-gray-600">Pour accéder au module: <strong>{{ $module->name }}</strong></p>
            </div>

            <form action="{{ route('student.courses.verify', $module) }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label for="code" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-ticket-alt mr-2 text-purple-600"></i>
                        Code d'Accès <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="code" id="code" required
                        class="w-full px-6 py-4 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-lg font-mono text-center tracking-wider @error('code') border-red-500 @enderror"
                        placeholder="XXXX-XXXX-XXXX">
                    @error('code')
                        <p class="text-red-500 text-sm mt-2"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full px-6 py-4 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-smooth font-bold text-lg">
                    <i class="fas fa-unlock mr-2"></i>Valider le Code
                </button>
            </form>

            <div class="mt-8 pt-8 border-t border-gray-200">
                <div class="neo-card bg-blue-50 border-l-4 border-blue-500">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-blue-500 text-xl mr-3 mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-blue-800 mb-2">Comment obtenir un code d'accès?</h4>
                            <p class="text-blue-700 text-sm mb-2">
                                Vous recevez un code d'accès unique après avoir acheté un module. Ce code est valable pour la durée spécifiée lors de l'achat.
                            </p>
                            <p class="text-blue-700 text-sm">
                                Si vous n'avez pas encore acheté ce module, veuillez contacter l'administration ou procéder au paiement.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('courses.show', $module) }}" class="text-gray-600 hover:text-gray-800 font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Retour aux Détails du Cours
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
