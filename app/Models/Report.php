<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable=[
        'clinic_id',
        'doctor_id',
        'patiant_id',
        'secretary_id',
        'lap_id',

    ];

    public function treatments()
    {
        return $this->hasMany(Treatment::class,"report_id");

    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,"doctor_id");

    }

    public function Patiant()
    {
        return $this->belongsTo(Patiant::class,"patiant_id");

    }

    public function Secretary()
    {
        return $this->belongsTo(Secretary::class,"secretary_id");

    }

    public function Lap()
    {
        return $this->belongsTo(Lap::class,"lap_id");

    }
}


