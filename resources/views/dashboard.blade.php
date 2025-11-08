<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Banner -->
            <div class="glass-card mb-8 gradient-bg-primary">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-white mb-2">
                            Bienvenue, {{ Auth::user()->name }} ! 👋
                        </h3>
                        <p class="text-white opacity-90">
                            Continuez votre parcours d'apprentissage
                        </p>
                    </div>
                    <div class="hidden md:block">
                        <i class="fas fa-user-graduate text-6xl text-white opacity-50"></i>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                @php
                    $myCourses = \App\Models\AccessCode::where('user_id', Auth::id())->count();
                    $completedLessons = \App\Models\UserProgress::where('user_id', Auth::id())->where('completed', true)->count();
                    $myTickets = \App\Models\Ticket::where('user_id', Auth::id())->count();
                    $openTickets = \App\Models\Ticket::where('user_id', Auth::id())->where('status', 'open')->count();
                @endphp

                <div class="neo-card text-center">
                    <i class="fas fa-book text-4xl text-purple-600 mb-3"></i>
                    <h3 class="text-3xl font-bold text-gray-900">{{ $myCourses }}</h3>
                    <p class="text-gray-600">Mes Cours</p>
                </div>

                <div class="neo-card text-center">
                    <i class="fas fa-check-circle text-4xl text-green-600 mb-3"></i>
                    <h3 class="text-3xl font-bold text-gray-900">{{ $completedLessons }}</h3>
                    <p class="text-gray-600">Leçons Complétées</p>
                </div>

                <div class="neo-card text-center">
                    <i class="fas fa-ticket-alt text-4xl text-blue-600 mb-3"></i>
                    <h3 class="text-3xl font-bold text-gray-900">{{ $myTickets }}</h3>
                    <p class="text-gray-600">Mes Tickets</p>
                </div>

                <div class="neo-card text-center">
                    <i class="fas fa-clock text-4xl text-yellow-600 mb-3"></i>
                    <h3 class="text-3xl font-bold text-gray-900">{{ $openTickets }}</h3>
                    <p class="text-gray-600">En Attente</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- My Recent Courses -->
                <div class="glass-card">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900">
                            <i class="fas fa-book-reader mr-2 text-purple-600"></i>
                            Mes Cours Récents
                        </h3>
                        <a href="{{ route('student.courses.my') }}" class="text-purple-600 hover:text-purple-800 font-medium">
                            Voir tout <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>

                    @php
                        $recentCourses = \App\Models\AccessCode::where('user_id', Auth::id())
                            ->with('module')
                            ->latest()
                            ->take(3)
                            ->get();
                    @endphp

                    @if($recentCourses->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentCourses as $accessCode)
                                <a href="{{ route('courses.show', $accessCode->module) }}" class="block neo-inset p-4 rounded-lg hover-lift transition-smooth">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <h4 class="font-bold text-gray-800">{{ $accessCode->module->name }}</h4>
                                            <p class="text-sm text-gray-600 mt-1">
                                                @if($accessCode->isExpired())
                                                    <span class="text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>Expiré</span>
                                                @else
                                                    <span class="text-green-600"><i class="fas fa-check-circle mr-1"></i>Actif</span>
                                                @endif
                                            </p>
                                        </div>
                                        <i class="fas fa-chevron-right text-gray-400"></i>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-gray-500 py-12">
                            <i class="fas fa-inbox text-4xl mb-4 block text-gray-300"></i>
                            Aucun cours. Explorez notre catalogue!
                        </p>
                    @endif
                </div>

                <!-- My Recent Tickets -->
                <div class="glass-card">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900">
                            <i class="fas fa-headset mr-2 text-blue-600"></i>
                            Support Récent
                        </h3>
                        <a href="{{ route('tickets.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                            Voir tout <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>

                    @php
                        $recentTickets = \App\Models\Ticket::where('user_id', Auth::id())
                            ->latest()
                            ->take(3)
                            ->get();
                    @endphp

                    @if($recentTickets->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentTickets as $ticket)
                                <a href="{{ route('tickets.show', $ticket) }}" class="block neo-inset p-4 rounded-lg hover-lift transition-smooth">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <h4 class="font-bold text-gray-800">{{ $ticket->subject }}</h4>
                                            <p class="text-sm text-gray-600 mt-1">
                                                {{ $ticket->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $ticket->status === 'open' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                            {{ $ticket->status === 'open' ? 'Ouvert' : 'Fermé' }}
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-gray-500 py-12">
                            <i class="fas fa-check-circle text-4xl mb-4 block text-green-300"></i>
                            Aucun ticket de support
                        </p>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-8 glass-card">
                <h3 class="text-xl font-bold text-gray-900 mb-6">
                    <i class="fas fa-bolt mr-2 text-yellow-600"></i>
                    Actions Rapides
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="{{ route('courses.index') }}" class="neo-button text-center p-6 hover-lift transition-smooth">
                        <i class="fas fa-search text-3xl text-purple-600 mb-2 block"></i>
                        <span class="font-semibold text-gray-800">Explorer Cours</span>
                    </a>
                    <a href="{{ route('student.courses.my') }}" class="neo-button text-center p-6 hover-lift transition-smooth">
                        <i class="fas fa-book text-3xl text-blue-600 mb-2 block"></i>
                        <span class="font-semibold text-gray-800">Mes Cours</span>
                    </a>
                    <a href="{{ route('tickets.create') }}" class="neo-button text-center p-6 hover-lift transition-smooth">
                        <i class="fas fa-plus-circle text-3xl text-green-600 mb-2 block"></i>
                        <span class="font-semibold text-gray-800">Créer Ticket</span>
                    </a>
                    <a href="{{ route('profile.edit') }}" class="neo-button text-center p-6 hover-lift transition-smooth">
                        <i class="fas fa-user-cog text-3xl text-red-600 mb-2 block"></i>
                        <span class="font-semibold text-gray-800">Mon Profil</span>
                    </a>
                </div>
            </div>

            <!-- Learning Tips -->
            <div class="mt-8 neo-card bg-blue-50 border-l-4 border-blue-500">
                <div class="flex items-start">
                    <i class="fas fa-lightbulb text-blue-500 text-3xl mr-4 mt-1"></i>
                    <div>
                        <h4 class="font-semibold text-blue-800 mb-2 text-lg">Conseil du Jour</h4>
                        <p class="text-blue-700">
                            Essayez de compléter au moins une leçon par jour pour maintenir votre progression. La régularité est la clé de la réussite! 🎯
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
