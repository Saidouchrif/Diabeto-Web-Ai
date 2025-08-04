<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prediction extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_prediction';
    protected $table = 'predictions';
    protected $fillable = ['id_patient', 'result'];
    public function patient()
{
    return $this->belongsTo(Patient::class, 'id_patient');
}
}
