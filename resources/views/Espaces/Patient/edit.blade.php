@extends('Layout.app')

@section('title', 'Modifier le patient - ' . $patient->nom . ' ' . $patient->prenom)

@section('content')
<!-- Conteneur principal avec marges latérales -->
<div class="mx-4 sm:mx-8 md:mx-12 lg:mx-16 xl:mx-20 2xl:mx-24">
    <!-- Affichage des messages de succès -->
    @if(session('success'))
        <div class="mb-8 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-2xl p-6 shadow-lg animate-pulse">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-green-200 rounded-full flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-green-800">Succès !</h3>
                    <p class="text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Affichage des messages d'erreur -->
    @if(session('error'))
        <div class="mb-8 bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 rounded-2xl p-6 shadow-lg">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-gradient-to-br from-red-100 to-red-200 rounded-full flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-red-800">Erreur !</h3>
                    <p class="text-red-700">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- En-tête de la page avec gradient -->
    <div class="relative mb-8">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-600 opacity-10 rounded-3xl"></div>
        <div class="relative bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="flex-1">
                    <h1 class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        Modifier le patient
                    </h1>
                    <p class="text-gray-600 mt-3 text-lg">Modifiez les informations de {{ $patient->nom }} {{ $patient->prenom }}</p>
                    <div class="flex items-center mt-4 space-x-4">
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span>Patient: {{ $patient->nom }} {{ $patient->prenom }}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Dernière modification: {{ $patient->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0 flex space-x-3">
                    <a href="{{ route('patients.show', $patient->id_patient) }}" class="group inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-2xl hover:bg-gray-200 transition-all duration-300 transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <span>Voir détails</span>
                    </a>
                    <a href="{{ route('patients.index') }}" class="group inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-2xl hover:bg-gray-200 transition-all duration-300 transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        <span>Retour</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire principal -->
    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
        <form method="POST" action="{{ route('patients.update', $patient->id_patient) }}" class="p-8">
            @csrf
            @method('PUT')
            <input type="hidden" name="id_medecin" value="{{ $patient->id_medecin }}">
            
            <!-- Informations personnelles -->
            <div class="mb-8">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">👤 Informations personnelles</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Nom -->
                    <div class="group">
                        <label for="nom" class="block text-sm font-semibold text-gray-700 mb-3 group-hover:text-blue-600 transition-colors duration-300">
                            Nom <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nom" name="nom" value="{{ old('nom', $patient->nom) }}" required
                               placeholder="Ex: Benali"
                               class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all duration-300 group-hover:border-blue-300">
                        @error('nom')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Prénom -->
                    <div class="group">
                        <label for="prenom" class="block text-sm font-semibold text-gray-700 mb-3 group-hover:text-blue-600 transition-colors duration-300">
                            Prénom <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="prenom" name="prenom" value="{{ old('prenom', $patient->prenom) }}" required
                               placeholder="Ex: Sarah"
                               class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all duration-300 group-hover:border-blue-300">
                        @error('prenom')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sexe -->
                    <div class="group">
                        <label for="sexe" class="block text-sm font-semibold text-gray-700 mb-3 group-hover:text-blue-600 transition-colors duration-300">
                            Sexe <span class="text-red-500">*</span>
                        </label>
                        <select id="sexe" name="sexe" required
                                class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all duration-300 group-hover:border-blue-300">
                            <option value="">Sélectionner le sexe</option>
                            <option value="M" {{ (old('sexe', $patient->sexe) == 'M') ? 'selected' : '' }}>👨 Masculin</option>
                            <option value="F" {{ (old('sexe', $patient->sexe) == 'F') ? 'selected' : '' }}>👩 Féminin</option>
                        </select>
                        @error('sexe')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Âge -->
                    <div class="group">
                        <label for="age" class="block text-sm font-semibold text-gray-700 mb-3 group-hover:text-blue-600 transition-colors duration-300">
                            Âge <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="age" name="age" value="{{ old('age', $patient->age) }}" required min="0" max="150"
                               placeholder="Ex: 45"
                               class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all duration-300 group-hover:border-blue-300">
                        @error('age')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Paramètres médicaux -->
            <div class="mb-8">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-purple-200 rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">🏥 Paramètres médicaux</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Glucose -->
                    <div class="group">
                        <label for="glucose" class="block text-sm font-semibold text-gray-700 mb-3 group-hover:text-purple-600 transition-colors duration-300">
                            Taux de glucose (mg/dL) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="glucose" name="glucose" value="{{ old('glucose', $patient->glucose) }}" required min="0" max="1000"
                               placeholder="Ex: 120"
                               class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-purple-100 focus:border-purple-400 transition-all duration-300 group-hover:border-purple-300">
                        <p class="text-xs text-gray-500 mt-1">Valeurs normales: 70-140 mg/dL</p>
                        @error('glucose')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- IMC -->
                    <div class="group">
                        <label for="bmi" class="block text-sm font-semibold text-gray-700 mb-3 group-hover:text-purple-600 transition-colors duration-300">
                            IMC (kg/m²) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="bmi" name="bmi" value="{{ old('bmi', $patient->bmi) }}" required min="0" max="100"
                               placeholder="Ex: 25"
                               class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-purple-100 focus:border-purple-400 transition-all duration-300 group-hover:border-purple-300">
                        <p class="text-xs text-gray-500 mt-1">Valeurs normales: 18.5-24.9 kg/m²</p>
                        @error('bmi')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pression artérielle -->
                    <div class="group">
                        <label for="blood_pressure" class="block text-sm font-semibold text-gray-700 mb-3 group-hover:text-purple-600 transition-colors duration-300">
                            Pression artérielle (mmHg) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="blood_pressure" name="blood_pressure" value="{{ old('blood_pressure', $patient->blood_pressure) }}" required min="0" max="300"
                               placeholder="Ex: 120"
                               class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-purple-100 focus:border-purple-400 transition-all duration-300 group-hover:border-purple-300">
                        <p class="text-xs text-gray-500 mt-1">Valeurs normales: 90-140 mmHg</p>
                        @error('blood_pressure')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Historique familial -->
                    <div class="group">
                        <label for="pedigree" class="block text-sm font-semibold text-gray-700 mb-3 group-hover:text-purple-600 transition-colors duration-300">
                            Historique familial <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="pedigree" name="pedigree" value="{{ old('pedigree', $patient->pedigree) }}" required min="0" max="10"
                               placeholder="Ex: 2"
                               class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-purple-100 focus:border-purple-400 transition-all duration-300 group-hover:border-purple-300">
                        <p class="text-xs text-gray-500 mt-1">Nombre de parents diabétiques (0-10)</p>
                        @error('pedigree')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Résultat -->
                    <div class="group">
                        <label for="result" class="block text-sm font-semibold text-gray-700 mb-3 group-hover:text-purple-600 transition-colors duration-300">
                            Diagnostic <span class="text-red-500">*</span>
                        </label>
                        <select id="result" name="result" required
                                class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-purple-100 focus:border-purple-400 transition-all duration-300 group-hover:border-purple-300">
                            <option value="">Sélectionner le diagnostic</option>
                            <option value="0" {{ (old('result', $patient->result) == '0') ? 'selected' : '' }}>🟢 Non diabétique</option>
                            <option value="1" {{ (old('result', $patient->result) == '1') ? 'selected' : '' }}>🔴 Diabétique</option>
                        </select>
                        @error('result')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t border-gray-200">
                <button type="submit" class="flex-1 group inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-2xl shadow-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl">
                    <svg class="w-6 h-6 mr-3 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span class="text-lg">Enregistrer les modifications</span>
                </button>
                
                <a href="{{ route('patients.show', $patient->id_patient) }}" class="flex-1 group inline-flex items-center justify-center px-8 py-4 bg-gray-100 text-gray-700 font-semibold rounded-2xl hover:bg-gray-200 transition-all duration-300 transform hover:-translate-y-1">
                    <svg class="w-6 h-6 mr-3 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    <span class="text-lg">Annuler</span>
                </a>
            </div>
        </form>
    </div>

    <!-- Informations supplémentaires -->
    <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Résumé des modifications -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">📋 Résumé des modifications</h3>
            </div>
            <div class="space-y-4">
                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-xl">
                    <span class="text-gray-600">Date de création:</span>
                    <span class="font-semibold text-gray-900">{{ $patient->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-xl">
                    <span class="text-gray-600">Dernière modification:</span>
                    <span class="font-semibold text-gray-900">{{ $patient->updated_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-xl">
                    <span class="text-gray-600">Médecin responsable:</span>
                    <span class="font-semibold text-gray-900">Dr. {{ Auth::user()->name }}</span>
                </div>
            </div>
        </div>

        <!-- Guide de validation -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">ℹ️ Guide de validation</h3>
            </div>
            <div class="space-y-3 text-sm text-gray-600">
                <div class="flex items-start">
                    <span class="text-red-500 mr-2">•</span>
                    <span>Les champs marqués d'un astérisque (*) sont obligatoires</span>
                </div>
                <div class="flex items-start">
                    <span class="text-blue-500 mr-2">•</span>
                    <span>L'âge doit être entre 0 et 150 ans</span>
                </div>
                <div class="flex items-start">
                    <span class="text-blue-500 mr-2">•</span>
                    <span>Le glucose doit être entre 0 et 1000 mg/dL</span>
                </div>
                <div class="flex items-start">
                    <span class="text-blue-500 mr-2">•</span>
                    <span>L'IMC doit être entre 0 et 100 kg/m²</span>
                </div>
                <div class="flex items-start">
                    <span class="text-blue-500 mr-2">•</span>
                    <span>La pression artérielle doit être entre 0 et 300 mmHg</span>
                </div>
                <div class="flex items-start">
                    <span class="text-blue-500 mr-2">•</span>
                    <span>L'historique familial doit être entre 0 et 10</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script pour les animations -->
<style>
/* Garantir que les boutons restent toujours visibles */
button, a {
    visibility: visible !important;
    opacity: 1 !important;
    transform: none !important;
}

/* Animation spécifique pour les sections sans affecter les boutons */
.mb-8 {
    transition: all 0.6s ease;
}

.mb-8 button,
.mb-8 a {
    transition: none !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-dissipation des messages de succès et d'erreur
    const successMessages = document.querySelectorAll('[class*="from-green-50"]');
    const errorMessages = document.querySelectorAll('[class*="from-red-50"]');
    
    [...successMessages, ...errorMessages].forEach(message => {
        setTimeout(() => {
            message.style.transition = 'all 0.5s ease';
            message.style.opacity = '0';
            message.style.transform = 'translateY(-10px)';
            setTimeout(() => {
                message.remove();
            }, 500);
        }, 5000); // Disparaît après 5 secondes
    });

    // Animation d'entrée pour les sections (sans affecter les boutons)
    const sections = document.querySelectorAll('.mb-8');
    sections.forEach((section, index) => {
        // Rendre les boutons immédiatement visibles
        const buttons = section.querySelectorAll('button, a');
        buttons.forEach(button => {
            button.style.opacity = '1';
            button.style.transform = 'translateY(0)';
            button.style.visibility = 'visible';
        });
        
        // Animation rapide pour le reste de la section
        section.style.opacity = '0';
        section.style.transform = 'translateY(20px)';
        setTimeout(() => {
            section.style.transition = 'all 0.4s ease';
            section.style.opacity = '1';
            section.style.transform = 'translateY(0)';
        }, index * 100); // Réduit le délai
    });

    // Validation en temps réel
    const inputs = document.querySelectorAll('input[type="number"]');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            const value = parseInt(this.value);
            const min = parseInt(this.min);
            const max = parseInt(this.max);
            
            if (value < min || value > max) {
                this.classList.add('border-red-400', 'focus:border-red-400', 'focus:ring-red-100');
                this.classList.remove('border-gray-200', 'focus:border-blue-400', 'focus:ring-blue-100');
            } else {
                this.classList.remove('border-red-400', 'focus:border-red-400', 'focus:ring-red-100');
                this.classList.add('border-gray-200', 'focus:border-blue-400', 'focus:ring-blue-100');
            }
        });
    });
});
</script>
@endsection
