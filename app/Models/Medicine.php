<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'type_medicine',
        'type_give',
        'number_give',
        'prescription_id'

    ];

    public function Prescription()
    {
        return $this->belongsTo(Prescription::class,"prescription_id");
    }

}
