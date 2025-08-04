<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function indexLogin()
    {
        return view('ConnexionPage.Login');
    }
    public function indexRegister()
    {
        return view('ConnexionPage.Register');
    }
    public function register(Request $request)
    {
        $user=$request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8',
        ],[
            'name.required' => 'Le nom est requis',
            'username.required' => 'Le nom d\'utilisateur est requis',
            'username.unique' => 'Le nom d\'utilisateur existe déjà',
            'email.required' => 'L\'email est requis',
            'email.email' => 'L\'email n\'est pas valide',
        ]);
        $user['password']=Hash::make($user['password']);
        User::create($user);
        return redirect()->route('login.index')->with('success', 'Inscription réussie');
    }
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);
        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $user = User::where($loginField, $request->login)->first();
        if (!$user) {
            return redirect()->route('login.index')->with('error', 'Email/username ou mot de passe incorrect');
        }
        
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->route('login.index')->with('error', 'Email/username ou mot de passe incorrect');
        }
        Auth::login($user, $request->boolean('remember'));
        return redirect()->route('medciane.index')->with('success', 'Connexion réussie ! Bienvenue Dr. ' . $user->name);
    }
    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login.index')->with('success', 'Déconnexion réussie');
    }
}
