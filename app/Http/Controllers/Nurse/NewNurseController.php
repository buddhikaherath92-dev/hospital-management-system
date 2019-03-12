<?php

namespace App\Http\Controllers\Nurse;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class NewNurseController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('nurse.pages.all_users',['users' => User::where('user_type',5)->get()]);
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
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);
        $data['password'] = Hash::make($data['password']);
        $data['user_type'] = '5';
        $data['email_verified_at'] = Carbon::now();
        User::create($data);
        return redirect()->back();
    }

}
