<?php

namespace App\Http\Controllers\Doctor;

use App\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AllDonationsController extends Controller
{

    /**
     * Show all donation view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        return view('doctor.pages.all_donations',[
            'all_donations'=>Donation::join('patients','donations.patient_id','patients.id')
                ->select('full_name','donations.id','posted_date','organ_name','description','type')->get()
        ]);
    }
}
