<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    protected $fillable=[

        'Day',
        'Date',
        'time',
        'notes',

        'clinic_id',
        'doctor_id',
        'patiant_id',
        'treatments_id',



    ];

    public function clinic()
    {
    return $this->belongsTo(Clinic::class,'clinic_id');
    }
    public function doctor()
    {
    return $this->belongsTo(Doctor::class,'doctor_id');
    }
    public function patiant()
    {
    return $this->belongsTo(Patiant::class,'patiant_id');
    }
    public function treatment()
    {
    return $this->belongsTo(Treatment::class,'treatment_id');
    }

    public function Diagnosis()
    {
    return $this->hasMany(Diagnosis::class,'diagnosis_id');
    }
}
