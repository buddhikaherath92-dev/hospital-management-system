<?php

namespace App\Http\Controllers\Doctor;

use App\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    /**
     * Retrieve the relevant patient and show with search view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
       return view('doctor.pages.search_patients',[
           'heading'=>'Search results for '.'"'.request('keyword').'"',
           'all_patients'=>Patient::where('full_name','like','%'.request('keyword').'%')->get()
       ]);
    }
}
