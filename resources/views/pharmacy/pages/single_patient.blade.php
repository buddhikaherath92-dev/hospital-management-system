@extends('pharmacy.layouts.dashboard')

@section('child-content')
   <div class="container">
       <div class="card w-100">
           <div class="card-body">
               <h3 class="card-title">{{ $data['full_name'].'\'s'.' Profile' }}</h3>
               <hr>
               <div class="row">
                   <div class="col-xl-6">
                       <h6><b>Patient Name : </b>{{ $data['full_name'] }}</h6>
                       <h6><b>Address : </b>{{ $data['address'] }}</h6>
                       <h6><b>Age : </b>{{ $data['age'].' Years' }}</h6>
                       <h6><b>Gender : </b>{{ $data['gender'] }}</h6>
                   </div>
                   <div class="col-xl-6">
                       <h6><b>Patient Category : </b>{{ array_search($data['patient_category'],config('constances.patient_categories')) }}</h6>
                       <h6><b>Blood Group : </b>{{ $data['blood_group'] }}</h6>
                       <h6><b>Weight : </b>{{ $data['weight'] }}</h6>
                       <h6><b>Height : </b>{{ $data['height'] }}</h6>
                   </div>

               </div>
               <div class="row">
                   <div class="col-xl-12">
                       <h6><b>Allergies : </b>{{ $data['allergies'] }}</h6>
                       <h6><b>Medical Condition : </b>{{ $data['medical_condition'] }}</h6>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <div class="container">
       <div class="card w-100">
           <div class="card-body">
               <h3 class="card-title">Diagnose</h3>
               <hr>
               <div class="row">
                   <div class="col-xl-6">
                       <h6><b>Doctor Name : </b>{{ $data['name'] }}</h6>
                   </div>
                   <div class="col-xl-6">
                       <h6><b>Posted Date : </b>{{ $data['posted_date'] }}</h6>
                   </div>
               </div>
               <div class="row">
                   <div class="col-xl-12">
                       <h6><b>Diagnose : </b>{{ $data['diagnose'] }}</h6>
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
                       <pre>{{ $data['prescription'] }}</pre>
                   </div>
               </div>
               <div class="row">
                   <div class="col-xl-9"></div>
                   <div class="col-xl-3">
                       <form action="{{ route('update_prescription') }}" method="post">
                           {{ csrf_field() }}
                           <input type="text" class="form-control" name="is_ready" value="1" hidden>
                           <input type="text" name="diagnose_id" value="{{ $data['id'] }}" hidden>
                           <br>
                           <div class="float-right">
                               <button class="btn btn-primary">Print Prescription</button>
                               <button type="submit" class="btn btn-success">Ready</button>
                           </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </div>
@endsection