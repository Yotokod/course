@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">
                <i class="fas fa-ticket-alt mr-3 text-purple-600"></i>
                Mes Tickets de Support
            </h1>
            <a href="{{ route('tickets.create') }}" class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-smooth font-semibold">
                <i class="fas fa-plus mr-2"></i>Nouveau Ticket
            </a>
        </div>

        @if($tickets->count() > 0)
            <div class="space-y-4">
                @foreach($tickets as $ticket)
                    <a href="{{ route('tickets.show', $ticket) }}" class="glass-card hover-lift transition-smooth block">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-xl font-bold text-gray-900">{{ $ticket->subject }}</h3>
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $ticket->status === 'open' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                        {{ $ticket->status === 'open' ? 'Ouvert' : 'Fermé' }}
                                    </span>
                                </div>
                                <p class="text-gray-600 mb-3">{{ Str::limit($ticket->description, 150) }}</p>
                                <div class="flex items-center gap-6 text-sm text-gray-500">
                                    <span>
                                        <i class="fas fa-clock mr-2"></i>
                                        Créé {{ $ticket->created_at->diffForHumans() }}
                                    </span>
                                    @if($ticket->admin_response)
                                        <span class="text-green-600 font-semibold">
                                            <i class="fas fa-reply mr-2"></i>
                                            Répondu
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <i class="fas fa-chevron-right text-2xl text-gray-400"></i>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $tickets->links() }}
            </div>
        @else
            <div class="glass-card text-center py-16">
                <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Aucun Ticket</h3>
                <p class="text-gray-600 mb-6">Vous n'avez pas encore créé de ticket de support</p>
                <a href="{{ route('tickets.create') }}" class="inline-block px-8 py-4 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-smooth font-bold">
                    <i class="fas fa-plus mr-2"></i>Créer un Ticket
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
