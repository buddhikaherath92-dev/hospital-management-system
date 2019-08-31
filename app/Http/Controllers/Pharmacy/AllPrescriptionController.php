<?php

namespace App\Http\Controllers\Pharmacy;

use App\Diagnose;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AllPrescriptionController extends Controller
{
    /**
     * Show all prescription view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        $diagnoses = Diagnose::getNotReadyedPrescriptions()
            ->select('users.name','diagnose','posted_date','diagnoses.id','patients.full_name', 'pharmacies.is_ready');
        $doctors = User::where('user_type', (int)2)->get();
        $filterParams = [];

        if(request()->has('filter_enabled') && request('filter_enabled') === 'true'){
            if(request()->has('patient_name') && request('patient_name') !== null){
                $diagnoses = $diagnoses->where('full_name', 'like', '%'.request('patient_name').'%');
                $filterParams['patient_name'] = request('patient_name');
            }
            if(request()->has('doctor_name') && request('doctor_name') !== null){
                $diagnoses = $diagnoses->where('users.id', request('doctor_name'));
                $filterParams['doctor_name'] = request('doctor_name');
            }
            if(request()->has('report_status') && request('report_status') !== null){
                $diagnoses = $diagnoses->where('pharmacies.is_ready', request('report_status'));
                $filterParams['report_status'] = request('report_status');
            }
            if(request()->has('posted_date') && request('posted_date') !== null){
                $diagnoses = $diagnoses->whereDate('posted_date', request('posted_date'));
                $filterParams['posted_date'] = request('posted_date');
            }
        }

        return view('pharmacy.pages.all_prescriptions',[
            'diagnoses'=>$diagnoses->get(),
            'filterParams' => $filterParams,
            'doctors' => $doctors
        ]);
    }
}
