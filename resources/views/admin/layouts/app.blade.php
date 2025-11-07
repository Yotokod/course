<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    
    <!-- Sortable.js for drag and drop -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 antialiased">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white">
            <div class="p-6">
                <h1 class="text-2xl font-bold">
                    <i class="fas fa-graduation-cap mr-2"></i>
                    Admin Panel
                </h1>
            </div>
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 border-l-4 border-purple-500' : '' }}">
                    <i class="fas fa-dashboard mr-3"></i>
                    Dashboard
                </a>
                <a href="{{ route('admin.modules.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.modules.*') ? 'bg-gray-800 border-l-4 border-purple-500' : '' }}">
                    <i class="fas fa-book mr-3"></i>
                    Modules
                </a>
                <a href="{{ route('admin.chapters.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.chapters.*') ? 'bg-gray-800 border-l-4 border-purple-500' : '' }}">
                    <i class="fas fa-list mr-3"></i>
                    Chapitres
                </a>
                <a href="{{ route('admin.lessons.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.lessons.*') ? 'bg-gray-800 border-l-4 border-purple-500' : '' }}">
                    <i class="fas fa-file-alt mr-3"></i>
                    Leçons
                </a>
                <a href="{{ route('admin.quizzes.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.quizzes.*') ? 'bg-gray-800 border-l-4 border-purple-500' : '' }}">
                    <i class="fas fa-question-circle mr-3"></i>
                    Quiz
                </a>
                <div class="border-t border-gray-700 my-4"></div>
                <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 hover:bg-gray-800">
                    <i class="fas fa-home mr-3"></i>
                    Retour au site
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center px-6 py-3 hover:bg-gray-800 w-full text-left">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        Déconnexion
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="px-8 py-4 flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-gray-800">
                        @yield('page-title', 'Dashboard')
                    </h2>
                    <div class="flex items-center gap-4">
                        <span class="text-gray-600">{{ Auth::user()->name }}</span>
                        <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-semibold">
                            {{ ucfirst(Auth::user()->role) }}
                        </span>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-8">
                @if(session('success'))
                    <div class="glass bg-green-50 border-l-4 border-green-500 p-4 mb-6" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            <p class="text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="glass bg-red-50 border-l-4 border-red-500 p-4 mb-6" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                            <p class="text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
