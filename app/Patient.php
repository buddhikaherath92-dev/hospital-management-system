<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'full_name',
        'address',
        'tel_no',
        'blood_group',
        'patient_category',
        'medical_condition',
        'allergies',
        'weight',
        'height',
        'age',
        'gender',
        'user_id'
    ];
}
