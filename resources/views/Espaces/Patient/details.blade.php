@extends('Layout.app')

@section('title', 'Détails du patient - ' . $patient->nom . ' ' . $patient->prenom)

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

    <!-- En-tête avec informations du patient -->
    <div class="relative mb-8">
        <div class="absolute inset-0 bg-gradient-to-r from-teal-500 via-blue-500 to-purple-600 opacity-10 rounded-3xl"></div>
        <div class="relative bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="flex items-center">
                    <!-- Avatar du patient -->
                    <div class="w-24 h-24 bg-gradient-to-br from-teal-100 to-blue-200 rounded-full flex items-center justify-center mr-6 shadow-lg">
                        <span class="text-3xl font-bold text-teal-700">{{ strtoupper(substr($patient->prenom, 0, 1) . substr($patient->nom, 0, 1)) }}</span>
                    </div>
                    
                    <!-- Informations principales -->
                    <div class="flex-1">
                        <div class="flex items-center mb-2">
                            <h1 class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-teal-600 to-blue-600 bg-clip-text text-transparent">
                                {{ $patient->prenom }} {{ $patient->nom }}
                            </h1>
                            @php
                                if(isset($lastPrediction) && $lastPrediction) {
                                    $statusColor = $lastPrediction->result == 1 ? 'bg-red-100 text-red-800 border-red-300' : 'bg-green-100 text-green-800 border-green-300';
                                    $statusText = $lastPrediction->result == 1 ? 'Diabétique' : 'Non diabétique';
                                    $statusIcon = $lastPrediction->result == 1 ? '🔴' : '🟢';
                                } else {
                                    $statusColor = 'bg-gray-100 text-gray-800 border-gray-300';
                                    $statusText = 'Aucune analyse AI';
                                    $statusIcon = '❔';
                                }
                            @endphp
                            <span class="ml-4 inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold border-2 {{ $statusColor }}">
                                <span class="mr-2">{{ $statusIcon }}</span>
                                {{ $statusText }}
                            </span>
                        </div>
                        
                        <div class="flex items-center space-x-6 text-gray-600">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>{{ $patient->age }} ans</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                </svg>
                                <span>{{ $patient->sexe == 'M' ? 'Masculin' : 'Féminin' }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>Patient depuis {{ $patient->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Boutons d'action -->
                <div class="flex flex-col sm:flex-row gap-3">
                    <button onclick="runAIAnalysis()" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-semibold rounded-xl shadow-lg hover:from-purple-700 hover:to-purple-800 transition-all duration-300 transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                        Analyse AI
                    </button>
                    <a href="{{ route('patients.edit', $patient->id_patient) }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl shadow-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Modifier
                    </a>
                    <a href="{{ route('patients.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all duration-300 transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Retour
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Grille des informations médicales -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Informations personnelles -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-br from-teal-100 to-teal-200 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Informations personnelles</h2>
            </div>
            
            <div class="space-y-4">
                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                    <span class="text-gray-600 font-medium">Nom complet</span>
                    <span class="text-gray-900 font-semibold">{{ $patient->prenom }} {{ $patient->nom }}</span>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                    <span class="text-gray-600 font-medium">Âge</span>
                    <span class="text-gray-900 font-semibold">{{ $patient->age }} ans</span>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                    <span class="text-gray-600 font-medium">Sexe</span>
                    <span class="text-gray-900 font-semibold">{{ $patient->sexe == 'M' ? 'Masculin' : 'Féminin' }}</span>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                    <span class="text-gray-600 font-medium">Date d'enregistrement</span>
                    <span class="text-gray-900 font-semibold">{{ $patient->created_at->format('d/m/Y') }}</span>
                </div>
                <div class="flex justify-between items-center py-3">
                    <span class="text-gray-600 font-medium">Dernière mise à jour</span>
                    <span class="text-gray-900 font-semibold">{{ $patient->updated_at->format('d/m/Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Paramètres médicaux -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Paramètres médicaux</h2>
            </div>
            
            <div class="space-y-4">
                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                    <span class="text-gray-600 font-medium">Glycémie</span>
                    <span class="text-gray-900 font-semibold">{{ $patient->glucose }} mg/dL</span>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                    <span class="text-gray-600 font-medium">IMC</span>
                    <span class="text-gray-900 font-semibold">{{ $patient->bmi }} kg/m²</span>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                    <span class="text-gray-600 font-medium">Pression artérielle</span>
                    <span class="text-gray-900 font-semibold">{{ $patient->blood_pressure }} mmHg</span>
                </div>
                <div class="flex justify-between items-center py-3">
                    <span class="text-gray-600 font-medium">Fonction de pedigree</span>
                    <span class="text-gray-900 font-semibold">{{ $patient->pedigree }}</span>
                </div>
            </div>
        </div>

        <!-- Diagnostic et statut -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-purple-200 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Diagnostic</h2>
            </div>
            <div class="space-y-4">
                @if(isset($lastPrediction) && $lastPrediction)
                    <div class="text-center p-6 rounded-xl {{ $lastPrediction->result == 1 ? 'bg-red-50 border-2 border-red-200' : 'bg-green-50 border-2 border-green-200' }}">
                        <div class="text-4xl mb-2">{{ $lastPrediction->result == 1 ? '🔴' : '🟢' }}</div>
                        <h3 class="text-xl font-bold {{ $lastPrediction->result == 1 ? 'text-red-800' : 'text-green-800' }} mb-2">
                            {{ $lastPrediction->result == 1 ? 'Diabétique' : 'Non diabétique' }}
                        </h3>
                        <p class="text-sm {{ $lastPrediction->result == 1 ? 'text-red-600' : 'text-green-600' }}">
                            {{ $lastPrediction->result == 1 ? 'Risque de diabète détecté' : 'Aucun risque de diabète détecté' }}
                        </p>
                    </div>
                @else
                    <div class="text-center p-6 rounded-xl bg-gray-50 border-2 border-gray-200">
                        <div class="text-4xl mb-2">❔</div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">
                            Aucune analyse AI disponible
                        </h3>
                        <p class="text-sm text-gray-600">Cliquez sur <b>Analyse AI</b> pour obtenir un diagnostic.</p>
                        <button onclick="runAIAnalysis()" class="mt-4 px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-semibold rounded-xl shadow-lg hover:from-purple-700 hover:to-purple-800 transition-all duration-300 transform hover:-translate-y-1">
                            Lancer l'analyse AI
                        </button>
                    </div>
                @endif
                <div class="bg-gray-50 rounded-xl p-4">
                    <h4 class="font-semibold text-gray-900 mb-2">Recommandations</h4>
                    <ul class="text-sm text-gray-600 space-y-1">
                        @if(isset($lastPrediction) && $lastPrediction && $lastPrediction->result == 1)
                            <li>• Surveillance glycémique régulière</li>
                            <li>• Consultation médicale recommandée</li>
                            <li>• Adaptation du mode de vie</li>
                        @elseif(isset($lastPrediction) && $lastPrediction)
                            <li>• Maintenir un mode de vie sain</li>
                            <li>• Contrôles préventifs annuels</li>
                            <li>• Surveillance des facteurs de risque</li>
                        @else
                            <li>Aucune recommandation disponible. Lancez une analyse AI.</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques et analyses -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Évolution des paramètres -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Analyse des paramètres</h2>
                <div class="flex space-x-2">
                    <span class="px-3 py-1 bg-teal-100 text-teal-800 rounded-full text-sm font-medium">Glycémie</span>
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">IMC</span>
                </div>
            </div>
            
            <div class="space-y-4">
                <!-- Glycémie -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-gray-600">Glycémie ({{ $patient->glucose }} mg/dL)</span>
                        <span class="text-sm font-semibold {{ $patient->glucose > 126 ? 'text-red-600' : ($patient->glucose > 100 ? 'text-yellow-600' : 'text-green-600') }}">
                            {{ $patient->glucose > 126 ? 'Élevée' : ($patient->glucose > 100 ? 'Normale haute' : 'Normale') }}
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="h-3 rounded-full {{ $patient->glucose > 126 ? 'bg-red-500' : ($patient->glucose > 100 ? 'bg-yellow-500' : 'bg-green-500') }}" 
                             style="width: {{ min(100, ($patient->glucose / 200) * 100) }}%"></div>
                    </div>
                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                        <span>70</span>
                        <span>100</span>
                        <span>126</span>
                        <span>200+</span>
                    </div>
                </div>

                <!-- IMC -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-gray-600">IMC ({{ $patient->bmi }} kg/m²)</span>
                        <span class="text-sm font-semibold {{ $patient->bmi > 30 ? 'text-red-600' : ($patient->bmi > 25 ? 'text-yellow-600' : 'text-green-600') }}">
                            {{ $patient->bmi > 30 ? 'Obésité' : ($patient->bmi > 25 ? 'Surpoids' : 'Normal') }}
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="h-3 rounded-full {{ $patient->bmi > 30 ? 'bg-red-500' : ($patient->bmi > 25 ? 'bg-yellow-500' : 'bg-green-500') }}" 
                             style="width: {{ min(100, ($patient->bmi / 40) * 100) }}%"></div>
                    </div>
                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                        <span>18.5</span>
                        <span>25</span>
                        <span>30</span>
                        <span>40+</span>
                    </div>
                </div>

                <!-- Pression artérielle -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-gray-600">Pression ({{ $patient->blood_pressure }} mmHg)</span>
                        <span class="text-sm font-semibold {{ $patient->blood_pressure > 140 ? 'text-red-600' : ($patient->blood_pressure > 130 ? 'text-yellow-600' : 'text-green-600') }}">
                            {{ $patient->blood_pressure > 140 ? 'Élevée' : ($patient->blood_pressure > 130 ? 'Normale haute' : 'Normale') }}
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="h-3 rounded-full {{ $patient->blood_pressure > 140 ? 'bg-red-500' : ($patient->blood_pressure > 130 ? 'bg-yellow-500' : 'bg-green-500') }}" 
                             style="width: {{ min(100, ($patient->blood_pressure / 200) * 100) }}%"></div>
                    </div>
                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                        <span>90</span>
                        <span>130</span>
                        <span>140</span>
                        <span>200+</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Historique des prédictions -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-br from-indigo-100 to-indigo-200 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Historique des prédictions</h2>
            </div>
            
            @if($patient->predictions && $patient->predictions->count() > 0)
                <div class="space-y-4">
                    @foreach($patient->predictions->take(5) as $prediction)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full {{ $prediction->result == "1" ? 'bg-red-500' : 'bg-green-500' }} mr-3"></div>
                                <div>
                                    <p class="font-medium text-gray-900">
                                        {{ $prediction->result == "1" ? 'Risque diabétique' : 'Pas de risque' }}
                                    </p>
                                    <p class="text-sm text-gray-500">{{ $prediction->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                            <span class="text-sm font-semibold {{ $prediction->result == "1" ? 'text-red-600' : 'text-green-600' }}">
                                {{ $prediction->result == "1" ? 'Positif' : 'Négatif' }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Aucun historique</h3>
                    <p class="text-gray-500">Aucune prédiction antérieure disponible pour ce patient.</p>
                </div>
            @endif
        </div>
    </div>


</div>

<!-- Modal d'analyse AI -->
<div id="aiModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full transform transition-all duration-300 scale-95 opacity-0" id="aiModalContent">
        <!-- En-tête de la modal -->
        <div class="relative p-8 border-b border-gray-100">
            <div class="flex items-center justify-center mb-6">
                <div class="w-20 h-20 bg-gradient-to-br from-purple-100 to-purple-200 rounded-full flex items-center justify-center">
                    <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 text-center mb-2">Analyse AI - Diagnostic Diabète</h3>
            <p class="text-gray-600 text-center">Analyse intelligente des paramètres du patient {{ $patient->prenom }} {{ $patient->nom }}</p>
        </div>

        <!-- Contenu de la modal -->
        <div class="p-8">
            <!-- Écran de chargement -->
            <div id="aiLoading" class="text-center py-12">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-100 to-purple-200 rounded-full flex items-center justify-center mx-auto mb-6 animate-pulse">
                    <svg class="w-8 h-8 text-purple-600 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                </div>
                <h4 class="text-xl font-semibold text-gray-900 mb-2">Analyse en cours...</h4>
                <p class="text-gray-500">L'IA analyse les paramètres du patient pour évaluer le risque de diabète</p>
            </div>

            <!-- Résultats de l'analyse -->
            <div id="aiResult" class="hidden">
                <!-- Paramètres analysés -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                    <div class="bg-blue-50 rounded-xl p-4 text-center">
                        <div class="text-2xl font-bold text-blue-600">{{ $patient->glucose }}</div>
                        <div class="text-sm text-blue-700">Glycémie (mg/dL)</div>
                    </div>
                    <div class="bg-green-50 rounded-xl p-4 text-center">
                        <div class="text-2xl font-bold text-green-600">{{ $patient->bmi }}</div>
                        <div class="text-sm text-green-700">IMC (kg/m²)</div>
                    </div>
                    <div class="bg-yellow-50 rounded-xl p-4 text-center">
                        <div class="text-2xl font-bold text-yellow-600">{{ $patient->age }}</div>
                        <div class="text-sm text-yellow-700">Âge (ans)</div>
                    </div>
                    <div class="bg-red-50 rounded-xl p-4 text-center">
                        <div class="text-2xl font-bold text-red-600">{{ $patient->blood_pressure }}</div>
                        <div class="text-sm text-red-700">Pression (mmHg)</div>
                    </div>
                </div>

                <!-- Résultat principal -->
                <div class="bg-gradient-to-r from-purple-50 to-blue-50 border border-purple-200 rounded-xl p-6 mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-xl font-bold text-gray-900">Résultat de l'analyse AI</h4>
                        <div class="flex items-center space-x-2">
                            <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-medium">
                                Score: <span id="aiRiskScore" class="font-bold">0/8</span>
                            </span>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-purple-600 mb-2">
                            Risque <span id="aiRiskLevel" class="text-purple-800">Faible</span>
                        </div>
                        <p class="text-gray-600">Basé sur l'analyse des paramètres médicaux</p>
                    </div>
                </div>

                <!-- Résultat de la dernière prédiction enregistrée -->
                @if(isset($lastPrediction) && $lastPrediction)
                <div class="bg-white border border-green-200 rounded-xl p-4 mb-4 text-center">
                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Résultat sauvegardé</h4>
                    <span class="text-xl font-bold {{ $lastPrediction->result == "1" ? 'text-red-600' : 'text-green-600' }}">
                        {{ $lastPrediction->result == "1" ? 'Diabétique' : 'Non diabétique' }}
                    </span>
                    <div class="text-sm text-gray-500 mt-1">
                        Prédiction enregistrée le {{ $lastPrediction->created_at->format('d/m/Y H:i') }}
                    </div>
                </div>
                @endif

                <!-- Recommandations -->
                <div class="bg-white border border-gray-200 rounded-xl p-6">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4">📋 Recommandations AI</h4>
                    <ul id="aiRecommendations" class="text-gray-700 space-y-2">
                        <!-- Les recommandations seront ajoutées dynamiquement -->
                    </ul>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="flex justify-end mt-8">
                <button onclick="closeAIModal()" class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all duration-300 transform hover:-translate-y-1">
                    Fermer
                </button>
            </div>
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
                        <p class="text-sm text-red-700">Toutes les données du patient seront définitivement supprimées, y compris son historique médical et ses prédictions.</p>
                    </div>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="flex flex-col sm:flex-row gap-3">
                <button onclick="closeDeleteModal()" class="flex-1 px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all duration-300 transform hover:-translate-y-1">
                    Annuler
                </button>
                <form id="deleteForm" method="POST" action="{{route('patients.destroy',$patient->id_patient)}}" class="flex-1">
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
<style>
/* Garantir que les boutons restent toujours visibles */
button, a {
    visibility: visible !important;
    opacity: 1 !important;
    transform: none !important;
}

/* Animation spécifique pour les cartes sans affecter les boutons */
.grid > div {
    transition: all 0.4s ease;
}

.grid > div button,
.grid > div a {
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

    // Animation d'entrée pour les cartes (sans affecter les boutons)
    const cards = document.querySelectorAll('.grid > div');
    cards.forEach((card, index) => {
        // Rendre les boutons immédiatement visibles
        const buttons = card.querySelectorAll('button, a');
        buttons.forEach(button => {
            button.style.opacity = '1';
            button.style.transform = 'translateY(0)';
            button.style.visibility = 'visible';
        });
        
        // Animation rapide pour le reste de la carte
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.4s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 50); // Réduit le délai
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
        closeAIModal();
    }
});

// Fonction pour l'analyse AI
function runAIAnalysis() {
    const modal = document.getElementById('aiModal');
    const modalContent = document.getElementById('aiModalContent');
    const loadingDiv = document.getElementById('aiLoading');
    const resultDiv = document.getElementById('aiResult');
    
    // Afficher la modal avec animation
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    setTimeout(() => {
        modalContent.style.transform = 'scale(1)';
        modalContent.style.opacity = '1';
    }, 10);
    
    // Afficher l'écran de chargement
    loadingDiv.classList.remove('hidden');
    resultDiv.classList.add('hidden');
    
    // Appeler l'API Laravel qui communique avec l'API Python
    fetch('{{ route("patients.predict", $patient->id_patient) }}')
        .then(response => response.json())
        .then(data => {
            // Masquer le chargement et afficher les résultats
            loadingDiv.classList.add('hidden');
            resultDiv.classList.remove('hidden');
            
            if (data.success) {
                // Utiliser les données de l'API Python
                const apiData = data.data;
                const patient = data.patient;
                
                // Déterminer le niveau de risque basé sur le cluster
                let riskLevel = '';
                let riskScore = 0;
                let recommendations = [];
                
                // Mapping des clusters vers les niveaux de risque
                const clusterRiskMapping = {
                    0: { level: 'Faible', score: 2, color: 'green' },
                    1: { level: 'Élevé', score: 7, color: 'red' },
                    2: { level: 'Modéré', score: 4, color: 'yellow' },
                    3: { level: 'Élevé', score: 8, color: 'red' },
                    4: { level: 'Modéré', score: 5, color: 'orange' }
                };
                
                const clusterInfo = clusterRiskMapping[apiData.cluster] || { level: 'Inconnu', score: 0, color: 'gray' };
                
                // Définir les recommandations basées sur le niveau de risque
                if (clusterInfo.level === 'Élevé') {
                    recommendations = [
                        'Consultation médicale urgente recommandée',
                        'Surveillance glycémique quotidienne',
                        'Modification du mode de vie immédiate',
                        'Tests de laboratoire complets',
                        'Suivi médical régulier'
                    ];
                } else if (clusterInfo.level === 'Modéré') {
                    recommendations = [
                        'Consultation médicale recommandée',
                        'Surveillance glycémique régulière',
                        'Amélioration de l\'alimentation',
                        'Activité physique régulière',
                        'Contrôles préventifs'
                    ];
                } else {
                    recommendations = [
                        'Maintenir un mode de vie sain',
                        'Contrôles préventifs annuels',
                        'Surveillance des facteurs de risque',
                        'Alimentation équilibrée',
                        'Activité physique modérée'
                    ];
                }
                
                // Mettre à jour l'affichage
                document.getElementById('aiRiskLevel').textContent = clusterInfo.level;
                document.getElementById('aiRiskScore').textContent = clusterInfo.score + '/8';
                document.getElementById('aiRecommendations').innerHTML = recommendations.map(rec => `<li class="mb-2">• ${rec}</li>`).join('');
                
                // Mettre à jour les paramètres affichés
                document.querySelector('.bg-blue-50 .text-2xl').textContent = patient.glucose;
                document.querySelector('.bg-green-50 .text-2xl').textContent = patient.bmi;
                document.querySelector('.bg-yellow-50 .text-2xl').textContent = patient.age;
                document.querySelector('.bg-red-50 .text-2xl').textContent = patient.pedigree;
                
            } else {
                // En cas d'erreur, afficher un message d'erreur
                document.getElementById('aiRiskLevel').textContent = 'Erreur';
                document.getElementById('aiRiskScore').textContent = 'N/A';
                document.getElementById('aiRecommendations').innerHTML = `
                    <li class="mb-2 text-red-600">• Erreur de connexion à l'API</li>
                    <li class="mb-2 text-red-600">• Vérifiez que l'API Python est démarrée</li>
                    <li class="mb-2 text-red-600">• Contactez l'administrateur</li>
                `;
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            loadingDiv.classList.add('hidden');
            resultDiv.classList.remove('hidden');
            
            document.getElementById('aiRiskLevel').textContent = 'Erreur';
            document.getElementById('aiRiskScore').textContent = 'N/A';
            document.getElementById('aiRecommendations').innerHTML = `
                <li class="mb-2 text-red-600">• Erreur de connexion à l'API</li>
                <li class="mb-2 text-red-600">• Vérifiez que l'API Python est démarrée</li>
                <li class="mb-2 text-red-600">• Contactez l'administrateur</li>
            `;
        });
}

// Fonction pour fermer la modal AI
function closeAIModal() {
    const modal = document.getElementById('aiModal');
    const modalContent = document.getElementById('aiModalContent');
    
    // Animation de fermeture
    modalContent.style.transform = 'scale(0.95)';
    modalContent.style.opacity = '0';
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 300);
}

// Fermer la modal AI en cliquant sur l'arrière-plan
document.getElementById('aiModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeAIModal();
    }
});
</script>
@endsection
