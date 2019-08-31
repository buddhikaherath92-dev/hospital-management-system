<?php

namespace App\Http\Controllers\Nurse;

use App\Appoinment;
use App\Patient;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MakeAppointmentController extends Controller
{

    /**
     * Show make appointments view
     */
    public function show(){
        $patient = [];
        $filterParams = [];
        if(request()->has('patient_id')){
            $patient =  Patient::where('id',request('patient_id'))->first();
        }
        $doctors = User::where('user_type', config('constances.user_types')['DOCTOR']);
        if(request()->has('filter_enabled') && request('filter_enabled') == true){
            if(request()->has('doctor_name') && request('doctor_name') !== null){
                $doctors = $doctors->where('name', 'like', '%'.request('doctor_name').'%');
                $filterParams['doctor_name'] = request('doctor_name');
            }
            if(request()->has('doctor_speciality') && request('doctor_speciality') !== null){
                $doctors = $doctors->where('speciality', 'like', '%'.request('doctor_speciality').'%');
                $filterParams['doctor_speciality'] = request('doctor_speciality');
            }
        }
        return view('nurse.pages.make_appointment', [
            'patient' => $patient,
            'doctors' => $doctors->get(),
            'filterParams' => $filterParams
        ]);
    }

    /**
     * Make new appointment
     */
    public function store()
    {
        $data = request()->validate([
            'title' => 'required|string',
            'time' => 'required',
            'date' => 'required|date',
            'doctor' => 'required',
            'patient_id' => 'required'
        ]);

        $data['isAppointed'] = '1';
        $data['doctor'] = (int) $data['doctor'];
        $response = Appoinment::updateOrCreate(['date'=>$data['date'],
            'patient_id'=>Patient::where('id',$data['patient_id'])->value('id')],$data);
        return $response->wasRecentlyCreated == true ? redirect('/nurse/dashboard')->with('message','Appointed Successfully') :
            redirect()->back()->with('message','Appointment Made Before');
    }
}
