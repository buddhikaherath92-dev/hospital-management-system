<?php

namespace App\Http\Controllers;

use App\EmergencyDetail;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class MyProfileController extends Controller
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
     * Show patient dashboard
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        $data=EmergencyDetail::where('patient_id',Auth::id())->get();
        return view('patient.pages.my_profile',[
            'patient_detail'=>Patient::select('patients.*')->where('user_id',Auth::id())->first(),
            'patient_categories'=>config('constances.patient_categories'),'details'=>$data
        ]);
    }

    /**
     * Update patient details
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request){

        $validatedData = $request->validate([
            'full_name' => 'required|max:255',
            'address' => 'required|string',
            'tel_no' => 'required|numeric',
            'gender' => 'required|string',
            'blood_group'=>'required|string',
            'dob' => 'required',
            'height' => 'required|string',
            'weight' => 'required|string',
            'patient_category' => 'required|string',
            'allergies' => 'required|string',
            'medical_condition' => 'required|string'
        ]);

        $patient=Patient::find(request('id'));
        $patient->update($validatedData);
        return redirect()->back()->withSuccess('Patient Profile Updated Successfully !');
    }
}
