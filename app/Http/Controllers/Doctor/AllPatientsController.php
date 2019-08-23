<?php

namespace App\Http\Controllers\Doctor;

use App\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpParser\Builder\ParamTest;

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

        return view('doctor.pages.all_patients',[
            'all_patients'=>$patients->get(),
            'heading' => $heading,
            'filter_params' => $filterParams
        ]);
    }
}
