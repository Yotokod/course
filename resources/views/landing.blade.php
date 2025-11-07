<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'E-Learning Platform') }} - Apprenez en ligne</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Swiper CSS for carousel -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    
    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="antialiased">
    <!-- Hero Section with Glassmorphism -->
    <section class="min-h-screen gradient-bg-hero flex items-center justify-center relative overflow-hidden">
        <!-- Navigation -->
        <nav class="absolute top-0 left-0 right-0 z-50 px-8 py-6">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="text-white text-2xl font-bold">
                    <i class="fas fa-graduation-cap mr-2"></i>
                    E-Learning
                </div>
                <div class="space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="glass-button text-white transition-smooth">
                            <i class="fas fa-dashboard mr-2"></i>Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="glass-button text-white transition-smooth">
                            <i class="fas fa-sign-in-alt mr-2"></i>Connexion
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="glass-button text-white transition-smooth">
                                <i class="fas fa-user-plus mr-2"></i>Inscription
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Hero Content -->
        <div class="glass-hero max-w-4xl mx-auto text-center text-white px-8 hover-lift transition-smooth">
            <h1 class="text-5xl md:text-6xl font-bold mb-6">
                Apprenez en ligne avec nos formations expertes
            </h1>
            <p class="text-xl md:text-2xl mb-8 opacity-90">
                Développez vos compétences avec des cours interactifs, des quiz et un suivi personnalisé
            </p>
            <div class="flex gap-4 justify-center flex-wrap">
                <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-purple-600 rounded-xl font-semibold text-lg hover:shadow-xl transition-smooth hover-lift">
                    <i class="fas fa-rocket mr-2"></i>Commencer Gratuitement
                </a>
                <a href="#features" class="glass-button text-white px-8 py-4 text-lg font-semibold">
                    <i class="fas fa-info-circle mr-2"></i>En savoir plus
                </a>
            </div>
        </div>

        <!-- Decorative elements -->
        <div class="absolute top-20 left-10 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-72 h-72 bg-pink-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse" style="animation-delay: 2s;"></div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-8">
            <h2 class="text-4xl font-bold text-center mb-16 text-gray-800">
                Pourquoi choisir notre plateforme ?
            </h2>
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="neo-card hover-lift transition-smooth text-center">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-purple-100 flex items-center justify-center">
                        <i class="fas fa-book-open text-3xl text-purple-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">Cours Structurés</h3>
                    <p class="text-gray-600">
                        Des modules organisés en chapitres et leçons pour un apprentissage progressif et efficace
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="neo-card hover-lift transition-smooth text-center">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-question-circle text-3xl text-blue-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">Quiz Interactifs</h3>
                    <p class="text-gray-600">
                        Testez vos connaissances avec des quiz MCQ après chaque leçon et suivez votre progression
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="neo-card hover-lift transition-smooth text-center">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-green-100 flex items-center justify-center">
                        <i class="fas fa-chart-line text-3xl text-green-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">Suivi de Progrès</h3>
                    <p class="text-gray-600">
                        Visualisez votre avancement et vos résultats en temps réel avec notre tableau de bord
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="neo-card hover-lift transition-smooth text-center">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-yellow-100 flex items-center justify-center">
                        <i class="fas fa-video text-3xl text-yellow-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">Vidéos HD</h3>
                    <p class="text-gray-600">
                        Accédez à des vidéos de cours de haute qualité disponibles 24/7
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="neo-card hover-lift transition-smooth text-center">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-red-100 flex items-center justify-center">
                        <i class="fas fa-headset text-3xl text-red-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">Support Dédié</h3>
                    <p class="text-gray-600">
                        Notre équipe est là pour vous aider via notre système de tickets
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="neo-card hover-lift transition-smooth text-center">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-indigo-100 flex items-center justify-center">
                        <i class="fas fa-certificate text-3xl text-indigo-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">Certificats</h3>
                    <p class="text-gray-600">
                        Obtenez des certificats validant vos compétences après chaque formation
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 gradient-bg-primary relative overflow-hidden">
        <div class="max-w-4xl mx-auto text-center px-8 relative z-10">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Prêt à commencer votre parcours d'apprentissage ?
            </h2>
            <p class="text-xl text-white opacity-90 mb-8">
                Inscrivez-vous maintenant et accédez à tous nos cours
            </p>
            <a href="{{ route('register') }}" class="inline-block px-12 py-5 bg-white text-purple-600 rounded-xl font-bold text-xl hover:shadow-2xl transition-smooth hover-lift">
                <i class="fas fa-rocket mr-2"></i>Créer mon compte
            </a>
        </div>
        
        <!-- Decorative elements -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full mix-blend-soft-light filter blur-3xl opacity-10"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full mix-blend-soft-light filter blur-3xl opacity-10"></div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-2xl font-bold mb-4">
                        <i class="fas fa-graduation-cap mr-2"></i>E-Learning
                    </h3>
                    <p class="text-gray-400">
                        Votre plateforme de formation en ligne de confiance
                    </p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Liens rapides</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-smooth">Accueil</a></li>
                        <li><a href="#features" class="hover:text-white transition-smooth">Fonctionnalités</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-white transition-smooth">Connexion</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Support</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-smooth">FAQ</a></li>
                        <li><a href="#" class="hover:text-white transition-smooth">Contact</a></li>
                        <li><a href="#" class="hover:text-white transition-smooth">Support</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Suivez-nous</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition-smooth">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition-smooth">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition-smooth">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} E-Learning Platform. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>
</html>
