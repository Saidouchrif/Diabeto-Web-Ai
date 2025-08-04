<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedcianeController;
use App\Http\Controllers\PatientController;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('PageHome.Home');
});
Route::get('/home', function () {
    return view('PageHome.Home');
})->name('home');
Route::get('/login', [LoginController::class, 'indexLogin'])->name('login.index')->middleware('guest');
Route::get('/register', [LoginController::class, 'indexRegister'])->name('register.index')->middleware('guest');
Route::post('/register', [LoginController::class, 'register'])->name('register')->middleware('guest');
Route::get('/home/medciane', [MedcianeController::class, 'index'])->name('medciane.index')->middleware('auth');
Route::post('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/home/medciane/patients', [PatientController::class, 'index'])->name('patients.index')->middleware('auth');
Route::get('/home/medciane/Ajouter',[PatientController::class,'create'])->name('patient.create')->middleware('auth');
Route::post('/home/medciane/store',[PatientController::class,'store'])->name('patients.store')->middleware('auth');
Route::delete('/home/medciane/delete/{id}',[PatientController::class,'destroy'])->name('patients.destroy')->middleware('auth');
Route::get('/home/medciane/details/{id}',[PatientController::class,'show'])->name('patients.show')->middleware('auth');
Route::get('/home/medciane/edit/{id}',[PatientController::class,'edit'])->name('patients.edit')->middleware('auth');
Route::put('/home/medciane/update/{id}',[PatientController::class,'update'])->name('patients.update')->middleware('auth');