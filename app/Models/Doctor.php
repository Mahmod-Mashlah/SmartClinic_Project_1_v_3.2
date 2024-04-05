<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable=[

        'description',
        'work_day',
        'start_time',
        'end_time',
        'experiance',
        'specialize',
        'previewDuration(Minutes)',
        'evalution',
        'employee_id',
        'Clinic_id',

    ];
/////////////////////////////////////////////////////////////////
    public function Clinic()
    {
        return $this->belongsTo(Clinic::class,"Clinic_id");
    }
                    //////////////
    public function Employee()
    {
        return $this->belongsTo(Employee::class);
    }
/////////////////////////////////////////////////////////////////
    public function Patiants()
    {
        return $this->hasMany(Patiant::class,"doctor_id");
    }
                    /////////////
    public function Treatment()
    {
        return $this->hasMany(Treatment::class,"doctor_id");
    }

    public function Report()
    {
        return $this->hasMany(Report::class,"report_id");
    }

    public function Examination()
    {
        return $this->hasMany(Examination::class,"doctor_id");
    }
/////////////////////////////////////////////////////////////////

}
