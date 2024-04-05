<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patiant extends Model
{
    use HasFactory;
    protected $fillable=[

        'Careear',
        'weigh',
        'description',
        'user_id',
        'clinic_id',
        'doctor_id',
    ];
////////////////////////////////////////////////////////////////
    public function doctor()
    {
        return $this->belongsTo(Doctor::class,"doctor_id");
    }
                        ///////////////
    public function clinic()
    {
        return $this->belongsTo(Clinic::class,"clinic_id");
    }
    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }
///////////////////////////////////////////////////////////////
    public function treatments()
    {
        return $this->hasMany(Treatment::class,"patiant_id");
    }
                        //////////////
    public function dates()
    {
        return $this->hasMany(BookAdate::class,"patiant_id");
    }

    public function Report()
    {
        return $this->hasMany(Report::class,"report_id");
    }
    public function Examination()
    {
        return $this->hasMany(Examination::class,"patiant_id");
    }
///////////////////////////////////////////////////////////////

}
