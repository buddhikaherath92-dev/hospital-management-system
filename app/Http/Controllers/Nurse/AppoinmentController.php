<?php

namespace App\Http\Controllers\Nurse;

use App\Appoinment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AppoinmentController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        $appoinments = Appoinment::where('doctor',Auth::user()->name)->where('date',Carbon::today())->get();
        return view('doctor.pages.all_appoinments',['appoinments' => $appoinments]);
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
            'title' => 'required|string',
            'date' => 'required|date',
            'doctor' => 'required|string',
            'patient_id' => 'required'
        ]);
        $data['isAppointed'] = '1';
        Appoinment::create($data);
        return redirect()->back()->with('message','Appointed Successfully');
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
