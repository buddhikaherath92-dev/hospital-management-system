<?php

namespace App\Http\Controllers\Lab;

use App\Diagnose;
use App\Laboratory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequestController extends Controller
{
    /**
     * show all request view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        return view('lab.pages.all_requests',[
            'requests'=>Diagnose::getAllRequests()->where('is_ready',0)->get(),
            'ready'=>Diagnose::getAllRequests()->where('is_ready',1)->get()
        ]);
    }
}
