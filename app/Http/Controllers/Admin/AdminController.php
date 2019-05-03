<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('admin.pages.admin_dashboard',[
            'doctors'=>User::where('user_type',2)->get(),
            'nurses'=>User::where('user_type',5)->get(),
            'labs'=>User::where('user_type',4)->get(),
            'pharmacies'=>User::where('user_type',3)->get()
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
            'name' => 'required|string',
            'user_type'=> 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);
        $data['password'] = Hash::make($data['password']);
        $data['email_verified_at'] = Carbon::now();
        User::create($data);
        return redirect()->back()->with('message','User created successfully');
    }

    /**
     * Delete a user from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        User::find($id)->delete();
        return redirect()->back()->with('message','User removed successfully');
    }


}
