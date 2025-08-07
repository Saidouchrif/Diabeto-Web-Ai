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
        $patients=Patient::with('predictions')->where('id_medecin',$medecin->id)->get();
        $diagnostic = request('diagnostic');
        if ($diagnostic === 'diabetique') {
            $patients = $patients->filter(function($patient) {
                $last = $patient->predictions->sortByDesc('created_at')->first();
                return $last && $last->result == 1;
            });
        } elseif ($diagnostic === 'nondiabetique') {
            $patients = $patients->filter(function($patient) {
                $last = $patient->predictions->sortByDesc('created_at')->first();
                return $last && $last->result == 0;
            });
        } elseif ($diagnostic === 'sans') {
            $patients = $patients->filter(function($patient) {
                $last = $patient->predictions->sortByDesc('created_at')->first();
                return !$last;
            });
        }
        $search = request('search');
        if ($search) {
            $patients = $patients->filter(function($patient) use ($search) {
                return stripos($patient->nom, $search) !== false || stripos($patient->prenom, $search) !== false;
            });
        }
        $date = request('date');
        $date_exacte = request('date_exacte');
        if ($date_exacte) {
            $patients = $patients->filter(function($patient) use ($date_exacte) {
                $last = $patient->predictions->sortByDesc('created_at')->first();
                if(!$last) return false;
                return \Carbon\Carbon::parse($last->created_at)->format('Y-m-d') === $date_exacte;
            });
        } else if (in_array($date, ['7','30','90'])) {
            $days = (int)$date;
            $patients = $patients->filter(function($patient) use ($days) {
                $last = $patient->predictions->sortByDesc('created_at')->first();
                if(!$last) return false;
                return \Carbon\Carbon::parse($last->created_at)->gt(now()->subDays($days));
            });
        }
        return view('Espaces.Patient.Patients',compact('patients','diagnostic'));
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
            'glucose'=>'required|numeric',
            'bmi'=>'required|numeric',
            'blood_pressure'=>'required|numeric',
            'pedigree'=>'required|numeric',
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
        $patient = Patient::with('predictions')->findOrFail($id);
        $lastPrediction = $patient->predictions()->latest('created_at')->first();
        return view('Espaces.Patient.details', compact('patient', 'lastPrediction'));
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
            'glucose'=>'required|numeric',
            'bmi'=>'required|numeric',
            'blood_pressure'=>'required|numeric',
            'pedigree'=>'required|numeric',
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

    /**
     * Envoyer les données du patient à l'API AI et récupérer le résultat
     */
    public function predictWithAI($id)
    {
        try {
            $patient = Patient::findOrFail($id);
            
            // Préparer les données pour l'API
            $data = [
                'Glucose' => $patient->glucose,
                'BMI' => $patient->bmi,
                'Age' => $patient->age,
                'DiabetesPedigreeFunction' => $patient->pedigree
            ];

            // Configuration de la requête HTTP
            $url = 'http://localhost:9000/predict';
            $headers = [
                'Content-Type: application/json',
                'Accept: application/json'
            ];

            // Créer le contexte de la requête
            $context = stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => implode("\r\n", $headers),
                    'content' => json_encode($data),
                    'timeout' => 10 // Timeout de 10 secondes
                ]
            ]);

            // Envoyer la requête à l'API
            $response = file_get_contents($url, false, $context);
            
            if ($response === false) {
                throw new \Exception('Erreur de connexion à l\'API');
            }

            // Décoder la réponse JSON
            $result = json_decode($response, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Erreur de décodage de la réponse JSON');
            }

            // Traduction du cluster en résultat binaire
            $diagnostic = ($result['cluster'] == 1) ? 1 : 0;

            // Sauvegarder la prédiction dans la table predictions
            \App\Models\prediction::create([
                'id_patient' => $patient->id_patient,
                'result' => $diagnostic,
            ]);

            // Retourner le résultat
            return response()->json([
                'success' => true,
                'data' => $result,
                'patient' => [
                    'id' => $patient->id_patient,
                    'nom' => $patient->nom,
                    'prenom' => $patient->prenom,
                    'glucose' => $patient->glucose,
                    'bmi' => $patient->bmi,
                    'age' => $patient->age,
                    'pedigree' => $patient->pedigree
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'message' => 'Erreur lors de l\'analyse AI'
            ], 500);
        }
    }

    /**
     * Version alternative avec cURL (si file_get_contents ne fonctionne pas)
     */
    public function predictWithAICurl($id)
    {
        try {
            $patient = Patient::findOrFail($id);
            
            // Préparer les données pour l'API
            $data = [
                'Glucose' => $patient->glucose,
                'BMI' => $patient->bmi,
                'Age' => $patient->age,
                'DiabetesPedigreeFunction' => $patient->pedigree
            ];

            // Initialiser cURL
            $ch = curl_init();
            
            // Configuration de cURL
            curl_setopt_array($ch, [
                CURLOPT_URL => 'http://localhost:9000/predict',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                    'Accept: application/json'
                ],
                CURLOPT_TIMEOUT => 10,
                CURLOPT_CONNECTTIMEOUT => 5
            ]);

            // Exécuter la requête
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            
            // Vérifier les erreurs cURL
            if (curl_errno($ch)) {
                throw new \Exception('Erreur cURL: ' . curl_error($ch));
            }
            
            curl_close($ch);

            // Vérifier le code de statut HTTP
            if ($httpCode !== 200) {
                throw new \Exception('Erreur HTTP: ' . $httpCode);
            }

            // Décoder la réponse JSON
            $result = json_decode($response, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Erreur de décodage de la réponse JSON');
            }

            // Retourner le résultat
            return response()->json([
                'success' => true,
                'data' => $result,
                'patient' => [
                    'id' => $patient->id_patient,
                    'nom' => $patient->nom,
                    'prenom' => $patient->prenom,
                    'glucose' => $patient->glucose,
                    'bmi' => $patient->bmi,
                    'age' => $patient->age,
                    'pedigree' => $patient->pedigree
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'message' => 'Erreur lors de l\'analyse AI'
            ], 500);
        }
    }
}
