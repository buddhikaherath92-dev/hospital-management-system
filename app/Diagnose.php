<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

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
    /**
     * Retrieve data from users,patients,diagnoses
     * @return mixed
     */
    public static function joinDiagnose(){
       return Diagnose::join('patients','diagnoses.patient_id','patients.id')
            ->join('users','diagnoses.doctor_id','users.id')->select('users.name','diagnose','posted_date','diagnoses.id','patients.full_name');
    }
    /**
     * get All report requests
     * @return mixed
     */
    public static function getAllRequests(){
        return Diagnose::join('laboratories','diagnoses.id','laboratories.diagnose_id')
            ->join('users','diagnoses.doctor_id','users.id')
            ->join('patients','diagnoses.patient_id','patients.id')
            ->select('laboratories.id','title','description','users.name','full_name','posted_date');
    }
    public static function getSingleReport($report_id){
        return Diagnose::join('laboratories','diagnoses.id','laboratories.diagnose_id')->join('users','diagnoses.doctor_id','users.id')->where('laboratories.id',$report_id)->first();
    }
    public static function getNotReadyedPrescriptions(){
        return self::joinDiagnose()->join('pharmacies','diagnoses.id','pharmacies.diagnose_id');
    }
}
