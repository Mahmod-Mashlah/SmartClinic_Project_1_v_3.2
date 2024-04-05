<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $fillable=[
       ' prescription_date',
       ' note',
       ' treatment_id',


    ];

    public function Treatment()
    {
        return $this->belongsTo(Treatment::class,"treatment_id");


    }
    public function medicines()
    {
        return $this->hasMany(Medicine::class,"prescription_id");

    }
}
