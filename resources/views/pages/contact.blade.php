@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">
                <i class="fas fa-envelope mr-3 text-purple-600"></i>
                Nous Contacter
            </h1>
            <p class="text-xl text-gray-600">Une question? Nous sommes là pour vous aider!</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            <!-- Contact Form -->
            <div class="glass-card">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Envoyez-nous un Message</h2>

                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-user mr-2 text-purple-600"></i>
                            Nom <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name ?? '') }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>

                    <div class="mb-6">
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-envelope mr-2 text-purple-600"></i>
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email ?? '') }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>

                    <div class="mb-6">
                        <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-tag mr-2 text-purple-600"></i>
                            Sujet <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>

                    <div class="mb-6">
                        <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-comment mr-2 text-purple-600"></i>
                            Message <span class="text-red-500">*</span>
                        </label>
                        <textarea name="message" id="message" rows="6" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" class="w-full px-6 py-4 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-smooth font-bold text-lg">
                        <i class="fas fa-paper-plane mr-2"></i>Envoyer le Message
                    </button>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="space-y-6">
                <div class="neo-card">
                    <i class="fas fa-map-marker-alt text-3xl text-purple-600 mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Adresse</h3>
                    <p class="text-gray-700">123 Rue de l'Éducation<br>Ville, Pays<br>Code Postal</p>
                </div>

                <div class="neo-card">
                    <i class="fas fa-phone text-3xl text-blue-600 mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Téléphone</h3>
                    <p class="text-gray-700">+123 456 789 00<br>Lun-Ven: 9h-18h</p>
                </div>

                <div class="neo-card">
                    <i class="fas fa-envelope text-3xl text-green-600 mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Email</h3>
                    <p class="text-gray-700">contact@elearning.com<br>support@elearning.com</p>
                </div>

                <div class="neo-card">
                    <i class="fas fa-headset text-3xl text-red-600 mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Support</h3>
                    <p class="text-gray-700 mb-4">
                        Pour un support technique, créez un ticket depuis votre tableau de bord
                    </p>
                    @auth
                        <a href="{{ route('tickets.create') }}" class="inline-block px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-smooth font-semibold">
                            <i class="fas fa-ticket-alt mr-2"></i>Créer un Ticket
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
