<?php

namespace App\Http\Controllers\Nurse;

use App\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $patients=Patient::where('full_name','LIKE','%'.$request->search.'%')->get();
        return view('nurse.pages.search_result',['results' => $patients]);
    }

}
