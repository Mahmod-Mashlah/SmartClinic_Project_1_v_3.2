<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable=[
        'startDate',
        'EndDate',
        'status',
        'jobTitle',
        'user_id',
    ];

    public function user()
    {
    return $this->belongsTo(User::class,'user_id');
    }

    public function certificates()
    {
        return $this->hasMany(Certificates::class,'employee_id');
    }
    public function lap()
    {
        return $this->hasMany(Lap::class,'employee_id');
    }
    public function secretary()
    {
        return $this->hasMany(Secretary::class,'employee_id');
    }
}
