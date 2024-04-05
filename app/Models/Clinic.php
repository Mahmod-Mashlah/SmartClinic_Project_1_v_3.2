<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'specialize',

    ];

    ////////////////////////////////////////////////////////////
    public function doctors()
    {
        return $this->hasMany(Doctor::class,"clinic_id");
    }
                    ///////////////////
    public function patiants()
    {
        return $this->hasMany(Patiant::class,"clinic_id");
    }
                    ///////////////////
    public function Clinic_Dates()
    {
        return $this->hasMany(Clinic_Date::class);
    }
                    /////////////////
    public function treatments()
    {
        return $this->hasMany(Treatment::class,"clinic_id");
    }
    ///////////////////////////////////////////////////////////////
}
