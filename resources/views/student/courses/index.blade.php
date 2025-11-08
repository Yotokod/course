@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">
                <i class="fas fa-graduation-cap mr-3 text-purple-600"></i>
                Catalogue de Cours
            </h1>
            <p class="text-xl text-gray-600">Découvrez nos formations en ligne pour développer vos compétences</p>
        </div>

        @if($modules->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($modules as $module)
                    <div class="glass-card hover-lift transition-smooth">
                        <!-- Module Image Placeholder -->
                        <div class="h-48 gradient-bg-primary rounded-t-lg flex items-center justify-center">
                            <i class="fas fa-book text-6xl text-white opacity-75"></i>
                        </div>

                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $module->name }}</h3>
                            
                            @if($module->description)
                                <p class="text-gray-600 mb-4">{{ Str::limit($module->description, 120) }}</p>
                            @endif

                            <div class="flex items-center justify-between mb-4">
                                <span class="text-2xl font-bold text-purple-600">
                                    {{ number_format($module->price, 0, ',', ' ') }} FCFA
                                </span>
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                                    <i class="fas fa-book-open mr-1"></i>
                                    {{ $module->chapters->count() }} chapitres
                                </span>
                            </div>

                            <a href="{{ route('courses.show', $module) }}" class="block w-full text-center px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-smooth font-semibold">
                                <i class="fas fa-arrow-right mr-2"></i>Voir les Détails
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $modules->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Aucun cours disponible</h3>
                <p class="text-gray-600">Les cours seront bientôt disponibles. Revenez plus tard!</p>
            </div>
        @endif
    </div>
</div>
@endsection
