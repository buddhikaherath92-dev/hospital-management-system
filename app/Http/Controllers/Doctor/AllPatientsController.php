<?php

namespace App\Http\Controllers\Doctor;

use App\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AllPatientsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
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
