<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;
class Country extends Model
{
    use HasFactory;
    protected $fillable=[
        'Country',
        'id'
    ];
    function Cities(){

        return $this->hasmany(City::class);
    }
}
