<?php

namespace App\Http\Controllers\Pharmacy;

use App\Diagnose;
use App\Notifications\PrescriptionReady;
use App\Pharmacy;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class SinglePatientPrescriptionController extends Controller
{
    /**
     * Show the single patient view
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id){
        return view('pharmacy.pages.single_patient',[
            'data'=>Diagnose::join('patients','diagnoses.patient_id','patients.id')
                ->join('users','diagnoses.doctor_id','users.id')
                ->join('prescriptions','diagnoses.id','prescriptions.diagnose_id')
                ->where('diagnoses.id',$id)
                ->first(),
            'pharmacy'=>Pharmacy::where('diagnose_id',$id)->first()
        ]);
    }
    /**
     * update prescription as ready
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(){
        $result=Pharmacy::where('diagnose_id',request('diagnose_id'));
        $result->update([
            'is_ready'=>request('is_ready')
        ]);
        $user = User::join('patients', 'users.id', 'patients.user_id')
            ->join('diagnoses', 'patients.id', 'diagnoses.patient_id')
            ->where('diagnoses.id', request('diagnose_id'))
            ->select('users.*')
            ->first();
        $user->notify(new PrescriptionReady());
        return Redirect::route('show_all_prescriptions');
    }
}
