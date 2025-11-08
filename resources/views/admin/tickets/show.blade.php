@extends('admin.layouts.app')

@section('page-title', 'Ticket #' . $ticket->id)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center mb-8">
        <a href="{{ route('admin.tickets.index') }}" class="mr-4 text-gray-600 hover:text-gray-800">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <h1 class="text-3xl font-bold text-gray-900">
            Ticket #{{ $ticket->id }}
        </h1>
    </div>

    <!-- Ticket Info -->
    <div class="glass-card mb-6">
        <div class="flex items-start justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $ticket->subject }}</h2>
                <div class="flex items-center gap-4 text-sm text-gray-600">
                    <span>
                        <i class="fas fa-user mr-2"></i>
                        {{ $ticket->user->name }}
                    </span>
                    <span>
                        <i class="fas fa-envelope mr-2"></i>
                        {{ $ticket->user->email }}
                    </span>
                    <span>
                        <i class="fas fa-calendar mr-2"></i>
                        {{ $ticket->created_at->format('d/m/Y à H:i') }}
                    </span>
                </div>
            </div>
            <span class="px-4 py-2 rounded-full text-sm font-bold {{ $ticket->status === 'open' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                <i class="fas fa-{{ $ticket->status === 'open' ? 'clock' : 'check' }} mr-2"></i>
                {{ $ticket->status === 'open' ? 'Ouvert' : 'Fermé' }}
            </span>
        </div>

        <div class="pt-6 border-t border-gray-200">
            <h3 class="text-lg font-bold text-gray-900 mb-3">Description du Problème</h3>
            <p class="text-gray-700 whitespace-pre-wrap">{{ $ticket->description }}</p>
        </div>
    </div>

    <!-- Admin Response Form -->
    @if($ticket->status === 'open')
        <div class="glass-card">
            <h3 class="text-xl font-bold text-gray-900 mb-6">
                <i class="fas fa-reply mr-2 text-blue-600"></i>
                Répondre au Ticket
            </h3>

            <form action="{{ route('admin.tickets.update', $ticket) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="admin_response" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-comment mr-2 text-blue-600"></i>
                        Votre Réponse <span class="text-red-500">*</span>
                    </label>
                    <textarea name="admin_response" id="admin_response" rows="8" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Écrivez votre réponse au client...">{{ old('admin_response', $ticket->admin_response) }}</textarea>
                </div>

                <div class="mb-6">
                    <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-info-circle mr-2 text-blue-600"></i>
                        Statut du Ticket <span class="text-red-500">*</span>
                    </label>
                    <select name="status" id="status" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="open" {{ old('status', $ticket->status) === 'open' ? 'selected' : '' }}>Ouvert (En Cours)</option>
                        <option value="closed" {{ old('status', $ticket->status) === 'closed' ? 'selected' : '' }}>Fermé (Résolu)</option>
                    </select>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-smooth font-semibold">
                        <i class="fas fa-paper-plane mr-2"></i>Envoyer la Réponse
                    </button>
                    <a href="{{ route('admin.tickets.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-smooth font-semibold">
                        <i class="fas fa-times mr-2"></i>Annuler
                    </a>
                </div>
            </form>
        </div>
    @else
        <!-- Display Response -->
        <div class="neo-card bg-green-50 border-l-4 border-green-500">
            <div class="flex items-start">
                <i class="fas fa-check-circle text-green-600 text-3xl mr-4 mt-1"></i>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-green-900 mb-3">
                        Ticket Fermé - Réponse Envoyée
                    </h3>
                    @if($ticket->admin_response)
                        <p class="text-green-800 whitespace-pre-wrap">{{ $ticket->admin_response }}</p>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
