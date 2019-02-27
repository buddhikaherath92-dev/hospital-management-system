<?php

namespace App\Http\Controllers\Lab;

use App\Diagnose;
use App\Laboratory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompletedRequestsController extends Controller
{
    public function show($report_id){

        return view('lab.pages.completed_request',[
            'diagnose'=>Diagnose::getSingleReport($report_id),
            'report'=>Laboratory::where('id',$report_id)->first()
        ]);
    }
    public function download($report_id){
        $report=Laboratory::find($report_id);
        $pathToFile = storage_path('app/public/upload/' . $report->report);
        return response()->download($pathToFile);
    }
}
