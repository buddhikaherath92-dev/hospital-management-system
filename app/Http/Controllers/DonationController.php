<?php

namespace App\Http\Controllers;

use App\Donation;
use App\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DonationController extends Controller
{
    /**
     * Show Donation page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        return view('patient.pages.organ',[
            'donations'=>Donation::where('patient_id',Patient::getPatient(Auth::id())['id'])->get()
        ]);
    }

    /**
     * Store Donations
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request){
        $validatedData = $request->validate([
            'organ_name' => 'required|string',
            'description' => 'required|string',
            'type'=>'required'
        ]);
        $validatedData['posted_date']=Carbon::now();
        $validatedData['patient_id']=Patient::getPatient(Auth::id())['id'];

        Donation::create($validatedData);
        return Redirect::back()->withSuccess('Donation request submitted successfully !');
    }

    /**
     * Show Donation page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showDonations(){
        return view('patient.pages.organ',[
            'donations'=>Donation::where('patient_id',Patient::getPatient(Auth::id())['id'])->where('type','Donate')->get()
        ]);
    }

    /**
     * Show Donation page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRequests(){
        return view('patient.pages.organ',[
            'donations'=>Donation::where('patient_id',Patient::getPatient(Auth::id())['id'])->where('type','Request')->get()
        ]);
    }
}
