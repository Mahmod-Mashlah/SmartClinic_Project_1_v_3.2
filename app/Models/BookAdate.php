<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookAdate extends Model
{
    use HasFactory;
    protected $fillable = [

        'date',
        'time',
        'doctor_id',
        'clinic_id',
        'patiant_id',
    ];

/////////////////////////////////////////////////////////////////
    public function Clinic()
    {
        return $this->belongsTo(Clinic::class,"clinic_id");
    }
                    //////////////
    public function Doctor()
    {
        return $this->belongsTo(Doctor::class,"doctor_id");
    }
                    /////////////
    public function Patiant()
    {
        return $this->belongsTo(Patiant::class,"patiant_id");
    }
/////////////////////////////////////////////////////////////////
    // public function Patiants()
    // {
    //     return $this->hasMany(Treatment::class,"doctor_id");
    // }
    //                 /////////////
    // public function treatments()
    // {
    //     return $this->hasMany(Treatment::class,"doctor_id");
    // }
/////////////////////////////////////////////////////////////////
}
