<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Connexion') }} - {{ config('app.name', 'E-Learning') }}</title>

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
    <div class="min-h-screen gradient-bg-hero flex items-center justify-center relative overflow-hidden p-4">
        <!-- Animated Background Elements -->
        <div class="absolute top-20 left-10 w-96 h-96 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 float-animation"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-pink-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 float-animation" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-cyan-400 rounded-full mix-blend-multiply filter blur-3xl opacity-15 float-animation" style="animation-delay: 2s;"></div>

        <!-- Back to Home Link -->
        <a href="{{ route('landing') }}" class="absolute top-6 left-6 glass-button text-white text-sm">
            <i class="fas fa-arrow-left mr-2"></i>Retour à l'accueil
        </a>

        <!-- Login Card -->
        <div class="w-full max-w-md relative z-10">
            <!-- Logo & Title -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full gradient-bg-primary mb-4 shadow-strong">
                    <i class="fas fa-graduation-cap text-3xl text-white"></i>
                </div>
                <h1 class="text-4xl font-bold text-white mb-2">Bon retour !</h1>
                <p class="text-white opacity-90 text-lg">Connectez-vous à votre compte</p>
            </div>

            <!-- Glass Morphism Card -->
            <div class="glass-card backdrop-blur-xl bg-white/10 border border-white/20 p-8 rounded-3xl shadow-2xl">
                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-6 p-4 rounded-xl bg-green-500/20 border border-green-500/30 text-white">
                        <i class="fas fa-check-circle mr-2"></i>{{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-white font-semibold mb-2 text-sm">
                            <i class="fas fa-envelope mr-2"></i>Adresse Email
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                            class="w-full px-5 py-4 rounded-xl bg-white/20 border border-white/30 text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/50 focus:bg-white/30 transition-all backdrop-blur-sm"
                            placeholder="votre@email.com">
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
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="w-full px-5 py-4 rounded-xl bg-white/20 border border-white/30 text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/50 focus:bg-white/30 transition-all backdrop-blur-sm"
                            placeholder="••••••••">
                        @error('password')
                            <p class="mt-2 text-sm text-red-300 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="rounded border-white/30 bg-white/20 text-purple-600 focus:ring-2 focus:ring-white/50 focus:ring-offset-0">
                            <span class="ml-2 text-sm text-white">Se souvenir de moi</span>
                        </label>
                        
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-white hover:text-white/80 transition-colors">
                                Mot de passe oublié ?
                            </a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="w-full btn-modern btn-gradient text-white py-4 rounded-xl font-bold text-lg shadow-strong hover:shadow-xl transform hover:scale-[1.02] transition-all">
                        <i class="fas fa-sign-in-alt mr-2"></i>Se Connecter
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

                    <!-- Register Link -->
                    <div class="text-center">
                        <p class="text-white/90 mb-3">Vous n'avez pas de compte ?</p>
                        <a href="{{ route('register') }}" class="inline-block w-full py-4 rounded-xl border-2 border-white/40 text-white font-semibold hover:bg-white/10 hover:border-white/60 transition-all">
                            <i class="fas fa-user-plus mr-2"></i>Créer un compte
                        </a>
                    </div>
                </form>
            </div>

            <!-- Social Proof -->
            <div class="mt-8 text-center text-white/80 text-sm">
                <p><i class="fas fa-shield-alt mr-2"></i>Connexion sécurisée et chiffrée</p>
            </div>
        </div>
    </div>
</body>
</html>
