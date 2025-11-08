@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">
                <i class="fas fa-question-circle mr-3 text-purple-600"></i>
                Questions Fréquentes (FAQ)
            </h1>
            <p class="text-xl text-gray-600">Trouvez des réponses à vos questions</p>
        </div>

        <div class="space-y-6">
            <div class="glass-card" x-data="{ open: false }">
                <button @click="open = !open" class="w-full flex items-center justify-between text-left">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-chevron-right mr-2 text-purple-600 transition-transform" :class="open ? 'rotate-90' : ''"></i>
                        Comment puis-je accéder à un cours?
                    </h3>
                </button>
                <div x-show="open" x-collapse class="mt-4 pl-8 text-gray-700">
                    Pour accéder à un cours, vous devez d'abord créer un compte, puis entrer le code d'accès fourni lors de votre achat. Une fois validé, vous aurez accès à tous les contenus du module.
                </div>
            </div>

            <div class="glass-card" x-data="{ open: false }">
                <button @click="open = !open" class="w-full flex items-center justify-between text-left">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-chevron-right mr-2 text-purple-600 transition-transform" :class="open ? 'rotate-90' : ''"></i>
                        Combien de temps dure un code d'accès?
                    </h3>
                </button>
                <div x-show="open" x-collapse class="mt-4 pl-8 text-gray-700">
                    Les codes d'accès sont généralement valides pour 30 jours à partir de la date d'achat. Après activation, vous avez un accès illimité au contenu pendant la durée de validité.
                </div>
            </div>

            <div class="glass-card" x-data="{ open: false }">
                <button @click="open = !open" class="w-full flex items-center justify-between text-left">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-chevron-right mr-2 text-purple-600 transition-transform" :class="open ? 'rotate-90' : ''"></i>
                        Comment suivre ma progression?
                    </h3>
                </button>
                <div x-show="open" x-collapse class="mt-4 pl-8 text-gray-700">
                    Votre progression est automatiquement enregistrée. Vous pouvez consulter votre tableau de bord de progression depuis votre profil pour voir les leçons complétées et vos scores aux quiz.
                </div>
            </div>

            <div class="glass-card" x-data="{ open: false }">
                <button @click="open = !open" class="w-full flex items-center justify-between text-left">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-chevron-right mr-2 text-purple-600 transition-transform" :class="open ? 'rotate-90' : ''"></i>
                        Que se passe-t-il si j'échoue à un quiz?
                    </h3>
                </button>
                <div x-show="open" x-collapse class="mt-4 pl-8 text-gray-700">
                    Vous pouvez retenter les quiz autant de fois que nécessaire. Le score minimal de passage est de 70%. Continuez à étudier le contenu de la leçon et réessayez!
                </div>
            </div>

            <div class="glass-card" x-data="{ open: false }">
                <button @click="open = !open" class="w-full flex items-center justify-between text-left">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-chevron-right mr-2 text-purple-600 transition-transform" :class="open ? 'rotate-90' : ''"></i>
                        Comment contacter le support?
                    </h3>
                </button>
                <div x-show="open" x-collapse class="mt-4 pl-8 text-gray-700">
                    Vous pouvez créer un ticket de support depuis votre tableau de bord, ou nous contacter via la page de contact. Notre équipe vous répondra dans les plus brefs délais.
                </div>
            </div>

            <div class="glass-card" x-data="{ open: false }">
                <button @click="open = !open" class="w-full flex items-center justify-between text-left">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-chevron-right mr-2 text-purple-600 transition-transform" :class="open ? 'rotate-90' : ''"></i>
                        Puis-je télécharger les cours?
                    </h3>
                </button>
                <div x-show="open" x-collapse class="mt-4 pl-8 text-gray-700">
                    Les cours sont accessibles en ligne via votre navigateur. Certains contenus peuvent être disponibles au téléchargement selon les paramètres définis par le formateur.
                </div>
            </div>
        </div>

        <div class="mt-12 text-center glass-card">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Vous ne trouvez pas de réponse?</h3>
            <p class="text-gray-600 mb-6">Notre équipe est là pour vous aider!</p>
            <a href="{{ route('contact') }}" class="inline-block px-8 py-4 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-smooth font-bold">
                <i class="fas fa-envelope mr-2"></i>Nous Contacter
            </a>
        </div>
    </div>
</div>
@endsection
