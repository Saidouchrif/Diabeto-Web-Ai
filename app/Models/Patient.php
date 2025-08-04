<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_patient';
    protected $table = 'patients';
    protected $fillable = ['nom', 'prenom', 'sexe', 'age', 'glucose', 'bmi','blood_pressure','pedigree','result','id_medecin'];
    public function medecin()
{
    return $this->belongsTo(User::class, 'id_medecin','id');
}
public function predictions()
{
    return $this->hasMany(prediction::class, 'id_patient');
}
}

