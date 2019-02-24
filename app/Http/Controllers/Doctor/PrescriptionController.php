<?php

namespace App\Http\Controllers\Doctor;

use App\Prescription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrescriptionController extends Controller
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
     * Show the prescription view with data
     * @param $diagnose_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($diagnose_id){
        return view('doctor.pages.prescription',[
            'diagnose'=>Prescription::join('diagnoses','prescriptions.diagnose_id','diagnoses.id')
            ->join('users','diagnoses.doctor_id','users.id')->where('diagnoses.id',$diagnose_id)->first()
        ]);
    }
}
