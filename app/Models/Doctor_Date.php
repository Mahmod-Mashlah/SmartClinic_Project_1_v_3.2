<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor_Date extends Model
{
    use HasFactory;

    protected $fillable=[
        'startShafet',
        'endShafet',
        'clinic_id',
        'doctor_id'
    ];
}
