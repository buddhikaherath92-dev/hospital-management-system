<?php

namespace App\Http\Controllers\Nurse;

use App\Appoinment;
use App\Patient;
use App\UnregisteredAppoinment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
//        $unreg_appoinments = UnregisteredAppoinment::where('doctor',Auth::user()->name)
//            ->where('date',Carbon::today())->get();
        return view('doctor.pages.all_appoinments',[
            'appoinments' => Appoinment::getAppointmentByDate(Carbon::now()),
            'date'=>Carbon::now()->toDateString()
//            'unreg_appoinments'=>$unreg_appoinments
        ]);
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
            'time' => 'required',
            'date' => 'required|date',
            'doctor' => 'required|string',
            'patient_id' => 'required'
        ]);
        $data['isAppointed'] = '1';
        $response = Appoinment::updateOrCreate(['date'=>$data['date'],
            'patient_id'=>Patient::where('id',$data['patient_id'])->value('id')],$data);
        return $response->wasRecentlyCreated == true ? redirect()->back()->with('message','Appointed Successfully') :
            redirect()->back()->with('message','Appointment Made Before');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeUnregisterd()
    {
        $data = request()->validate([
            'name' => 'required|string',
            'title' => 'required|string',
            'time' => 'required',
            'date' => 'required|date',
            'doctor' => 'required|string',
        ]);
        $data['isAppointed'] = '1';
        $response = UnregisteredAppoinment::updateOrCreate(['date'=>$data['date'],'name'=>$data['name']],$data);
        return $response->wasRecentlyCreated == true ? redirect()->back()->with('message','Appointed Successfully') :
            redirect()->back()->with('message','Appointment Made Before');
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

    /**
     * Filter Appintment by Date
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filter(){
        $date=request('date_picker');
        return view('doctor.pages.all_appoinments',[
            'appoinments' => Appoinment::getAppointmentByDate($date),
            'date'=>$date
        ]);
    }

}
