@extends('Layout.app')

@section('title', 'Tableau de bord - Médecin')

@section('content')
<!-- Conteneur principal avec marges équilibrées -->
<div class="mx-6 sm:mx-10 md:mx-16 lg:mx-20 xl:mx-24 2xl:mx-32">
    <!-- Message de bienvenue avec style amélioré -->
    @if(session('success'))
        <div class="mb-8 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-2xl p-6 shadow-lg">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-green-200 rounded-full flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-green-800">Connexion réussie !</h3>
                    <p class="text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- En-tête du tableau de bord avec gradient -->
    <div class="relative mb-8">
        <div class="absolute inset-0 bg-gradient-to-r from-teal-500 via-blue-500 to-purple-600 opacity-10 rounded-3xl"></div>
        <div class="relative bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="flex-1">
                    <h1 class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-teal-600 to-blue-600 bg-clip-text text-transparent mb-3">
                        Tableau de bord
                    </h1>
                    <p class="text-xl text-gray-600">Bienvenue dans votre espace professionnel, <span class="font-semibold text-teal-600">Dr. {{ Auth::user()->name }}</span></p>
                    <div class="flex items-center mt-4 space-x-6">
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Dernière connexion: {{ now()->format('d/m/Y à H:i') }}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Session active</span>
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <div class="w-20 h-20 bg-gradient-to-br from-teal-100 to-blue-100 rounded-full flex items-center justify-center shadow-lg">
                        <svg class="w-10 h-10 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques rapides avec animations -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total patients -->
        <div class="group bg-white rounded-2xl shadow-lg p-6 border-l-4 border-teal-500 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
            <div class="flex items-center">
                <div class="p-4 bg-gradient-to-br from-teal-100 to-teal-200 rounded-xl group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total patients</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $patients->count() ?? 0 }}</p>
                    <p class="text-xs text-teal-600 font-medium">+12% ce mois</p>
                </div>
            </div>
        </div>
        <!-- Répartition par sexe -->
        <div class="group bg-white rounded-2xl shadow-lg p-6 border-l-4 border-green-500 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
            <div class="flex items-center">
                <div class="p-4 bg-gradient-to-br from-green-100 to-green-200 rounded-xl group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Répartition par sexe</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $patients->where('sexe', 'M')->count() }}/{{ $patients->where('sexe', 'F')->count() }}</p>
                    <p class="text-xs text-green-600 font-medium">Hommes/Femmes</p>
                </div>
            </div>
        </div>
        <!-- Diagnostic -->
        <div class="group bg-white rounded-2xl shadow-lg p-6 border-l-4 border-yellow-500 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
            <div class="flex items-center">
                <div class="p-4 bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-xl group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Diagnostic</p>
                    <p class="text-3xl font-bold text-gray-900">
                        @php
                            $diabetiques = 0;
                            $nonDiabetiques = 0;
                            foreach($patients as $patient) {
                                $lastPrediction = $patient->predictions->sortByDesc('created_at')->first();
                                if($lastPrediction) {
                                    if($lastPrediction->result == 1) {
                                        $diabetiques++;
                                    } else {
                                        $nonDiabetiques++;
                                    }
                                }
                            }
                        @endphp
                        {{ $diabetiques }}/{{ $nonDiabetiques }}
                    </p>
                    <p class="text-xs text-yellow-600 font-medium">Diabétique/Non diabétique</p>
                </div>
            </div>
        </div>
        <!-- Sans diagnostic -->
        <div class="group bg-white rounded-2xl shadow-lg p-6 border-l-4 border-red-500 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
            <div class="flex items-center">
                <div class="p-4 bg-gradient-to-br from-red-100 to-red-200 rounded-xl group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Sans diagnostic</p>
                    <p class="text-3xl font-bold text-gray-900">
                        @php
                            $sansDiagnostic = 0;
                            foreach($patients as $patient) {
                                $lastPrediction = $patient->predictions->sortByDesc('created_at')->first();
                                if(!$lastPrediction) {
                                    $sansDiagnostic++;
                                }
                            }
                        @endphp
                        {{ $sansDiagnostic }}
                    </p>
                    <p class="text-xs text-red-600 font-medium">Pas d'analyse AI</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions rapides et rendez-vous -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Actions principales avec style amélioré -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <div class="flex items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">⚡ Actions rapides</h2>
                <div class="ml-auto w-8 h-8 bg-gradient-to-br from-teal-100 to-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <a href="{{route('patient.create')}}" class="group flex items-center p-6 bg-gradient-to-br from-teal-50 to-teal-100 rounded-xl hover:from-teal-100 hover:to-teal-200 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                    <div class="w-12 h-12 bg-gradient-to-br from-teal-100 to-teal-200 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Nouveau patient</p>
                        <p class="text-sm text-gray-600">Ajouter un dossier</p>
                    </div>
                </a>

                <a href="{{ route('patients.index') }}" class="group flex items-center p-6 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl hover:from-blue-100 hover:to-blue-200 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Liste des patients</p>
                        <p class="text-sm text-gray-600">Voir tous les patients</p>
                    </div>
                </a>

                <a href="#" class="group flex items-center p-6 bg-gradient-to-br from-green-50 to-green-100 rounded-xl hover:from-green-100 hover:to-green-200 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Analyser données</p>
                        <p class="text-sm text-gray-600">IA prédictive</p>
                    </div>
                </a>

                <a href="#" class="group flex items-center p-6 bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl hover:from-purple-100 hover:to-purple-200 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-purple-200 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Rapports</p>
                        <p class="text-sm text-gray-600">Générer rapport</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Rendez-vous récents avec style amélioré -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">📅 Rendez-vous récents</h2>
                <span class="text-sm text-gray-500">Aujourd'hui</span>
            </div>
            
            <!-- Message quand il n'y a pas de rendez-vous -->
            <div class="text-center py-12">
                <div class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Pas de rendez-vous aujourd'hui</h3>
                <p class="text-gray-600 mb-6">Aucun rendez-vous n'est programmé pour aujourd'hui. Profitez de cette journée libre !</p>
                
                <!-- Bouton pour créer un rendez-vous -->
                <a href="#" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-teal-600 to-blue-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Créer un rendez-vous
                </a>
            </div>
        </div>
    </div>

    <!-- Alertes et notifications avec style amélioré -->
    <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border border-yellow-200 rounded-2xl p-8 mb-8 shadow-lg">
        <div class="flex items-center">
            <div class="w-16 h-16 bg-gradient-to-br from-yellow-100 to-orange-100 rounded-full flex items-center justify-center mr-6">
                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="text-xl font-bold text-yellow-800 mb-2">Alertes importantes</h3>
                <p class="text-yellow-700 mb-4">3 patients nécessitent une attention immédiate. Vérifiez vos notifications.</p>
                <div class="flex items-center space-x-4">
                    <button class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition-colors duration-300">
                        Voir les alertes
                    </button>
                    <button class="text-yellow-600 hover:text-yellow-800 transition-colors duration-300">
                        Marquer comme lu
                    </button>
                </div>
            </div>
            <button class="text-yellow-600 hover:text-yellow-800 transition-colors duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Graphiques et analyses avec style amélioré -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">📊 Activité récente</h2>
                <span class="text-sm text-gray-500">Dernières 24h</span>
            </div>
            <div class="space-y-4">
                <div class="group flex items-center justify-between p-4 bg-gradient-to-r from-teal-50 to-teal-100 rounded-xl hover:from-teal-100 hover:to-teal-200 transition-all duration-300">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-teal-100 to-teal-200 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Nouveau patient ajouté</p>
                            <p class="text-sm text-gray-600">Sarah Benali - Il y a 2h</p>
                        </div>
                    </div>
                    <span class="text-xs bg-teal-100 text-teal-800 px-2 py-1 rounded-full">Nouveau</span>
                </div>

                <div class="group flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl hover:from-blue-100 hover:to-blue-200 transition-all duration-300">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Analyse IA complétée</p>
                            <p class="text-sm text-gray-600">Ahmed Benali - Il y a 4h</p>
                        </div>
                    </div>
                    <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">IA</span>
                </div>

                <div class="group flex items-center justify-between p-4 bg-gradient-to-r from-green-50 to-green-100 rounded-xl hover:from-green-100 hover:to-green-200 transition-all duration-300">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-100 to-green-200 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Rapport généré</p>
                            <p class="text-sm text-gray-600">Rapport mensuel - Il y a 6h</p>
                        </div>
                    </div>
                    <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">Rapport</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">🤖 Performances IA</h2>
                <span class="text-sm text-gray-500">Mise à jour: {{ now()->format('H:i') }}</span>
            </div>
            <div class="space-y-6">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-gray-600 font-medium">Précision prédictive</span>
                        <span class="font-bold text-green-600 text-lg">95.2%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-gradient-to-r from-green-400 to-green-500 h-3 rounded-full transition-all duration-1000" style="width: 95.2%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-gray-600 font-medium">Patients analysés</span>
                        <span class="font-bold text-blue-600 text-lg">1,247</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-gradient-to-r from-blue-400 to-blue-500 h-3 rounded-full transition-all duration-1000" style="width: 78%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-gray-600 font-medium">Temps de réponse</span>
                        <span class="font-bold text-teal-600 text-lg">2.3s</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-gradient-to-r from-teal-400 to-teal-500 h-3 rounded-full transition-all duration-1000" style="width: 92%"></div>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 font-medium">Statut IA</span>
                        <span class="flex items-center text-green-600 font-medium">
                            <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                            Opérationnel
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script pour les animations -->
<script>
document.addEventListener('DOMContentLoaded', function() {
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

    // Animation pour les barres de progression
    const progressBars = document.querySelectorAll('.bg-gradient-to-r');
    progressBars.forEach((bar, index) => {
        const width = bar.style.width;
        bar.style.width = '0%';
        setTimeout(() => {
            bar.style.transition = 'width 1s ease';
            bar.style.width = width;
        }, 800 + (index * 200));
    });
});
</script>
@endsection
