<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedicalHistoryController extends Controller
{
    /**
     * Show medical_history page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        return view('patient.pages.medical_history');
    }
}
