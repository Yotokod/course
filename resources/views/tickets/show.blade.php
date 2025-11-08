@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center mb-8">
            <a href="{{ route('tickets.index') }}" class="mr-4 text-gray-600 hover:text-gray-800">
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
                            <i class="fas fa-calendar mr-2"></i>
                            {{ $ticket->created_at->format('d/m/Y à H:i') }}
                        </span>
                        <span>
                            <i class="fas fa-user mr-2"></i>
                            {{ $ticket->user->name }}
                        </span>
                    </div>
                </div>
                <span class="px-4 py-2 rounded-full text-sm font-bold {{ $ticket->status === 'open' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                    <i class="fas fa-{{ $ticket->status === 'open' ? 'clock' : 'check' }} mr-2"></i>
                    {{ $ticket->status === 'open' ? 'Ouvert' : 'Fermé' }}
                </span>
            </div>

            <div class="pt-6 border-t border-gray-200">
                <h3 class="text-lg font-bold text-gray-900 mb-3">Description</h3>
                <p class="text-gray-700 whitespace-pre-wrap">{{ $ticket->description }}</p>
            </div>
        </div>

        <!-- Admin Response -->
        @if($ticket->admin_response)
            <div class="neo-card bg-green-50 border-l-4 border-green-500">
                <div class="flex items-start">
                    <i class="fas fa-reply text-green-600 text-2xl mr-4 mt-1"></i>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-green-900 mb-3">
                            Réponse du Support
                        </h3>
                        <p class="text-green-800 whitespace-pre-wrap">{{ $ticket->admin_response }}</p>
                    </div>
                </div>
            </div>
        @else
            <div class="neo-card bg-blue-50 border-l-4 border-blue-500 text-center">
                <i class="fas fa-hourglass-half text-blue-600 text-4xl mb-4"></i>
                <h3 class="text-lg font-bold text-blue-900 mb-2">En Attente de Réponse</h3>
                <p class="text-blue-700">Notre équipe examine votre ticket et vous répondra bientôt.</p>
            </div>
        @endif
    </div>
</div>
@endsection
