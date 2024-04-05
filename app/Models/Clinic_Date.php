<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic_Date extends Model
{
    use HasFactory;
    protected $fillable = [
        'Day',
        'startHour',
        'EndHour',
        'Date',
        'clinic_id',

    ];
    public function Clinics()
    {
        return $this->belongsTo(Clinic::class);


    }
}
