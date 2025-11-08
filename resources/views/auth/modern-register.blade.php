<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Inscription') }} - {{ config('app.name', 'E-Learning') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body class="antialiased">
    <!-- Full Screen Gradient Background -->
    <div class="min-h-screen gradient-bg-sunset flex items-center justify-center relative overflow-hidden p-4">
        <!-- Animated Background Elements -->
        <div class="absolute top-20 right-10 w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-25 float-animation"></div>
        <div class="absolute bottom-20 left-10 w-96 h-96 bg-yellow-300 rounded-full mix-blend-multiply filter blur-3xl opacity-25 float-animation" style="animation-delay: 1.5s;"></div>
        <div class="absolute top-1/3 left-1/3 w-96 h-96 bg-orange-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 float-animation" style="animation-delay: 0.75s;"></div>

        <!-- Back to Home Link -->
        <a href="{{ route('landing') }}" class="absolute top-6 left-6 glass-button text-white text-sm">
            <i class="fas fa-arrow-left mr-2"></i>Retour à l'accueil
        </a>

        <!-- Register Card -->
        <div class="w-full max-w-md relative z-10">
            <!-- Logo & Title -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full gradient-bg-secondary mb-4 shadow-strong float-animation">
                    <i class="fas fa-user-plus text-3xl text-white"></i>
                </div>
                <h1 class="text-4xl font-bold text-white mb-2">Rejoignez-nous !</h1>
                <p class="text-white opacity-90 text-lg">Créez votre compte en quelques secondes</p>
            </div>

            <!-- Glass Morphism Card -->
            <div class="glass-card backdrop-blur-xl bg-white/10 border border-white/20 p-8 rounded-3xl shadow-2xl">
                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- Name Input -->
                    <div>
                        <label for="name" class="block text-white font-semibold mb-2 text-sm">
                            <i class="fas fa-user mr-2"></i>Nom complet
                        </label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                            class="w-full px-5 py-4 rounded-xl bg-white/20 border border-white/30 text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/50 focus:bg-white/30 transition-all backdrop-blur-sm"
                            placeholder="Jean Dupont">
                        @error('name')
                            <p class="mt-2 text-sm text-red-300 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-white font-semibold mb-2 text-sm">
                            <i class="fas fa-envelope mr-2"></i>Adresse Email
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                            class="w-full px-5 py-4 rounded-xl bg-white/20 border border-white/30 text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/50 focus:bg-white/30 transition-all backdrop-blur-sm"
                            placeholder="jean@example.com">
                        @error('email')
                            <p class="mt-2 text-sm text-red-300 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label for="password" class="block text-white font-semibold mb-2 text-sm">
                            <i class="fas fa-lock mr-2"></i>Mot de passe
                        </label>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            class="w-full px-5 py-4 rounded-xl bg-white/20 border border-white/30 text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/50 focus:bg-white/30 transition-all backdrop-blur-sm"
                            placeholder="••••••••">
                        @error('password')
                            <p class="mt-2 text-sm text-red-300 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Confirm Password Input -->
                    <div>
                        <label for="password_confirmation" class="block text-white font-semibold mb-2 text-sm">
                            <i class="fas fa-lock mr-2"></i>Confirmer le mot de passe
                        </label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                            class="w-full px-5 py-4 rounded-xl bg-white/20 border border-white/30 text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/50 focus:bg-white/30 transition-all backdrop-blur-sm"
                            placeholder="••••••••">
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="flex items-start">
                        <input type="checkbox" required class="mt-1 rounded border-white/30 bg-white/20 text-pink-600 focus:ring-2 focus:ring-white/50 focus:ring-offset-0">
                        <span class="ml-2 text-sm text-white/90">
                            J'accepte les <a href="#" class="underline hover:text-white">conditions d'utilisation</a> et la <a href="#" class="underline hover:text-white">politique de confidentialité</a>
                        </span>
                    </div>

                    <!-- Register Button -->
                    <button type="submit" class="w-full btn-modern gradient-bg-secondary text-white py-4 rounded-xl font-bold text-lg shadow-strong hover:shadow-xl transform hover:scale-[1.02] transition-all">
                        <i class="fas fa-rocket mr-2"></i>Créer mon compte
                    </button>

                    <!-- Divider -->
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-white/20"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 text-white/80 bg-transparent">OU</span>
                        </div>
                    </div>

                    <!-- Login Link -->
                    <div class="text-center">
                        <p class="text-white/90 mb-3">Vous avez déjà un compte ?</p>
                        <a href="{{ route('login') }}" class="inline-block w-full py-4 rounded-xl border-2 border-white/40 text-white font-semibold hover:bg-white/10 hover:border-white/60 transition-all">
                            <i class="fas fa-sign-in-alt mr-2"></i>Se connecter
                        </a>
                    </div>
                </form>
            </div>

            <!-- Benefits -->
            <div class="mt-8 grid grid-cols-3 gap-4 text-center text-white/90 text-xs">
                <div>
                    <i class="fas fa-shield-check text-2xl mb-2 block"></i>
                    <p>100% Sécurisé</p>
                </div>
                <div>
                    <i class="fas fa-infinity text-2xl mb-2 block"></i>
                    <p>Accès Illimité</p>
                </div>
                <div>
                    <i class="fas fa-headset text-2xl mb-2 block"></i>
                    <p>Support 24/7</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
