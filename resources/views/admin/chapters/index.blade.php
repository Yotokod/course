@extends('admin.layouts.app')

@section('page-title', 'Gestion des Chapitres')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-800">
        <i class="fas fa-list mr-2 text-purple-600"></i>
        Chapitres
    </h1>
    <a href="{{ route('admin.chapters.create') }}" class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-smooth hover-lift font-semibold">
        <i class="fas fa-plus mr-2"></i>Créer un Chapitre
    </a>
</div>

@if($chapters->count() > 0)
    <div class="glass-card">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Module</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Chapitre</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Ordre</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Leçons</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($chapters as $chapter)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-smooth">
                            <td class="px-6 py-4 text-gray-700">
                                {{ $chapter->module->name }}
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-800">{{ $chapter->name }}</p>
                                @if($chapter->description)
                                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($chapter->description, 60) }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-semibold">
                                    {{ $chapter->order }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                                    {{ $chapter->lessons->count() }} leçons
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.chapters.show', $chapter) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded transition-smooth" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.chapters.edit', $chapter) }}" class="p-2 text-yellow-600 hover:bg-yellow-50 rounded transition-smooth" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.chapters.destroy', $chapter) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr?');">
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
            {{ $chapters->links() }}
        </div>
    </div>
@else
    <div class="glass-card text-center py-16">
        <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Aucun chapitre</h3>
        <p class="text-gray-600 mb-6">Commencez par créer votre premier chapitre</p>
        <a href="{{ route('admin.chapters.create') }}" class="inline-block px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-smooth font-semibold">
            <i class="fas fa-plus mr-2"></i>Créer un Chapitre
        </a>
    </div>
@endif
@endsection
