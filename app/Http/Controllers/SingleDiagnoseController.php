<?php

namespace App\Http\Controllers;

use App\Laboratory;
use App\Prescription;
use Illuminate\Http\Request;

class SingleDiagnoseController extends Controller
{
    /**
     * Show the prescription view with data
     * @param $diagnose_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($diagnose_id){
        return view('patient.pages.single_diagnose',[
            'diagnose'=>Prescription::join('diagnoses','prescriptions.diagnose_id','diagnoses.id')
                ->join('users','diagnoses.doctor_id','users.id')->where('diagnoses.id',$diagnose_id)->join('pharmacies','diagnoses.id','pharmacies.diagnose_id')->first(),
            'reports'=>Laboratory::where('diagnose_id',$diagnose_id)->get()
        ]);
    }
}
