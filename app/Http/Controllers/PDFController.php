<?php

namespace App\Http\Controllers;


use App\Diagnose;
use App\DiagnoseValue;
use App\Patient;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPDF($id)
    {
        $prescription = Diagnose::where('diagnoses.id', $id)
            ->join('patients', 'diagnoses.patient_id', 'patients.id')
            ->join('users', 'diagnoses.doctor_id', 'users.id')
            ->join('prescriptions', 'diagnoses.id', 'prescriptions.diagnose_id')
            ->select(
                'diagnoses.posted_date as prescribed_date',
                'diagnoses.diagnose',
                'prescriptions.prescription',
                'prescriptions.id as prescription_id',
                'users.name as doctor_name',
                'patients.full_name as patient_name',
                'patients.dob as patient_dob'
            )->first();

        $diagnoseValues = DiagnoseValue::where('diagnose_id', $id)->first();

        $pdf = PDF::loadView('patient.pages.prescription',[
            'prescription' => $prescription,
            'diagnoseValues' => $diagnoseValues
        ]);
        return $pdf->download('prescription.pdf');
    }

}
