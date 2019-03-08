<?php

namespace App\Http\Controllers\Doctor;

use App\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=request()->validate([
            'name' => 'required|string',
            'type' => 'required|string',
            'date' => 'required|date',
            'description' => 'required',
            'time' => 'required',
            'venue' => 'required',
            'patient_id' => 'required'
        ]);
        $data['doctor_name'] = Auth::user()->name;
        Event::create($data);
        return redirect()->back();
    }


}
