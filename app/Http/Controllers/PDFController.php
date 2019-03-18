<?php

namespace App\Http\Controllers;


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
        $prescription=DB::table('prescriptions')
            ->select('prescriptions.prescription','diagnoses.diagnose')
            ->join('diagnoses','prescriptions.diagnose_id','=','diagnoses.id')
            ->where('patient_id',Patient::where('user_id',Auth::id())->value('id'))
            ->where('diagnose_id',$id)
            ->get();
        $pdf = PDF::loadView('patient.pages.prescription',['prescriptions' => $prescription]);
        return $pdf->download('prescription.pdf');
    }

}
