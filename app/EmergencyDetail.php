<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmergencyDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contact_name','tel','patient_id'
    ];
}
