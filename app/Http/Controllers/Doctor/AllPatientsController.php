<?php

namespace App\Http\Controllers\Doctor;

use App\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AllPatientsController extends Controller
{
    /**
     * Show doctor main view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        return view('doctor.pages.all_patients',[
            'all_patients'=>Patient::get()
        ]);
    }
}
