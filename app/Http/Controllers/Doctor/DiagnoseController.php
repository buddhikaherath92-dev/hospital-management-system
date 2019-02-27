<?php

namespace App\Http\Controllers\Doctor;

use App\Diagnose;
use App\Pharmacy;
use App\Prescription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DiagnoseController extends Controller
{

    /**
     * Store Diagnose and Prescription
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        $validatedData = $request->validate([
            'diagnose' => 'required',
            'prescription' => 'string',
        ]);
        DB::beginTransaction();
        try {
            $result=Diagnose::create([
                'diagnose'=>$validatedData['diagnose'],
                'patient_id'=>request('patient_id'),
                'posted_date'=>Carbon::now(),
                'doctor_id'=>Auth::id()
            ]);
            Prescription::create([
                'prescription'=>$validatedData['prescription'],
                'diagnose_id'=>$result['id']
            ]);
            if (request('pharmacy_type') === '0' ){
                Pharmacy::create([
                   'diagnose_id'=>$result['id'],
                   'is_ready'=>false,
                ]);
            }
            DB::commit();
            return redirect()->back()->with('diagnose_id',$result['id'])->withSuccess('Diagnose Added Successfully !');
        }catch (Exception $exception){
            DB::rollback();
            return redirect()->back()->withErrors('Something went wrong !');
        }

    }
}
