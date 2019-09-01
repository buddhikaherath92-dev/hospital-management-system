<?php

namespace App\Http\Controllers\Doctor;

use App\Laboratory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LabReportController extends Controller
{

    /**
     * Request lab reports
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){

        if(request('diagnose_id') === null){
            return redirect()->back()->with('active_tab', 'request_lab_report')
                ->withErrors('You have to add Diagnose record first !');
        }

        $validatedData = $request->validate([
            'report-title' => 'required',
            'report-description' => 'string|required',
        ]);
        Laboratory::create([
            'title'=>$validatedData['report-title'],
            'description'=>$validatedData['report-description'],
            'is_ready'=>(int)0,
            'patient_id'=>$request->patient_id,
            'diagnose_id'=>request('diagnose_id'),
        ]);
        return redirect()->back()->with('diagnose_id',request('diagnose_id'))
            ->with('message',$validatedData['report-title'].' report requested successfully !')
            ->with('active_tab', 'add_events');
    }
}
