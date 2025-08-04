<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedcianeController extends Controller
{
    public function index()
    {
        $medecin=Auth::user();
        $patients=Patient::where('id_medecin',$medecin->id)->get();
        return view('Espaces.Medcaine.HomeMedciane',compact('patients'));
    }

}
