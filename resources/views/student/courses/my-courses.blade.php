<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mes Cours') }}
        </h2>
    </x-slot>

<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">
                <i class="fas fa-graduation-cap mr-3 text-purple-600"></i>
                Mes Cours
            </h1>
            <p class="text-xl text-gray-600">Continuez votre apprentissage là où vous l'avez laissé</p>
        </div>

        @if($accessCodes->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($accessCodes as $accessCode)
                    @php
                        $module = $accessCode->module;
                        $totalLessons = $module->chapters->sum(fn($ch) => $ch->lessons->count());
                        // Simple progress calculation - would need real progress data
                        $progress = 0;
                    @endphp

                    <div class="glass-card hover-lift transition-smooth">
                        <!-- Module Image -->
                        <div class="h-48 gradient-bg-primary rounded-t-lg flex items-center justify-center relative">
                            <i class="fas fa-book text-6xl text-white opacity-75"></i>
                            
                            <!-- Status Badge -->
                            @if($accessCode->isExpired())
                                <span class="absolute top-4 right-4 px-3 py-1 bg-red-500 text-white rounded-full text-sm font-bold">
                                    <i class="fas fa-lock mr-1"></i>Expiré
                                </span>
                            @else
                                <span class="absolute top-4 right-4 px-3 py-1 bg-green-500 text-white rounded-full text-sm font-bold">
                                    <i class="fas fa-check mr-1"></i>Actif
                                </span>
                            @endif
                        </div>

                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $module->name }}</h3>
                            
                            @if($module->description)
                                <p class="text-gray-600 mb-4">{{ Str::limit($module->description, 100) }}</p>
                            @endif

                            <!-- Progress Bar -->
                            <div class="mb-4">
                                <div class="flex items-center justify-between text-sm mb-2">
                                    <span class="text-gray-600 font-medium">Progression</span>
                                    <span class="font-bold text-purple-600">{{ $progress }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-purple-600 h-3 rounded-full transition-all" style="width: {{ $progress }}%"></div>
                                </div>
                            </div>

                            <!-- Stats -->
                            <div class="flex items-center justify-between mb-4 text-sm text-gray-600">
                                <span>
                                    <i class="fas fa-book-open mr-1"></i>
                                    {{ $module->chapters->count() }} chapitres
                                </span>
                                <span>
                                    <i class="fas fa-file-alt mr-1"></i>
                                    {{ $totalLessons }} leçons
                                </span>
                            </div>

                            <!-- Access Info -->
                            <div class="mb-4 p-3 bg-gray-50 rounded-lg text-sm">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">Code:</span>
                                    <span class="font-mono font-bold text-gray-900">{{ $accessCode->code }}</span>
                                </div>
                                @if($accessCode->expires_at)
                                    <div class="flex items-center justify-between mt-2">
                                        <span class="text-gray-600">Expire:</span>
                                        <span class="font-semibold {{ $accessCode->isExpired() ? 'text-red-600' : 'text-green-600' }}">
                                            {{ $accessCode->expires_at->format('d/m/Y') }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <!-- Action Button -->
                            @if(!$accessCode->isExpired())
                                <a href="{{ route('courses.show', $module) }}" class="block w-full text-center px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-smooth font-semibold">
                                    <i class="fas fa-play mr-2"></i>Continuer
                                </a>
                            @else
                                <button disabled class="block w-full text-center px-6 py-3 bg-gray-300 text-gray-600 rounded-lg cursor-not-allowed font-semibold">
                                    <i class="fas fa-lock mr-2"></i>Accès Expiré
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 glass-card">
                <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Aucun Cours</h3>
                <p class="text-gray-600 mb-8">Vous n'avez pas encore accès à des cours. Parcourez notre catalogue!</p>
                <a href="{{ route('courses.index') }}" class="inline-block px-8 py-4 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-smooth font-bold text-lg">
                    <i class="fas fa-search mr-2"></i>Explorer les Cours
                </a>
            </div>
        @endif
    </div>
</div>
</x-app-layout>
