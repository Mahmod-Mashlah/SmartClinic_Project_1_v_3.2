<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChronicDiseases extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'place',
      
    ];
}
