@extends('Layout.app')

@section('title', 'Accueil')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-teal-50 via-blue-50 to-purple-50 py-20 overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 bg-gradient-to-r from-teal-500/10 via-blue-500/10 to-purple-500/10"></div>
    <div class="absolute top-0 left-0 w-72 h-72 bg-teal-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
    <div class="absolute top-0 right-0 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
    <div class="absolute bottom-0 left-0 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    
    <div class="relative container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Content -->
            <div class="text-center lg:text-left">
                <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                    Gestion intelligente du 
                    <span class="bg-gradient-to-r from-teal-600 to-blue-600 bg-clip-text text-transparent">
                        diabète
                    </span>
                </h1>
                <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                    Plateforme médicale innovante pour le suivi et la gestion des patients diabétiques. 
                    IA avancée, analyses prédictives et interface intuitive pour les professionnels de santé.
                </p>
                
                <!-- Boutons conditionnels selon l'authentification -->
                @auth
                <!-- Utilisateur connecté -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('medciane.index') }}" class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-teal-600 to-blue-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Accéder au tableau de bord
                    </a>
                    <a href="{{ route('patients.index') }}" class="inline-flex items-center justify-center px-8 py-4 border-2 border-teal-600 text-teal-600 font-semibold rounded-xl hover:bg-teal-600 hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                        Gérer mes patients
                    </a>
                </div>
                @else
                <!-- Utilisateur non connecté -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('login.index') }}" class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-teal-600 to-blue-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Se connecter
                    </a>
                    <a href="{{ route('register.index') }}" class="inline-flex items-center justify-center px-8 py-4 border-2 border-teal-600 text-teal-600 font-semibold rounded-xl hover:bg-teal-600 hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        S'inscrire gratuitement
                    </a>
                </div>
                @endauth
            </div>

            <!-- Image principale -->
            <div class="relative">
                <div class="relative z-10">
                    <img src="https://images.pexels.com/photos/4386466/pexels-photo-4386466.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" 
                         alt="Médecin utilisant la technologie pour le diagnostic" 
                         class="rounded-2xl shadow-2xl w-full h-96 object-cover">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Fonctionnalités principales</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Une plateforme complète pour la gestion moderne du diabète
            </p>
    </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-gradient-to-br from-teal-50 to-teal-100 rounded-2xl p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="w-16 h-16 bg-teal-600 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Suivi en temps réel</h3>
                <p class="text-gray-600">Surveillance continue des paramètres vitaux et alertes intelligentes pour une prise en charge optimale.</p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="w-16 h-16 bg-blue-600 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">IA prédictive</h3>
                <p class="text-gray-600">Algorithmes avancés pour prédire les tendances et recommander des ajustements thérapeutiques.</p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="w-16 h-16 bg-purple-600 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Sécurité maximale</h3>
                <p class="text-gray-600">Protocoles de sécurité avancés pour protéger les données médicales sensibles.</p>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-20 bg-gradient-to-r from-teal-600 to-blue-600">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl font-bold text-white mb-2">500+</div>
                <div class="text-teal-100">Médecins actifs</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-white mb-2">10,000+</div>
                <div class="text-teal-100">Patients suivis</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-white mb-2">99.9%</div>
                <div class="text-teal-100">Disponibilité</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-white mb-2">24/7</div>
                <div class="text-teal-100">Support médical</div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Témoignages</h2>
            <p class="text-xl text-gray-600">Ce que disent nos médecins partenaires</p>
    </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Témoignage 1 - Dr. Sarah Benali -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="flex items-center mb-6">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Dr. Sarah Benali" class="w-16 h-16 rounded-full mr-4">
                    <div>
                        <h4 class="font-semibold text-gray-900">Dr. Sarah Benali</h4>
                        <p class="text-gray-600">Endocrinologue</p>
                    </div>
                </div>
                <p class="text-gray-700 italic">"DiabetoWeb a révolutionné ma pratique. L'interface intuitive et les alertes intelligentes m'aident à mieux suivre mes patients."</p>
            </div>

            <!-- Témoignage 2 - Dr. Ahmed Tazi -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="flex items-center mb-6">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Dr. Ahmed Tazi" class="w-16 h-16 rounded-full mr-4">
                    <div>
                        <h4 class="font-semibold text-gray-900">Dr. Ahmed Tazi</h4>
                        <p class="text-gray-600">Médecin généraliste</p>
                    </div>
                </div>
                <p class="text-gray-700 italic">"La fonctionnalité de prédiction de l'IA m'aide à anticiper les complications et à adapter les traitements plus efficacement."</p>
    </div>

            <!-- Témoignage 3 - Dr. Fatima El Amrani -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="flex items-center mb-6">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Dr. Fatima El Amrani" class="w-16 h-16 rounded-full mr-4">
                    <div>
                        <h4 class="font-semibold text-gray-900">Dr. Fatima El Amrani</h4>
                        <p class="text-gray-600">Diabétologue</p>
                    </div>
                </div>
                <p class="text-gray-700 italic">"L'historique détaillé et les graphiques de progression permettent un suivi optimal de mes patients diabétiques."</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-teal-600 to-blue-600">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold text-white mb-6">Prêt à transformer votre pratique médicale ?</h2>
        <p class="text-xl text-teal-100 mb-8 max-w-2xl mx-auto">
            Rejoignez des milliers de professionnels de santé qui utilisent déjà DiabetoWeb pour améliorer la prise en charge du diabète.
        </p>
        
        <!-- Boutons conditionnels selon l'authentification -->
        @auth
        <!-- Utilisateur connecté -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('medciane.index') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-teal-600 font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Accéder à mon espace
            </a>
            <a href="{{ route('patients.index') }}" class="inline-flex items-center justify-center px-8 py-4 border-2 border-white text-white font-semibold rounded-xl hover:bg-white hover:text-teal-600 transition-all duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                </svg>
                Gérer mes patients
            </a>
        </div>
        @else
        <!-- Utilisateur non connecté -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register.index') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-teal-600 font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                Commencer gratuitement
            </a>
            <a href="{{ route('login.index') }}" class="inline-flex items-center justify-center px-8 py-4 border-2 border-white text-white font-semibold rounded-xl hover:bg-white hover:text-teal-600 transition-all duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                Se connecter
            </a>
        </div>
        @endauth
</div>
</section>

<style>
@keyframes blob {
    0% { transform: translate(0px, 0px) scale(1); }
    33% { transform: translate(30px, -50px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
    100% { transform: translate(0px, 0px) scale(1); }
}
.animate-blob {
    animation: blob 7s infinite;
}
.animation-delay-2000 {
    animation-delay: 2s;
}
.animation-delay-4000 {
    animation-delay: 4s;
}
</style>
@endsection

