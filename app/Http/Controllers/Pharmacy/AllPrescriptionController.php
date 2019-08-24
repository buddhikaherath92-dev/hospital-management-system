<?php

namespace App\Http\Controllers\Pharmacy;

use App\Diagnose;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AllPrescriptionController extends Controller
{
    /**
     * Show all prescription view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
//        dd(Diagnose::getNotReadyedPrescriptions()->get());
        return view('pharmacy.pages.all_prescriptions',[
            'diagnoses'=>Diagnose::getNotReadyedPrescriptions()->get()
        ]);
    }
}
