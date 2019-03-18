<?php

namespace App\Http\Controllers;

use App\EmergencyDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmergencyDetailsController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=EmergencyDetail::where('patient_id',Auth::id())->get();
        return view('patient.pages.my_profile',['details'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = request()->validate([
            'contact_name' => 'required|string',
            'tel' => 'required|numeric',
        ]);
        $data['patient_id']=Auth::id();
        EmergencyDetail::updateOrCreate(['patient_id'=>Auth::id()],$data);
        return redirect()->route('show_patient_myprofile');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

}
