<?php

namespace App\Http\Controllers;

use App\DiagnoseValue;
use App\Patient;
use App\User;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Hba1cReportController extends Controller
{

    /**
     * Show HbA1C Report
     * */
    public function show(){
       $patientId = Patient::where('user_id',Auth::id())->value('id');
       $records = DiagnoseValue::join('diagnoses', 'diagnose_values.diagnose_id', 'diagnoses.id')
           ->where('diagnoses.patient_id', $patientId)
           ->select('diagnose_values.hba1c', 'diagnose_values.created_at')
           ->get();

       $labels = [];
       $values = [];

       foreach ($records as $index => $record){
           array_push($labels, $record->created_at->toDateString());
           array_push($values, $record->hba1c);
       }

        $chart = Charts::create('line', 'highcharts')
            ->title('HbA1C vs TIme')
            ->elementLabel('HbA1C')
            ->labels($labels)
            ->values($values)
            ->dimensions(1000,500)
            ->responsive(false);


       return view('patient.pages.hba1c_report', compact('chart'));
    }

}
