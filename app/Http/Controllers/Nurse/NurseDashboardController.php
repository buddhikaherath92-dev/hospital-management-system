<?php

namespace App\Http\Controllers\Nurse;

use App\Appoinment;
use App\Patient;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NurseDashboardController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('nurse.pages.nurse_dashboard',['patients' => Patient::all(),'doctors'
        => User::where('user_type',2)->get()]);
    }

}
