@extends('Layout.app')

@section('title', 'Ajouter un patient')

@section('content')
<!-- Conteneur principal avec marges latérales -->
<div class="mx-4 sm:mx-8 md:mx-12 lg:mx-16 xl:mx-20 2xl:mx-24">
    <!-- En-tête de la page avec gradient -->
    <div class="relative mb-8">
        <div class="absolute inset-0 bg-gradient-to-r from-teal-500 via-blue-500 to-purple-600 opacity-10 rounded-3xl"></div>
        <div class="relative bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="flex-1">
                    <h1 class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-teal-600 to-blue-600 bg-clip-text text-transparent">
                        Nouveau patient
                    </h1>
                    <p class="text-gray-600 mt-3 text-lg">Ajoutez un nouveau patient à votre base de données</p>
                    <div class="flex items-center mt-4 space-x-4">
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                            </svg>
                            <span>Médecin: Dr. {{ Auth::user()->name }}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ now()->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <a href="{{ route('patients.index') }}" class="group inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-2xl hover:bg-gray-200 transition-all duration-300 transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        <span>Retour à la liste</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire principal -->
    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
        <form method="POST" action="{{ route('patients.store') }}" class="p-8">
            @csrf
            <input type="hidden" name="id_medecin" value="{{ Auth::user()->id }}">
            
            <!-- Informations personnelles -->
            <div class="mb-8">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-teal-100 to-teal-200 rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">👤 Informations personnelles</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Nom -->
                    <div class="group">
                        <label for="nom" class="block text-sm font-semibold text-gray-700 mb-3 group-hover:text-teal-600 transition-colors duration-300">
                            Nom <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required
                               placeholder="Ex: Benali"
                               class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-teal-100 focus:border-teal-400 transition-all duration-300 group-hover:border-teal-300">
                        @error('nom')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Prénom -->
                    <div class="group">
                        <label for="prenom" class="block text-sm font-semibold text-gray-700 mb-3 group-hover:text-teal-600 transition-colors duration-300">
                            Prénom <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="prenom" name="prenom" value="{{ old('prenom') }}" required
                               placeholder="Ex: Sarah"
                               class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-teal-100 focus:border-teal-400 transition-all duration-300 group-hover:border-teal-300">
                        @error('prenom')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sexe -->
                    <div class="group">
                        <label for="sexe" class="block text-sm font-semibold text-gray-700 mb-3 group-hover:text-teal-600 transition-colors duration-300">
                            Sexe <span class="text-red-500">*</span>
                        </label>
                        <select id="sexe" name="sexe" required
                                class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-teal-100 focus:border-teal-400 transition-all duration-300 group-hover:border-teal-300">
                            <option value="">Sélectionner le sexe</option>
                            <option value="M" {{ old('sexe') == 'M' ? 'selected' : '' }}>👨 Masculin</option>
                            <option value="F" {{ old('sexe') == 'F' ? 'selected' : '' }}>👩 Féminin</option>
                        </select>
                        @error('sexe')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Âge -->
                    <div class="group">
                        <label for="age" class="block text-sm font-semibold text-gray-700 mb-3 group-hover:text-teal-600 transition-colors duration-300">
                            Âge <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="age" name="age" value="{{ old('age') }}" required min="0" max="120"
                               placeholder="Ex: 45"
                               class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-teal-100 focus:border-teal-400 transition-all duration-300 group-hover:border-teal-300">
                        @error('age')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Données médicales -->
            <div class="mb-8">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">🩺 Données médicales</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Glucose -->
                    <div class="group">
                        <label for="glucose" class="block text-sm font-semibold text-gray-700 mb-3 group-hover:text-blue-600 transition-colors duration-300">
                            Glucose (mg/dL) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="number" id="glucose" name="glucose" value="{{ old('glucose') }}" required step="0.1" min="0"
                                   placeholder="Ex: 120.5"
                                   class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all duration-300 group-hover:border-blue-300">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">mg/dL</span>
                            </div>
                        </div>
                        @error('glucose')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- BMI -->
                    <div class="group">
                        <label for="bmi" class="block text-sm font-semibold text-gray-700 mb-3 group-hover:text-blue-600 transition-colors duration-300">
                            BMI (kg/m²) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="number" id="bmi" name="bmi" value="{{ old('bmi') }}" required step="0.1" min="0"
                                   placeholder="Ex: 25.3"
                                   class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all duration-300 group-hover:border-blue-300">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">kg/m²</span>
                            </div>
                        </div>
                        @error('bmi')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pression artérielle -->
                    <div class="group">
                        <label for="blood_pressure" class="block text-sm font-semibold text-gray-700 mb-3 group-hover:text-blue-600 transition-colors duration-300">
                            Pression artérielle (mmHg) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" id="blood_pressure" name="blood_pressure" value="{{ old('blood_pressure') }}" required
                                   placeholder="Ex: 120/80"
                                   class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all duration-300 group-hover:border-blue-300">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">mmHg</span>
                            </div>
                        </div>
                        @error('blood_pressure')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Historique familial (Pedigree) -->
                    <div class="group">
                        <label for="pedigree" class="block text-sm font-semibold text-gray-700 mb-3 group-hover:text-blue-600 transition-colors duration-300">
                            Historique familial <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="pedigree" name="pedigree" value="{{ old('pedigree') }}" required min="0" step="0.01"
                               placeholder="Ex: 0, 0.5, 1.2"
                               class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all duration-300 group-hover:border-blue-300">
                        @error('pedigree')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Résultat du diagnostic -->
            {{-- Champ résultat supprimé car il n'est plus utilisé --}}

            <!-- Boutons d'action -->
            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                <button type="submit" class="flex-1 group inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-teal-600 to-blue-600 text-white font-semibold rounded-2xl shadow-lg hover:from-teal-700 hover:to-blue-700 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl">
                    <svg class="w-6 h-6 mr-3 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    <span class="text-lg">Ajouter le patient</span>
                </button>
                
                <a href="{{ route('patients.index') }}" class="flex-1 group inline-flex items-center justify-center px-8 py-4 bg-gray-100 text-gray-700 font-semibold rounded-2xl hover:bg-gray-200 transition-all duration-300 transform hover:-translate-y-1">
                    <svg class="w-6 h-6 mr-3 group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    <span class="text-lg">Annuler</span>
                </a>
            </div>
        </form>
    </div>

    <!-- Informations d'aide -->
    <div class="mt-8 bg-gradient-to-r from-blue-50 to-teal-50 border border-blue-200 rounded-2xl p-6">
        <div class="flex items-start">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-800 mb-2">💡 Conseils pour remplir le formulaire</h3>
                <ul class="text-blue-700 space-y-1 text-sm">
                    <li>• <strong>Glucose :</strong> Valeur normale entre 70-140 mg/dL</li>
                    <li>• <strong>BMI :</strong> Normal entre 18.5-24.9 kg/m²</li>
                    <li>• <strong>Pression artérielle :</strong> Format "systolique/diastolique" (ex: 120/80)</li>
                    <li>• <strong>Pedigree :</strong> 0=aucun antécédent, 1=antécédent familial, 2=antécédents multiples</li>
                    <li>• <strong>Résultat :</strong> 0=non diabétique, 1=diabétique</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Script pour les animations -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation d'entrée pour les sections
    const sections = document.querySelectorAll('.mb-8');
    sections.forEach((section, index) => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(20px)';
        setTimeout(() => {
            section.style.transition = 'all 0.6s ease';
            section.style.opacity = '1';
            section.style.transform = 'translateY(0)';
        }, index * 200);
    });

    // Validation en temps réel pour la pression artérielle
    const bloodPressureInput = document.getElementById('blood_pressure');
    bloodPressureInput.addEventListener('input', function(e) {
        let value = e.target.value;
        // Permettre seulement les chiffres et le slash
        value = value.replace(/[^0-9/]/g, '');
        e.target.value = value;
    });

    // Validation pour l'âge
    const ageInput = document.getElementById('age');
    ageInput.addEventListener('input', function(e) {
        let value = parseInt(e.target.value);
        if (value > 120) {
            e.target.value = 120;
        }
    });

    // Validation pour le glucose
    const glucoseInput = document.getElementById('glucose');
    glucoseInput.addEventListener('input', function(e) {
        let value = parseFloat(e.target.value);
        if (value > 1000) {
            e.target.value = 1000;
        }
    });

    // Validation pour l'IMC
    const bmiInput = document.getElementById('bmi');
    bmiInput.addEventListener('input', function(e) {
        let value = parseFloat(e.target.value);
        if (value > 100) {
            e.target.value = 100;
        }
    });
});
</script>
@endsection

