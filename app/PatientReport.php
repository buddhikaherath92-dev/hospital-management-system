<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientReport extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_id','title','report'
    ];
}
