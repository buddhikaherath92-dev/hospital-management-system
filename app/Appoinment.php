<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Appoinment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','time' ,'date', 'doctor', 'patient_id','isAppointed'
    ];

    /**
     * Get Appointment data by date
     * @param $date
     * @return mixed
     */
    public static function getAppointmentByDate($date){
        return Appoinment::where('doctor',Auth::user()->name)->where('date',$date)->get();
    }
}
