<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnose extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'diagnose',
        'patient_id',
        'posted_date',
        'doctor_id'
    ];

    public static function joinDiagnose(){
       return Diagnose::join('patients','diagnoses.patient_id','patients.id')
            ->join('users','diagnoses.doctor_id','users.id');
    }
}
