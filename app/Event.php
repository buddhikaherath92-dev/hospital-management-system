<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'doctor_name',
        'name',
        'type',
        'date',
        'description',
        'time',
        'venue',
        'patient_id'
    ];
}
