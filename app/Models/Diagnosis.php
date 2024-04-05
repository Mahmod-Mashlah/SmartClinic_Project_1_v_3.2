<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'type',
        'visit_id'
    ];

    public function Visit()
    {
        return $this->belongsTo(Visit::class,"visit_id");
    }
}
