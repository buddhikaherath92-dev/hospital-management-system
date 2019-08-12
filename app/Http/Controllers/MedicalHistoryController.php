<?php

namespace App\Http\Controllers;

use App\Diagnose;
use App\Event;
use App\Laboratory;
use App\Patient;
use App\PatientReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        $prescriptions = DB::table('prescriptions')
            ->select('prescriptions.prescription','diagnoses.diagnose','prescriptions.diagnose_id')
            ->join('diagnoses','prescriptions.diagnose_id','=','diagnoses.id')
            ->where('patient_id',Patient::where('user_id',Auth::id())->value('id'));

        // filter prescriptions by doctor name
        if(request()->has('filter_by') && request()->has('filter_param') &&
            request('filter_by') === 'prescription_by_doc'){
            $prescriptions = $prescriptions
                ->join('users', 'diagnoses.doctor_id', '=', 'users.id')
                ->where('users.name', 'LIKE', '%'.request('filter_param').'%' );
        }

        return view('patient.pages.medical_history',[
            'diagnoses'=>Diagnose::joinDiagnose()->where('patients.id',Patient::getPatient(Auth::id())['id'])->get(),
            'reports'=>PatientReport::where('patient_id',Auth::id())->get(),'events'=>Event::where('patient_id',Auth::id())->get(),
            'doctor_reports'=>Laboratory::where('patient_id',Patient::where('user_id',Auth::id())->value('id'))->get(),
            'prescriptions'=> $prescriptions->get()
        ]);
    }
}
