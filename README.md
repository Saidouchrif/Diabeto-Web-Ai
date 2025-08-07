# Diabeto-Web

Plateforme de gestion et de suivi des patients diabétiques avec diagnostic assisté par intelligence artificielle.

## 🚀 Fonctionnalités principales
- **Gestion des patients** : Ajout, édition, suppression, visualisation détaillée
- **Diagnostic IA** : Analyse automatique du risque de diabète via un modèle Python (FastApi)
- **Filtres avancés** : Recherche par nom/prénom, filtre par diagnostic, date de dernière visite, etc.
- **Statistiques dynamiques** : Total patients, répartition par sexe, diagnostics, patients sans analyse
- **Interface moderne** : UI responsive avec Tailwind CSS et Blade
- **Sécurité** : Authentification, gestion des rôles

## 🛠️ Technologies utilisées
- **Backend** : Laravel (PHP)
- **Frontend** : Blade, Tailwind CSS, JavaScript
- **IA** : Python Fast (API), modèle de prédiction (logistic regression)
- **Base de données** : MySQL/MariaDB

## ⚙️ Installation

### 1. Cloner le projet
```bash
git clone <repo-url>
cd diabeto-web
```

### 2. Installer les dépendances Laravel
```bash
composer install
cp .env.example .env
php artisan key:generate
```
Configurer la base de données dans `.env` puis :
```bash
php artisan migrate
```

### 3. Installer les dépendances front-end
```bash
npm install
npm run dev
```

### 4. Lancer le serveur Laravel
```bash
php artisan serve
```

### 5. Lancer l’API IA (Fast)
```bash
cd ModelAI
python api_test_model.py
```

## 💡 Utilisation
- Connectez-vous en tant que médecin
- Ajoutez un patient via "Nouveau patient"
- Consultez la liste, filtrez par diagnostic, date, nom/prénom
- Cliquez sur un patient pour voir les détails et lancer une analyse IA
- Le résultat du diagnostic est sauvegardé et affiché dans l’historique

## 📁 Structure du projet
- `app/Http/Controllers/` : Contrôleurs Laravel
- `resources/views/` : Vues Blade (Patients, Home, etc.)
- `ModelAI/` : API Flask et modèle IA
- `database/migrations/` : Migrations de la base
- `public/` : Assets publics

## 👤 Crédits
- Développement : Said Ouchrif
- Modèle IA : Said Ouchrif

## 📬 Contact
Pour toute question ou contribution, contactez : saidouchrif16@gmail.com
