<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiagnoseValue extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'diagnose_id',
        'hba1c',
        'cholesterol',
        'bp'
    ];
}
