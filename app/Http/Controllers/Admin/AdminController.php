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
        $users = new User();
        $filterParams = [];

        if(request()->has('filter_enabled') && request('filter_enabled') === 'true'){
            if(request()->has('user_name') && request('user_name') !== null){
                $users = $users->where('name', 'like', '%'.request('user_name').'%');
                $filterParams['user_name'] = request('user_name');
            }
            if(request()->has('email') && request('email') !== null){
                $users = $users->where('email', request('email'));
                $filterParams['email'] = request('email');
            }
            if(request()->has('user_type') && request('user_type') !== null){
                $users = $users->where('user_type', request('user_type'));
                $filterParams['user_type'] = request('user_type');
            }
        }

        return view('admin.pages.admin_dashboard',[
            'users'=>$users->get(),
            'filterParams' => $filterParams
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
