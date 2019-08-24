<?php

namespace App\Http\Controllers\Lab;

use App\Diagnose;
use App\Laboratory;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequestController extends Controller
{
    /**
     * show all request view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        $doctors = User::where('user_type', (int)2)->get();
        $requests = Diagnose::getAllRequests();
        $filterParams = [];

        if(request()->has('filter_enabled') && request('filter_enabled') === 'true'){
            if(request()->has('report_title') && request('report_title') !== ''){
                $requests = $requests->where('title', 'like', '%'.request('report_title').'%');
                $filterParams['report_title'] = request('report_title');
            }
            if(request()->has('patient_name') && request('patient_name') !== null){
                $requests = $requests->where('full_name', 'like', '%'.request('patient_name').'%');
                $filterParams['patient_name'] = request('patient_name');
            }
            if(request()->has('doctor_name') && request('doctor_name') !== null){
                $requests = $requests->where('users.id', request('doctor_name'));
                $filterParams['doctor_name'] = request('doctor_name');
            }
            if(request()->has('report_status') && request('report_status') !== null){
                $requests = $requests->where('laboratories.is_ready', request('report_status'));
                $filterParams['report_status'] = request('report_status');
            }
            if(request()->has('posted_date') && request('posted_date') !== null){
                $requests = $requests->whereDate('posted_date', request('posted_date'));
                $filterParams['posted_date'] = request('posted_date');
            }
        }

        return view('lab.pages.all_requests',[
            'requests'=>$requests->get(),
            'doctors'=>$doctors,
            'filterParams' => $filterParams
        ]);
    }
}
