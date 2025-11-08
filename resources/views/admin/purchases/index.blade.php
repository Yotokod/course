@extends('admin.layouts.app')

@section('page-title', 'Gestion des Achats')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-800">
        <i class="fas fa-shopping-cart mr-2 text-green-600"></i>
        Historique des Achats
    </h1>
    <div class="px-4 py-2 bg-green-100 text-green-800 rounded-lg font-semibold">
        <i class="fas fa-coins mr-2"></i>
        Total: {{ number_format($purchases->sum('amount'), 0, ',', ' ') }} FCFA
    </div>
</div>

@if($purchases->count() > 0)
    <div class="glass-card">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Utilisateur</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Module</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Montant</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Statut</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Date</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($purchases as $purchase)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-smooth">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-user-circle text-gray-400"></i>
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $purchase->user->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $purchase->user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-800">{{ $purchase->module->name }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-lg font-bold text-green-600">
                                    {{ number_format($purchase->amount, 0, ',', ' ') }} FCFA
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold 
                                    {{ $purchase->payment_status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $purchase->payment_status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $purchase->payment_status === 'failed' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ ucfirst($purchase->payment_status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ $purchase->created_at->format('d/m/Y') }}
                                <span class="text-xs text-gray-500 block">{{ $purchase->created_at->diffForHumans() }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.purchases.show', $purchase) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded transition-smooth" title="Voir Détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-200">
            {{ $purchases->links() }}
        </div>
    </div>
@else
    <div class="glass-card text-center py-16">
        <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Aucun achat</h3>
        <p class="text-gray-600">Les achats apparaîtront ici une fois effectués</p>
    </div>
@endif

<!-- Statistics -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
    <div class="neo-card text-center">
        <i class="fas fa-shopping-bag text-4xl text-blue-500 mb-3"></i>
        <h3 class="text-2xl font-bold text-gray-900">{{ $purchases->where('payment_status', 'completed')->count() }}</h3>
        <p class="text-gray-600">Achats Complétés</p>
    </div>

    <div class="neo-card text-center">
        <i class="fas fa-clock text-4xl text-yellow-500 mb-3"></i>
        <h3 class="text-2xl font-bold text-gray-900">{{ $purchases->where('payment_status', 'pending')->count() }}</h3>
        <p class="text-gray-600">En Attente</p>
    </div>

    <div class="neo-card text-center">
        <i class="fas fa-coins text-4xl text-green-500 mb-3"></i>
        <h3 class="text-2xl font-bold text-gray-900">{{ number_format($purchases->where('payment_status', 'completed')->sum('amount'), 0, ',', ' ') }}</h3>
        <p class="text-gray-600">Revenus (FCFA)</p>
    </div>
</div>
@endsection
