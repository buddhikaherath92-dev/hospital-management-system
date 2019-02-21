<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PatientDetailContoller extends Controller
{
    /**
     * Show the patient detail view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        return view('patient.pages.patient_details',[
            'patient_categories'=>config('constances.patient_categories'),
        ]);
    }
    /**
     * Store Patient details
     * @param Request $request
     */
    public function store(Request $request){
        $validatedData = $request->validate([
            'full_name' => 'required|max:255',
            'address' => 'required|string',
            'tel_no' => 'required|numeric',
            'gender' => 'required|string',
            'blood_group'=>'required|string',
            'age' => 'required|numeric',
            'height' => 'required|string',
            'weight' => 'required|string',
            'patient_category' => 'required|string',
            'allergies' => 'required|string',
            'medical_condition' => 'required|string'
        ]);
        $validatedData['user_id']=Auth::id();
        $validatedData['patient_category']=config('constances.patient_categories')[\request('patient_category')];

        $patient_detail=Patient::create($validatedData);
        return Redirect::route('show_patient_dashboard');
    }
}
