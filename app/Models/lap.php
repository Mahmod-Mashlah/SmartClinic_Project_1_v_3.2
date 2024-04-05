<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lap extends Model
{
    use HasFactory;
    protected $fillable=[
        'expirance',
        'status',
        'employee_id',
    ];

    public function Report()
    {
        return $this->hasMany(Report::class,"report_id");
    }
}
