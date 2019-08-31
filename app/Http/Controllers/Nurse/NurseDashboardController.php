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
        $heading = 'All Patients';
        $patients = Patient::orderBy('updated_at');
        $filterParams = [];

        if(request()->has('filter_enabled') && request('filter_enabled')){
            $heading = 'Filter Results';
            if(request()->has('patient_name') && request('patient_name') !== ''){
                $patients = $patients->where('full_name', 'like', '%'.request('patient_name').'%');
                $filterParams['patient_name'] = request('patient_name') ;
            }
            if(request()->has('patient_gender') && request('patient_gender') !== null){
                $patients = $patients->where('gender', request('patient_gender'));
                $filterParams['patient_gender'] = request('patient_gender') ;
            }
            if(request()->has('patient_category') && request('patient_category') !== null){
                $patients = $patients->where('patient_category', request('patient_category'));
                $filterParams['patient_category'] = request('patient_category') ;
            }
        }

        return view('nurse.pages.nurse_dashboard',[
            'all_patients'=>$patients->get(),
            'heading' => $heading,
            'filter_params' => $filterParams
        ]);
    }

}
