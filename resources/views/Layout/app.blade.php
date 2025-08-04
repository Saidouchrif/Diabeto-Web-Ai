<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiabetoWeb - @yield('title')</title>
    
    <!-- ✅ Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Optionnel : config Tailwind -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0d9488',
                        secondary: '#64748b',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Barre de navigation -->
    <nav class="bg-white shadow p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-xl font-bold text-primary hover:text-teal-700 transition-colors duration-300">
                DiabetoWeb
            </a>
            <div>
                @auth
                    <span class="text-gray-700 mr-4">Bienvenue, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:underline bg-transparent border-none cursor-pointer">
                            Déconnexion
                        </button>
                    </form>
                @endauth
                @guest
                    <a href="{{route('login.index')}}" class="text-primary hover:underline mr-4">Connexion</a>
                    <a href="{{route('register.index')}}" class="text-primary hover:underline">Inscription</a>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="container mx-auto py-8">
        @yield('content')
    </main>

    <!-- Pied de page -->
    <footer class="text-center py-4 text-sm text-gray-500">
        &copy; 2025 DiabetoWeb - Tous droits réservés.
    </footer>
</body>
</html>
