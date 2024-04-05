<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\Street;
class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'City',
        'Counrty_id',

    ];
    function Streetes(){

        return $this->hasmany(Street::class);
    }
}
