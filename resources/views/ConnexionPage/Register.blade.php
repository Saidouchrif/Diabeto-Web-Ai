@extends('Layout.app')

@section('title', 'Inscription')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-teal-50 to-blue-100 py-12 px-4">
    <div class="max-w-md w-full bg-white p-8 rounded-2xl shadow-2xl">
        <div class="flex flex-col items-center mb-8">
            <div class="bg-teal-100 p-4 rounded-full mb-4">
                <svg class="w-10 h-10 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm0 2c-2.67 0-8 1.337-8 4v3h16v-3c0-2.663-5.33-4-8-4z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900">Inscription à DiabetoWeb</h2>
            <p class="text-gray-500 mt-2 text-center">Rejoignez notre communauté de professionnels de santé</p>
        </div>

        <!-- Affichage des erreurs -->
        @if($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{route('register')}}" class="space-y-6">
            @csrf
            
            <!-- Nom du médecin -->
            <div>
                <label for="name" class="block text-gray-700 font-semibold mb-1">
                    Nom complet <span class="text-red-500">*</span>
                </label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                    placeholder="Dr. Sarah Benali"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400 transition">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nom d'utilisateur -->
            <div>
                <label for="username" class="block text-gray-700 font-semibold mb-1">
                    Nom d'utilisateur <span class="text-red-500">*</span>
                </label>
                <input id="username" name="username" type="text" value="{{ old('username') }}" required
                    placeholder="dr.sarah.benali"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400 transition">
                <p class="text-gray-500 text-sm mt-1">Utilisez uniquement des lettres, chiffres et points</p>
                @error('username')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-gray-700 font-semibold mb-1">
                    Adresse e-mail <span class="text-red-500">*</span>
                </label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                    placeholder="dr.sarah.benali@example.com"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400 transition">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mot de passe -->
            <div>
                <label for="password" class="block text-gray-700 font-semibold mb-1">
                    Mot de passe <span class="text-red-500">*</span>
                </label>
                <input id="password" name="password" type="password" required
                    placeholder="••••••••"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400 transition">
                <p class="text-gray-500 text-sm mt-1">Minimum 8 caractères</p>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirmation du mot de passe -->
            <div>
                <label for="password_confirmation" class="block text-gray-700 font-semibold mb-1">
                    Confirmer le mot de passe <span class="text-red-500">*</span>
                </label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    placeholder="••••••••"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400 transition">
            </div>

            <!-- Conditions d'utilisation -->
            <div class="flex items-start">
                <input type="checkbox" name="terms" id="terms" required class="mt-1 mr-2">
                <label for="terms" class="text-sm text-gray-600">
                    J'accepte les <a href="#" class="text-teal-600 hover:underline">conditions d'utilisation</a> 
                    et la <a href="#" class="text-teal-600 hover:underline">politique de confidentialité</a>
                </label>
            </div>

            <button type="submit"
                class="w-full py-3 bg-gradient-to-r from-teal-600 to-blue-600 text-white font-bold rounded-lg shadow-lg hover:from-teal-700 hover:to-blue-700 transition">
                Créer mon compte
            </button>
        </form>

        <div class="mt-6 text-center">
            <span class="text-gray-600">Déjà inscrit ?</span>
            <a href="{{ route('login.index') }}" class="text-teal-600 font-semibold hover:underline ml-1">Se connecter</a>
        </div>

        <!-- Informations supplémentaires -->
        <div class="mt-8 p-4 bg-blue-50 rounded-lg">
            <h3 class="font-semibold text-blue-900 mb-2">Pourquoi s'inscrire ?</h3>
            <ul class="text-sm text-blue-800 space-y-1">
                <li>• Accès à l'IA de prédiction diabétique</li>
                <li>• Gestion centralisée des dossiers patients</li>
                <li>• Rapports détaillés et analyses</li>
                <li>• Support technique 24/7</li>
            </ul>
        </div>
    </div>
</div>
@endsection
