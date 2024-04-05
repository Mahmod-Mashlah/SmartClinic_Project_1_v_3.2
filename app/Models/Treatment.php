<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use lluminate\Validation\Validator;
class Treatment extends Model
{
    use HasFactory;
    protected $fillable=[

        'treatment_date',
        'clinic_id',
        'doctor_id',
        'patiant_id',
        'report_id',
    ];

    public function Clinic()
    {
        return $this->belongsTo(Clinic::class,"clinic_id");
    }

    public function Doctor()
    {
        return $this->belongsTo(Doctor::class,"doctor_id");


    }
     public function Report()
    {
        return $this->hasMany(Report::class,"report_id");


    }
    public function Patiant()
    {
        return $this->hasMany(Patiant::class,"patiant_id");


    }
    public function Internal_procedures()
    {
    return $this->belongsTo(Internal_procedures::class,'Internal_procedures_id');
    }

    public function Prescription()
    {
    return $this->hasMany(Prescription::class,'prescription_id');
    }

}
