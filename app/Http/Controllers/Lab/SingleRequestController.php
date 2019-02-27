<?php

namespace App\Http\Controllers\Lab;

use App\Diagnose;
use App\Laboratory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class SingleRequestController extends Controller
{
    /**
     * Show the single request page
     * @param $report_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($report_id){

        return view('lab.pages.single_request',[
           'diagnose'=>Diagnose::getSingleReport($report_id),
            'report'=>Laboratory::where('id',$report_id)->first()
        ]);
    }

    /**
     * Upload report
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request){

        $validatedData = $request->validate([
            'report' => 'required',
        ]);
        $file=$validatedData['report']->getClientOriginalName();
        $validatedData['report']->storeAs('public/upload',$file);
        $validatedData['report']=$file;
        $validatedData['is_ready']=(int)1;

        $report=Laboratory::find(request('report_id'));
        $report->update($validatedData);
        return Redirect::back()->withSuccess('Report Uploaded Successfully !');

    }
}
