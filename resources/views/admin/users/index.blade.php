@extends('admin.layouts.app')

@section('page-title', 'Gestion des Utilisateurs')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-800">
        <i class="fas fa-users mr-2 text-blue-600"></i>
        Utilisateurs
    </h1>
    <a href="{{ route('admin.users.create') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-smooth hover-lift font-semibold">
        <i class="fas fa-plus mr-2"></i>Nouvel Utilisateur
    </a>
</div>

@if($users->count() > 0)
    <div class="glass-card">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Nom</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Email</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Rôle</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Inscription</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-smooth">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-800">{{ $user->name }}</p>
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold 
                                    {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : '' }}
                                    {{ $user->role === 'formateur' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $user->role === 'client' ? 'bg-green-100 text-green-800' : '' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ $user->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.users.show', $user) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded transition-smooth" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.users.edit', $user) }}" class="p-2 text-yellow-600 hover:bg-yellow-50 rounded transition-smooth" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded transition-smooth" title="Supprimer">
                                                <i class="fas fa-trash"></i>
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
            {{ $users->links() }}
        </div>
    </div>
@else
    <div class="glass-card text-center py-16">
        <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Aucun utilisateur</h3>
    </div>
@endif

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
    <div class="neo-card text-center">
        <i class="fas fa-user-shield text-4xl text-red-500 mb-3"></i>
        <h3 class="text-2xl font-bold text-gray-900">{{ $users->where('role', 'admin')->count() }}</h3>
        <p class="text-gray-600">Administrateurs</p>
    </div>

    <div class="neo-card text-center">
        <i class="fas fa-chalkboard-teacher text-4xl text-blue-500 mb-3"></i>
        <h3 class="text-2xl font-bold text-gray-900">{{ $users->where('role', 'formateur')->count() }}</h3>
        <p class="text-gray-600">Formateurs</p>
    </div>

    <div class="neo-card text-center">
        <i class="fas fa-user-graduate text-4xl text-green-500 mb-3"></i>
        <h3 class="text-2xl font-bold text-gray-900">{{ $users->where('role', 'client')->count() }}</h3>
        <p class="text-gray-600">Étudiants</p>
    </div>
</div>
@endsection
