<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medecin=Auth::user();
        $patients=Patient::where('id_medecin',$medecin->id)->get();
        return view('Espaces.Patient.Patients',compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $medecin=Auth::user();
        $id_medecin=$medecin->id;
        return view('Espaces.Patient.Ajouter',compact('id_medecin'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $users=$request->validate([
            'nom'=>'required|string|max:255',
            'prenom'=>'required|string|max:255',
            'sexe'=>'required|string|max:255',
            'age'=>'required|integer',
            'glucose'=>'required|integer',
            'bmi'=>'required|integer',
            'blood_pressure'=>'required|integer',
            'pedigree'=>'required|integer',
            'result'=>'required|integer',
            'id_medecin'=>'required|integer|exists:users,id',
        ],[
            'nom.required'=>'Le nom est requis',
            'nom.string'=>'Le nom doit être une chaîne de caractères',
            'nom.max'=>'Le nom ne doit pas dépasser 255 caractères',
            'prenom.required'=>'Le prénom est requis',
            'prenom.string'=>'Le prénom doit être une chaîne de caractères',
        ]);
        Patient::create($users);
        return redirect()->route('patients.index')->with('success','Patient ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,$id)
    {
        $patient=Patient::findOrFail($id);
        return view('Espaces.Patient.details',compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,$id)
    {
        $patient=Patient::findOrFail($id);
        return view('Espaces.Patient.edit',compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $users=$request->validate([
            'nom'=>'required|string|max:255',
            'prenom'=>'required|string|max:255',
            'sexe'=>'required|string|max:255',
            'age'=>'required|integer',
            'glucose'=>'required|integer',
            'bmi'=>'required|integer',
            'blood_pressure'=>'required|integer',
            'pedigree'=>'required|integer',
            'result'=>'required|integer',
            'id_medecin'=>'required|integer|exists:users,id',
        ],[
            'nom.required'=>'Le nom est requis',
            'nom.string'=>'Le nom doit être une chaîne de caractères',
            'nom.max'=>'Le nom ne doit pas dépasser 255 caractères',
            'prenom.required'=>'Le prénom est requis',
            'prenom.string'=>'Le prénom doit être une chaîne de caractères',
        ]);
        Patient::findOrFail($id)->update($users);
        return redirect()->route('patients.index')->with('success','Patient modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Patient::destroy($id); 
        return redirect()->route('patients.index')->with('success','Patient supprimé avec succès');
    }
}
