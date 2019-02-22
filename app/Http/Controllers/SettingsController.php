<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    /**
     * Show Donation page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        return view('patient.pages.settings');
    }

    public function update(Request $request){
//        dd(\request()->all());
        $incomingData = request()->validate([
            'password' => 'required|string|min:6'
        ]);
        $incomingData['password'] = Hash::make($incomingData['password']);
        Auth::user()->update($incomingData);
        return redirect()->back()->withSuccess('User Password Updated Successfully !');
    }
}
