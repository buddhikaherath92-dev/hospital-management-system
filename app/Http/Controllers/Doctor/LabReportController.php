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
        $validatedData = $request->validate([
            'report-title' => 'required',
            'report-description' => 'string|required',
        ]);
        Laboratory::create([
            'title'=>$validatedData['report-title'],
            'description'=>$validatedData['report-description'],
            'is_ready'=>(int)0,
            'diagnose_id'=>request('diagnose_id'),

        ]);
        return redirect()->back()->with('diagnose_id',request('diagnose_id'))->with('message',$validatedData['report-title'].' report requested successfully !');
    }
}
