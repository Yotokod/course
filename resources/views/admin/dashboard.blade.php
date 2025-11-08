@extends('admin.layouts.app')

@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Modules -->
    <div class="glass-card hover-lift transition-smooth">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Modules</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['total_modules'] }}</h3>
            </div>
            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center">
                <i class="fas fa-book text-2xl text-purple-600"></i>
            </div>
        </div>
    </div>

    <!-- Total Users -->
    <div class="glass-card hover-lift transition-smooth">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Étudiants</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['total_users'] }}</h3>
            </div>
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                <i class="fas fa-users text-2xl text-blue-600"></i>
            </div>
        </div>
    </div>

    <!-- Total Purchases -->
    <div class="glass-card hover-lift transition-smooth">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Achats</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['total_purchases'] }}</h3>
            </div>
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                <i class="fas fa-shopping-cart text-2xl text-green-600"></i>
            </div>
        </div>
    </div>

    <!-- Revenue -->
    <div class="glass-card hover-lift transition-smooth">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Revenus</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ number_format($stats['revenue'], 0, ',', ' ') }} FCFA</h3>
            </div>
            <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center">
                <i class="fas fa-coins text-2xl text-yellow-600"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Modules -->
    <div class="glass-card">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-800">
                <i class="fas fa-book mr-2 text-purple-600"></i>
                Modules Récents
            </h3>
            <a href="{{ route('admin.modules.create') }}" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-smooth">
                <i class="fas fa-plus mr-2"></i>Nouveau
            </a>
        </div>

        @if($recent_modules->count() > 0)
            <div class="space-y-4">
                @foreach($recent_modules as $module)
                    <div class="neo-inset p-4 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-800">{{ $module->name }}</h4>
                                <p class="text-sm text-gray-600 mt-1">
                                    Par {{ $module->creator->name }} • {{ number_format($module->price, 0) }} FCFA
                                </p>
                            </div>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $module->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $module->is_published ? 'Publié' : 'Brouillon' }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.modules.index') }}" class="text-purple-600 hover:text-purple-800 font-medium">
                    Voir tous les modules <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        @else
            <p class="text-gray-500 text-center py-8">
                <i class="fas fa-inbox text-4xl mb-4 block text-gray-300"></i>
                Aucun module pour le moment
            </p>
        @endif
    </div>

    <!-- Recent Tickets -->
    <div class="glass-card">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-800">
                <i class="fas fa-ticket-alt mr-2 text-red-600"></i>
                Tickets Ouverts
            </h3>
            <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-semibold">
                {{ $stats['open_tickets'] }}
            </span>
        </div>

        @if($recent_tickets->count() > 0)
            <div class="space-y-4">
                @foreach($recent_tickets as $ticket)
                    <div class="neo-inset p-4 rounded-lg">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-800">{{ $ticket->subject }}</h4>
                                <p class="text-sm text-gray-600 mt-1">
                                    Par {{ $ticket->user->name }} • {{ $ticket->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $ticket->status === 'open' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                {{ $ticket->status === 'open' ? 'Ouvert' : 'Fermé' }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center py-8">
                <i class="fas fa-check-circle text-4xl mb-4 block text-green-300"></i>
                Aucun ticket ouvert
            </p>
        @endif
    </div>
</div>

<!-- Quick Actions -->
<div class="mt-8 glass-card">
    <h3 class="text-xl font-bold text-gray-800 mb-6">
        <i class="fas fa-bolt mr-2 text-yellow-600"></i>
        Actions Rapides
    </h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('admin.modules.create') }}" class="neo-button text-center p-6 hover-lift transition-smooth">
            <i class="fas fa-plus-circle text-3xl text-purple-600 mb-2 block"></i>
            <span class="font-semibold text-gray-800">Créer Module</span>
        </a>
        <a href="{{ route('admin.modules.index') }}" class="neo-button text-center p-6 hover-lift transition-smooth">
            <i class="fas fa-list text-3xl text-blue-600 mb-2 block"></i>
            <span class="font-semibold text-gray-800">Voir Modules</span>
        </a>
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.users.index') }}" class="neo-button text-center p-6 hover-lift transition-smooth">
                <i class="fas fa-users text-3xl text-green-600 mb-2 block"></i>
                <span class="font-semibold text-gray-800">Gérer Utilisateurs</span>
            </a>
        @endif
        <a href="{{ route('admin.tickets.index') }}" class="neo-button text-center p-6 hover-lift transition-smooth">
            <i class="fas fa-ticket-alt text-3xl text-red-600 mb-2 block"></i>
            <span class="font-semibold text-gray-800">Voir Tickets</span>
        </a>
    </div>
</div>
@endsection
