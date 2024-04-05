<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secretary extends Model
{
    use HasFactory;
    protected $fillable=[

        'TypingSpeed',
        'expirance',
        'employee_id',
    ];


    public function Report()
    {
        return $this->hasMany(Report::class,"report_id");
    }

    public function Employee()
    {
        return $this->belongsTo(Report::class,"employee_id");
    }


    ////////////////////////////////////////
}
