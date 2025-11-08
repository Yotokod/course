@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero -->
    <div class="gradient-bg-primary py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl font-bold text-white mb-6">À Propos de Nous</h1>
            <p class="text-2xl text-white opacity-90">Votre partenaire pour l'apprentissage en ligne</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Mission -->
        <div class="glass-card mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">
                <i class="fas fa-bullseye mr-3 text-purple-600"></i>
                Notre Mission
            </h2>
            <p class="text-lg text-gray-700 leading-relaxed">
                Notre plateforme e-learning a pour mission de rendre l'éducation accessible à tous, partout et à tout moment. 
                Nous croyons que chacun mérite l'opportunité de développer ses compétences et d'atteindre ses objectifs professionnels 
                grâce à des formations de qualité dispensées par des experts passionnés.
            </p>
        </div>

        <!-- Values -->
        <div class="grid md:grid-cols-3 gap-8 mb-12">
            <div class="neo-card text-center">
                <i class="fas fa-star text-5xl text-yellow-500 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Excellence</h3>
                <p class="text-gray-700">
                    Des contenus de haute qualité créés par des formateurs expérimentés
                </p>
            </div>

            <div class="neo-card text-center">
                <i class="fas fa-users text-5xl text-blue-500 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Communauté</h3>
                <p class="text-gray-700">
                    Une communauté d'apprenants engagés et de formateurs dévoués
                </p>
            </div>

            <div class="neo-card text-center">
                <i class="fas fa-rocket text-5xl text-purple-500 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Innovation</h3>
                <p class="text-gray-700">
                    Des technologies modernes pour une expérience d'apprentissage optimale
                </p>
            </div>
        </div>

        <!-- What We Offer -->
        <div class="glass-card mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">
                <i class="fas fa-gift mr-3 text-purple-600"></i>
                Ce Que Nous Offrons
            </h2>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 text-2xl mr-4 mt-1"></i>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-2">Cours Structurés</h4>
                        <p class="text-gray-700">Des modules organisés en chapitres et leçons pour un apprentissage progressif</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 text-2xl mr-4 mt-1"></i>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-2">Quiz Interactifs</h4>
                        <p class="text-gray-700">Testez vos connaissances avec des quiz après chaque leçon</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 text-2xl mr-4 mt-1"></i>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-2">Suivi de Progression</h4>
                        <p class="text-gray-700">Visualisez votre avancement en temps réel</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 text-2xl mr-4 mt-1"></i>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-2">Support Dédié</h4>
                        <p class="text-gray-700">Une équipe à votre écoute via notre système de tickets</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="text-center glass-card gradient-bg-primary">
            <h3 class="text-3xl font-bold text-white mb-4">Prêt à Commencer?</h3>
            <p class="text-xl text-white opacity-90 mb-8">Rejoignez notre communauté d'apprenants dès aujourd'hui</p>
            <a href="{{ route('register') }}" class="inline-block px-12 py-5 bg-white text-purple-600 rounded-xl font-bold text-xl hover:shadow-2xl transition-smooth">
                <i class="fas fa-user-plus mr-2"></i>Créer un Compte
            </a>
        </div>
    </div>
</div>
@endsection
