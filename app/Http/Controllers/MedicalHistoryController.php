<?php

namespace App\Http\Controllers;

use App\Diagnose;
use App\Patient;
use App\PatientReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicalHistoryController extends Controller
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
     * Show medical_history page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        return view('patient.pages.medical_history',[
            'diagnoses'=>Diagnose::joinDiagnose()->where('patients.id',Patient::getPatient(Auth::id())['id'])->get(),
            'reports'=>PatientReport::all()
        ]);
    }
}
