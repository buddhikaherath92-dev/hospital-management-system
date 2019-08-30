<?php

namespace App\Http\Controllers;

use App\DiagnoseValue;
use App\Patient;
use Carbon\Carbon;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BloodPressureReportController extends Controller
{
    /**
     * Show Blood Pressure Report
     * */
    public function show(){
        $fromDate = request()->has('from_date') ? Carbon::parse(request('from_date'))->format('Y-m-d')
            : Carbon::parse(new Carbon('first day of this month'))->format('Y-m-d');
        $toDate = request()->has('to_date') ? Carbon::parse(request('to_date'))->format('Y-m-d')
            : Carbon::parse(Carbon::now())->format('Y-m-d');
        $patientId = Patient::where('user_id',Auth::id())->value('id');
        $records = DiagnoseValue::join('diagnoses', 'diagnose_values.diagnose_id', 'diagnoses.id')
            ->where('diagnoses.patient_id', $patientId)
            ->whereBetween('diagnose_values.created_at', [$fromDate, $toDate])
            ->select(DB::raw('round(avg(diagnose_values.bp),2) as bp, DATE(diagnose_values.created_at) created_at'))
            ->groupBy('created_at')
            ->get();

        $labels = [];
        $values = [];

        foreach ($records as $index => $record){
            array_push($labels, $record->created_at->toDateString());
            array_push($values, $record->bp);
        }

        $headerFromDate = Carbon::parse($fromDate)->toFormattedDateString();
        $headerToDate =  Carbon::parse($toDate)->toFormattedDateString();

        $chart = Charts::create('line', 'highcharts')
            ->title('Average Blood Pressure per day vs Days ('.$headerFromDate.' to '.$headerToDate.' )')
            ->elementLabel('Blood Pressure')
            ->labels($labels)
            ->values($values)
            ->dimensions(1000,500)
            ->responsive(false);


        return view('patient.pages.bp_report', compact('chart', 'fromDate', 'toDate'));
    }
}
