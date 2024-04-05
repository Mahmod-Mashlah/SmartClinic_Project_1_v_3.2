<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'type',
        'examination_date',
        'clinic_id',
        'doctor_id',
        'patiant_id',
        'report_id',

    ];

    public function Doctor()
    {
    return $this->belongsTo(Doctor::class,'doctor_id');
    }
    public function Patiant()
    {
    return $this->hasMany(Patiant::class,'patiant_id');
    }

    public function Internal_procedures()
    {
    return $this->hasMany(Internal_procedures::class,'Internal_procedures_id');
    }

}
