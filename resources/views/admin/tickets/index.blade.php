@extends('admin.layouts.app')

@section('page-title', 'Gestion des Tickets')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-800">
        <i class="fas fa-ticket-alt mr-2 text-red-600"></i>
        Tickets de Support
    </h1>
    <div class="flex gap-3">
        <span class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-lg font-semibold">
            <i class="fas fa-clock mr-2"></i>
            {{ $tickets->where('status', 'open')->count() }} Ouverts
        </span>
        <span class="px-4 py-2 bg-green-100 text-green-800 rounded-lg font-semibold">
            <i class="fas fa-check mr-2"></i>
            {{ $tickets->where('status', 'closed')->count() }} Fermés
        </span>
    </div>
</div>

@if($tickets->count() > 0)
    <div class="glass-card">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Sujet</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Utilisateur</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Statut</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Date</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-smooth">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-800">{{ $ticket->subject }}</p>
                                <p class="text-sm text-gray-600 mt-1">{{ Str::limit($ticket->description, 50) }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-user-circle text-gray-400"></i>
                                    <span class="text-gray-700">{{ $ticket->user->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $ticket->status === 'open' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                    <i class="fas fa-{{ $ticket->status === 'open' ? 'clock' : 'check' }} mr-1"></i>
                                    {{ $ticket->status === 'open' ? 'Ouvert' : 'Fermé' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ $ticket->created_at->format('d/m/Y') }}
                                <span class="text-xs text-gray-500 block">{{ $ticket->created_at->diffForHumans() }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.tickets.show', $ticket) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded transition-smooth" title="Voir et Répondre">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($ticket->status === 'open')
                                        <form action="{{ route('admin.tickets.destroy', $ticket) }}" method="POST" class="inline" onsubmit="return confirm('Fermer ce ticket?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-green-600 hover:bg-green-50 rounded transition-smooth" title="Fermer">
                                                <i class="fas fa-check-circle"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-200">
            {{ $tickets->links() }}
        </div>
    </div>
@else
    <div class="glass-card text-center py-16">
        <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Aucun ticket</h3>
        <p class="text-gray-600">Les tickets de support apparaîtront ici</p>
    </div>
@endif
@endsection
