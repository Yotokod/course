@extends('admin.layouts.app')

@section('page-title', 'Créer un Quiz')

@section('content')
<div class="max-w-5xl mx-auto" x-data="quizForm()">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.quizzes.index') }}" class="mr-4 text-gray-600 hover:text-gray-800">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <h1 class="text-3xl font-bold text-gray-800">
            <i class="fas fa-plus-circle mr-2 text-green-600"></i>
            Créer un Nouveau Quiz
        </h1>
    </div>

    <form action="{{ route('admin.quizzes.store') }}" method="POST" class="glass-card">
        @csrf

        <div class="mb-6">
            <label for="lesson_id" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-file-alt mr-2 text-green-600"></i>
                Leçon <span class="text-red-500">*</span>
            </label>
            <select name="lesson_id" id="lesson_id" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('lesson_id') border-red-500 @enderror">
                <option value="">Sélectionnez une leçon</option>
                @foreach($lessons as $lesson)
                    <option value="{{ $lesson->id }}" {{ old('lesson_id', request('lesson_id')) == $lesson->id ? 'selected' : '' }}>
                        {{ $lesson->chapter->module->name }} > {{ $lesson->chapter->name }} > {{ $lesson->name }}
                    </option>
                @endforeach
            </select>
            @error('lesson_id')
                <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="question" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-question mr-2 text-green-600"></i>
                Question <span class="text-red-500">*</span>
            </label>
            <textarea name="question" id="question" rows="3" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('question') border-red-500 @enderror"
                placeholder="Posez votre question ici...">{{ old('question') }}</textarea>
            @error('question')
                <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label for="type" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-list mr-2 text-green-600"></i>
                    Type <span class="text-red-500">*</span>
                </label>
                <select name="type" id="type" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <option value="mcq" {{ old('type', 'mcq') == 'mcq' ? 'selected' : '' }}>Choix Multiple (MCQ)</option>
                    <option value="true_false" {{ old('type') == 'true_false' ? 'selected' : '' }}>Vrai/Faux</option>
                </select>
            </div>

            <div>
                <label for="points" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-star mr-2 text-green-600"></i>
                    Points <span class="text-red-500">*</span>
                </label>
                <input type="number" name="points" id="points" value="{{ old('points', 10) }}" min="1" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>
        </div>

        <!-- Options -->
        <div class="mb-6">
            <div class="flex items-center justify-between mb-4">
                <label class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-check-square mr-2 text-green-600"></i>
                    Options de Réponse <span class="text-red-500">*</span>
                </label>
                <button type="button" @click="addOption()" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-smooth text-sm font-semibold">
                    <i class="fas fa-plus mr-2"></i>Ajouter une Option
                </button>
            </div>

            <div class="space-y-3">
                <template x-for="(option, index) in options" :key="index">
                    <div class="flex gap-3 items-start neo-inset p-4 rounded-lg">
                        <div class="flex-1">
                            <input type="text" :name="'options[' + index + '][text]'" x-model="option.text" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                placeholder="Texte de l'option">
                        </div>
                        <label class="flex items-center gap-2 cursor-pointer px-4 py-3">
                            <input type="checkbox" :name="'options[' + index + '][is_correct]'" x-model="option.is_correct" value="1"
                                class="w-5 h-5 text-green-600 border-gray-300 rounded focus:ring-green-500">
                            <span class="text-sm font-medium text-gray-700">Correcte</span>
                        </label>
                        <button type="button" @click="removeOption(index)" x-show="options.length > 2"
                            class="p-3 text-red-600 hover:bg-red-50 rounded transition-smooth">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </template>
            </div>

            <p class="text-sm text-gray-500 mt-2">
                <i class="fas fa-info-circle mr-1"></i>
                Minimum 2 options, maximum 4. Cochez au moins une option comme correcte.
            </p>
        </div>

        <div class="flex gap-4 pt-6 border-t border-gray-200">
            <button type="submit" class="flex-1 px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-smooth font-semibold hover-lift">
                <i class="fas fa-save mr-2"></i>Créer le Quiz
            </button>
            <a href="{{ route('admin.quizzes.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-smooth font-semibold">
                <i class="fas fa-times mr-2"></i>Annuler
            </a>
        </div>
    </form>
</div>

<script>
function quizForm() {
    return {
        options: [
            { text: '', is_correct: false },
            { text: '', is_correct: false }
        ],
        addOption() {
            if (this.options.length < 4) {
                this.options.push({ text: '', is_correct: false });
            }
        },
        removeOption(index) {
            if (this.options.length > 2) {
                this.options.splice(index, 1);
            }
        }
    }
}
</script>
@endsection
