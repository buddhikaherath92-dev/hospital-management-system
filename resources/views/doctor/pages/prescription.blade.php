@extends('doctor.layouts.dashboard')

@section('child-content')
   <div class="container">
       <div class="card w-100">
           <div class="card-body">
               <h3 class="card-title">Diagnose</h3>
               <hr>
               <div class="row">
                   <div class="col-xl-6">
                       <h6><b>Doctor Name : </b>{{ $diagnose['name'] }}</h6>
                   </div>
                   <div class="col-xl-6">
                       <h6><b>Posted Date : </b>{{ $diagnose['posted_date'] }}</h6>
                   </div>
               </div>
               <div class="row">
                   <div class="col-xl-12">
                       <h6><b>Diagnose : </b>{{ $diagnose['diagnose'] }}</h6>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <div class="container">
       <div class="card w-100">
           <div class="card-body">
               <h3 class="card-title">Prescription</h3>
               <hr>
               <div class="row">
                   <div class="col-xl-12">
                       <pre>{{ $diagnose['prescription'] }}</pre>
                   </div>
               </div>
           </div>
       </div>
   </div>
@endsection