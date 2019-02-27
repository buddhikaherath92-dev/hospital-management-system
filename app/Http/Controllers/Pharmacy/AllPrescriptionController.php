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
        return view('pharmacy.pages.all_prescriptions',[
            'diagnoses'=>Diagnose::getNotReadyedPrescriptions()->where('is_ready',0)->get(),
            'completed'=>Diagnose::getNotReadyedPrescriptions()->where('is_ready',1)->get()
        ]);
    }
}
