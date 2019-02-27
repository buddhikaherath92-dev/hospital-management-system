<?php

namespace App\Http\Controllers\Lab;

use App\Diagnose;
use App\Laboratory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequestController extends Controller
{
    public function show(){
        return view('lab.pages.all_requests',[
            'requests'=>Diagnose::getAllRequests()->where('is_ready',0)->get(),
            'ready'=>Diagnose::getAllRequests()->where('is_ready',1)->get()
        ]);
    }
}
