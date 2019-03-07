<?php

namespace App\Http\Controllers;

use App\PatientReport;
use Illuminate\Support\Facades\Auth;

class PatientReportController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = request()->validate([
            'title' => 'required|string',
            'report' => 'required|mimes:pdf',
        ]);
        $file=$data['report']->getClientOriginalName();
        $data['report']->storeAs('public/upload',$file);
        $data['report']=$file;
        $data['patient_id']=Auth::id();
        PatientReport::create($data);
        return redirect()->route('show_patient_medical_history');
    }

    /**
     * download report
     * @param $report_id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($report_id){
        $report=PatientReport::find($report_id);
        $pathToFile = storage_path('app/public/upload/' . $report->report);
        return response()->download($pathToFile);
    }


}
