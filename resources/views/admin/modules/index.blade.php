@extends('admin.layouts.app')

@section('page-title', 'Gestion des Modules')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-800">
        <i class="fas fa-book mr-2 text-purple-600"></i>
        Modules de Formation
    </h1>
    <a href="{{ route('admin.modules.create') }}" class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-smooth hover-lift font-semibold">
        <i class="fas fa-plus mr-2"></i>Créer un Module
    </a>
</div>

@if($modules->count() > 0)
    <div class="glass-card">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Nom</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Prix</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Chapitres</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Créé par</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Statut</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($modules as $module)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-smooth">
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $module->name }}</p>
                                    @if($module->description)
                                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($module->description, 60) }}</p>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ number_format($module->price, 0, ',', ' ') }} FCFA
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                                    {{ $module->chapters->count() }} chapitres
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ $module->creator->name }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $module->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $module->is_published ? 'Publié' : 'Brouillon' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.modules.show', $module) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded transition-smooth" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.modules.edit', $module) }}" class="p-2 text-yellow-600 hover:bg-yellow-50 rounded transition-smooth" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.modules.destroy', $module) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce module ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded transition-smooth" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-200">
            {{ $modules->links() }}
        </div>
    </div>
@else
    <div class="glass-card text-center py-16">
        <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Aucun module</h3>
        <p class="text-gray-600 mb-6">Commencez par créer votre premier module de formation</p>
        <a href="{{ route('admin.modules.create') }}" class="inline-block px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-smooth font-semibold">
            <i class="fas fa-plus mr-2"></i>Créer un Module
        </a>
    </div>
@endif
@endsection
