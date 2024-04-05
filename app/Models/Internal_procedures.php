<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internal_procedures extends Model
{
    use HasFactory;
    protected $fillable=[

        'name',
        'type',
        'place',
        'examination_id',
        'treatment_id',
    ];

    public function Examination()
    {
        return $this->belongsTo(Examination::class,"Internal_procedures_id");
    }
    public function Treatment()
    {
        return $this->belongsTo(Treatment::class,"Internal_procedures_id");
    }

}
