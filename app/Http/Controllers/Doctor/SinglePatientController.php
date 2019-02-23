<?php

namespace App\Http\Controllers\Doctor;

use App\Diagnose;
use App\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SinglePatientController extends Controller
{
    /**
     * Show single Patient view
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id){
        return view('doctor.pages.single_patient',[
            'patient'=>Patient::where('id',$id)->first(),
            'diagnoses'=>Diagnose::joinDiagnose()->where('patients.id',$id)->get()
        ]);
    }
}
