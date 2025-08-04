@extends('Layout.app')

@section('title', 'Connexion')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-teal-50 to-blue-100 py-12 px-4">
    <div class="max-w-md w-full bg-white p-8 rounded-2xl shadow-2xl">
        <div class="flex flex-col items-center mb-8">
            <div class="bg-teal-100 p-4 rounded-full mb-4">
                <svg class="w-10 h-10 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm0 2c-2.67 0-8 1.337-8 4v3h16v-3c0-2.663-5.33-4-8-4z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900">Connexion à DiabetoWeb</h2>
            <p class="text-gray-500 mt-2 text-center">Connectez-vous pour accéder à votre espace professionnel</p>
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

        @if(session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <form method="POST" action="{{route('login')}}" class="space-y-6">
            @csrf
            
            <!-- Email ou Username -->
            <div>
                <label for="login" class="block text-gray-700 font-semibold mb-1">
                    Email ou nom d'utilisateur <span class="text-red-500">*</span>
                </label>
                <input id="login" name="login" type="text" value="{{ old('login') }}" required autofocus
                    placeholder="dr.sarah.benali ou sarah@example.com"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400 transition">
                @error('login')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mot de passe -->
            <div>
                <label for="password" class="block text-gray-700 font-semibold mb-1">
                    Mot de passe <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input id="password" name="password" type="password" required
                        placeholder="••••••••"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400 transition pr-12">
                    <button type="button" onclick="togglePassword()" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <svg id="eye-icon" class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Options de connexion -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="mr-2 h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded">
                    <label for="remember" class="text-sm text-gray-600">Se souvenir de moi</label>
                </div>
                <a href="" class="text-sm text-teal-600 hover:underline">Mot de passe oublié ?</a>
            </div>

            <!-- Bouton de connexion -->
            <button type="submit"
                class="w-full py-3 bg-gradient-to-r from-teal-600 to-blue-600 text-white font-bold rounded-lg shadow-lg hover:from-teal-700 hover:to-blue-700 transition duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Se connecter
                </div>
            </button>
        </form>

        <!-- Séparateur -->
        <div class="mt-6 flex items-center">
            <div class="flex-1 border-t border-gray-300"></div>
            <span class="px-3 text-gray-500 text-sm">ou</span>
            <div class="flex-1 border-t border-gray-300"></div>
        </div>

        <!-- Lien vers l'inscription -->
        <div class="mt-6 text-center">
            <span class="text-gray-600">Pas encore de compte ?</span>
            <a href="{{route('register.index')}}" class="text-teal-600 font-semibold hover:underline ml-1">Créer un compte</a>
        </div>

        <!-- Informations de sécurité -->
        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
            <h3 class="font-semibold text-blue-900 mb-2 text-sm">🔒 Connexion sécurisée</h3>
            <ul class="text-xs text-blue-800 space-y-1">
                <li>• Chiffrement SSL/TLS</li>
                <li>• Protection contre les attaques</li>
                <li>• Conformité RGPD</li>
            </ul>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eye-icon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
        `;
    } else {
        passwordInput.type = 'password';
        eyeIcon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
        `;
    }
}
</script>
@endsection