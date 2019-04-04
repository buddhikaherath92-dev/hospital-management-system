<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnregisteredAppoinment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','title','time' ,'date', 'doctor','isAppointed'
    ];
}
