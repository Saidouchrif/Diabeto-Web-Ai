@extends('Layout.app')

@section('title', 'Liste des patients')

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
        <div class="absolute inset-0 bg-gradient-to-r from-teal-500 via-blue-500 to-purple-600 opacity-10 rounded-3xl"></div>
        <div class="relative bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="flex-1">
                    <h1 class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-teal-600 to-blue-600 bg-clip-text text-transparent">
                        Mes patients
                    </h1>
                    <p class="text-gray-600 mt-3 text-lg">Gérez et suivez vos patients diabétiques avec précision</p>
                    <div class="flex items-center mt-4 space-x-4">
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ $patients->count() }} patients enregistrés</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Dernière mise à jour: {{ now()->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <a href="{{route('patient.create')}}" class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-teal-600 to-blue-600 text-white font-semibold rounded-2xl shadow-lg hover:from-teal-700 hover:to-blue-700 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl">
                        <svg class="w-6 h-6 mr-3 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        <span class="text-lg">Nouveau patient</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques avec animations -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="group bg-white rounded-2xl shadow-lg p-6 border-l-4 border-teal-500 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
            <div class="flex items-center">
                <div class="p-4 bg-gradient-to-br from-teal-100 to-teal-200 rounded-xl group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total patients</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $patients->count() }}</p>
                    <p class="text-xs text-teal-600 font-medium">+12% ce mois</p>
                </div>
            </div>
        </div>

        <div class="group bg-white rounded-2xl shadow-lg p-6 border-l-4 border-green-500 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
            <div class="flex items-center">
                <div class="p-4 bg-gradient-to-br from-green-100 to-green-200 rounded-xl group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Stables</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $patients->where('status', 'stable')->count() }}</p>
                    <p class="text-xs text-green-600 font-medium">76% du total</p>
                </div>
            </div>
        </div>

        <div class="group bg-white rounded-2xl shadow-lg p-6 border-l-4 border-yellow-500 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
            <div class="flex items-center">
                <div class="p-4 bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-xl group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">À surveiller</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $patients->where('status', 'surveillance')->count() }}</p>
                    <p class="text-xs text-yellow-600 font-medium">17% du total</p>
                </div>
            </div>
        </div>

        <div class="group bg-white rounded-2xl shadow-lg p-6 border-l-4 border-red-500 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
            <div class="flex items-center">
                <div class="p-4 bg-gradient-to-br from-red-100 to-red-200 rounded-xl group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Critiques</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $patients->where('status', 'critique')->count() }}</p>
                    <p class="text-xs text-red-600 font-medium">7% du total</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres et recherche améliorés -->
    <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Recherche avec animation -->
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-3">🔍 Rechercher un patient</label>
                <div class="relative group">
                    <input type="text" placeholder="Nom, prénom ou numéro de dossier..." 
                           class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-teal-100 focus:border-teal-400 transition-all duration-300 group-hover:border-teal-300">
                    <svg class="absolute right-4 top-1/2 transform -translate-y-1/2 w-6 h-6 text-gray-400 group-focus-within:text-teal-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>

            <!-- Filtre par statut -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">📊 Statut</label>
                <select class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-teal-100 focus:border-teal-400 transition-all duration-300 hover:border-teal-300">
                    <option value="">Tous les statuts</option>
                    <option value="stable">🟢 Stable</option>
                    <option value="surveillance">🟡 À surveiller</option>
                    <option value="critique">🔴 Critique</option>
                </select>
            </div>

            <!-- Filtre par date -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">📅 Dernière visite</label>
                <select class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-teal-100 focus:border-teal-400 transition-all duration-300 hover:border-teal-300">
                    <option value="">Toutes les dates</option>
                    <option value="7">7 derniers jours</option>
                    <option value="30">30 derniers jours</option>
                    <option value="90">3 derniers mois</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Liste des patients avec design amélioré -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="px-8 py-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-gray-900">📋 Patients récents</h2>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-500">Affichage:</span>
                    <select class="text-sm border border-gray-200 rounded-lg px-3 py-1 focus:outline-none focus:ring-2 focus:ring-teal-400">
                        <option>10 par page</option>
                        <option>25 par page</option>
                        <option>50 par page</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <tr>
                        <th class="px-8 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">👤 Nom</th>
                        <th class="px-8 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">👤 Prénom</th>
                        <th class="px-8 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">👥 Sexe</th>
                        <th class="px-8 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">🎂 Âge</th>
                        <th class="px-8 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">🩺 Diagnostic</th>
                        <th class="px-8 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">⚡ Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($patients as $patient)
                    <tr class="hover:bg-gradient-to-r hover:from-teal-50 hover:to-blue-50 transition-all duration-300 group">
                        <td class="px-8 py-6 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-br from-{{ $patient->avatar_color ?? 'teal' }}-100 to-{{ $patient->avatar_color ?? 'teal' }}-200 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                                    <span class="text-lg font-bold text-{{ $patient->avatar_color ?? 'teal' }}-700">{{ $patient->initials ?? 'PA' }}</span>
                                </div>
                                <div class="text-lg font-semibold text-gray-900 group-hover:text-teal-700 transition-colors duration-300">{{ $patient->nom ?? 'Nom' }}</div>
                            </div>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            <div class="text-lg font-semibold text-gray-900 group-hover:text-teal-700 transition-colors duration-300">{{ $patient->prenom ?? 'Prénom' }}</div>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            @php
                                $sexeColor = ($patient->sexe ?? 'M') === 'M' ? 'bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 border-blue-300' : 'bg-gradient-to-r from-pink-100 to-pink-200 text-pink-800 border-pink-300';
                                $sexeIcon = ($patient->sexe ?? 'M') === 'M' ? '👨' : '👩';
                            @endphp
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold border-2 {{ $sexeColor }} group-hover:scale-105 transition-transform duration-300">
                                <span class="mr-2">{{ $sexeIcon }}</span>
                                {{ ($patient->sexe ?? 'M') === 'M' ? 'Masculin' : 'Féminin' }}
                            </span>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span class="text-lg font-semibold text-gray-900 group-hover:text-teal-700 transition-colors duration-300">{{ $patient->age ?? 'N/A' }} ans</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            @php
                                $lastPrediction = $patient->predictions->sortByDesc('created_at')->first();
                                if($lastPrediction) {
                                    $diagColor = $lastPrediction->result == 1 ? 'bg-red-100 text-red-800 border-red-300' : 'bg-green-100 text-green-800 border-green-300';
                                    $diagText = $lastPrediction->result == 1 ? 'Diabétique' : 'Non diabétique';
                                    $diagIcon = $lastPrediction->result == 1 ? '🔴' : '🟢';
                                } else {
                                    $diagColor = 'bg-gray-100 text-gray-700 border-gray-300';
                                    $diagText = 'Non analysé';
                                    $diagIcon = '❔';
                                }
                            @endphp
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold border-2 {{ $diagColor }}">
                                <span class="mr-2">{{ $diagIcon }}</span>
                                {{ $diagText }}
                            </span>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('patients.show', $patient->id_patient) }}" class="inline-flex items-center px-3 py-2 text-teal-600 hover:text-teal-700 hover:bg-teal-50 rounded-lg transition-all duration-300 group-hover:scale-105">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Voir
                                </a>
                                <a href="{{ route('patients.edit', $patient->id_patient) }}" class="inline-flex items-center px-3 py-2 text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-all duration-300 group-hover:scale-105">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Modifier
                                </a>
                                <button type="button" onclick="openDeleteModal('{{ $patient->id_patient ?? 1 }}', '{{ $patient->nom ?? 'Patient' }} {{ $patient->prenom ?? '' }}', '{{ route('patients.destroy', $patient->id_patient ?? 1) }}')" class="inline-flex items-center px-3 py-2 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-all duration-300 group-hover:scale-105 bg-transparent border-none cursor-pointer">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Supprimer
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mb-6">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">Aucun patient trouvé</h3>
                                <p class="text-gray-500 mb-6">Commencez par ajouter votre premier patient</p>
                                <a href="{{ route('patient.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-teal-600 to-blue-600 text-white font-semibold rounded-xl shadow-lg hover:from-teal-700 hover:to-blue-700 transition-all duration-300 transform hover:-translate-y-1">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    Ajouter un patient
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
        <!-- En-tête de la modal -->
        <div class="relative p-8 border-b border-gray-100">
            <div class="flex items-center justify-center mb-6">
                <div class="w-20 h-20 bg-gradient-to-br from-red-100 to-red-200 rounded-full flex items-center justify-center">
                    <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 text-center mb-2">Confirmer la suppression</h3>
            <p class="text-gray-600 text-center">Êtes-vous sûr de vouloir supprimer le patient <span id="patientName" class="font-semibold text-gray-900"></span> ?</p>
            <p class="text-sm text-red-600 text-center mt-2">Cette action est irréversible.</p>
        </div>

        <!-- Contenu de la modal -->
        <div class="p-8">
            <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-red-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                    <div>
                        <h4 class="text-sm font-semibold text-red-800 mb-1">Attention</h4>
                        <p class="text-sm text-red-700">Toutes les données du patient seront définitivement supprimées, y compris son historique médical et ses rendez-vous.</p>
                    </div>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="flex flex-col sm:flex-row gap-3">
                <button onclick="closeDeleteModal()" class="flex-1 px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all duration-300 transform hover:-translate-y-1">
                    Annuler
                </button>
                <form id="deleteForm" method="POST" action="{{route('patients.destroy',$patient->id_patient??"")}}" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold rounded-xl hover:from-red-700 hover:to-red-800 transition-all duration-300 transform hover:-translate-y-1 shadow-lg">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Supprimer définitivement
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script pour les animations et la modal -->
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

    // Animation d'entrée pour les cartes de statistiques
    const cards = document.querySelectorAll('.grid > div');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });

    // Animation pour les lignes du tableau (immédiate pour les boutons)
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach((row, index) => {
        // Rendre les boutons immédiatement visibles
        const buttons = row.querySelectorAll('button, a');
        buttons.forEach(button => {
            button.style.opacity = '1';
            button.style.transform = 'translateX(0)';
        });
        
        // Animation rapide pour le reste de la ligne
        row.style.opacity = '0';
        row.style.transform = 'translateX(-20px)';
        setTimeout(() => {
            row.style.transition = 'all 0.3s ease';
            row.style.opacity = '1';
            row.style.transform = 'translateX(0)';
        }, 100 + (index * 20)); // Réduit le délai
    });
});

// Fonction pour ouvrir la modal de suppression
function openDeleteModal(patientId, patientName, deleteRoute) {
    const modal = document.getElementById('deleteModal');
    const modalContent = document.getElementById('modalContent');
    const patientNameSpan = document.getElementById('patientName');
    const deleteForm = document.getElementById('deleteForm');
    
    // Mettre à jour les données
    patientNameSpan.textContent = patientName;
    deleteForm.action = deleteRoute;
    
    // Afficher la modal avec animation
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    setTimeout(() => {
        modalContent.style.transform = 'scale(1)';
        modalContent.style.opacity = '1';
    }, 10);
}

// Fonction pour fermer la modal de suppression
function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    const modalContent = document.getElementById('modalContent');
    
    // Animation de fermeture
    modalContent.style.transform = 'scale(0.95)';
    modalContent.style.opacity = '0';
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 300);
}

// Fermer la modal en cliquant sur l'arrière-plan
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});

// Fermer la modal avec la touche Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDeleteModal();
    }
});
</script>
@endsection 