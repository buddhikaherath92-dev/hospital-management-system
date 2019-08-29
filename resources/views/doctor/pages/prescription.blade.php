@extends('doctor.layouts.dashboard')

@section('child-content')
   <div class="container mt-3">
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
   <div class="container mt-3">
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
   @if($diagnoseValues !== null)
   <div class="container mt-3">
       <div class="card w-100">
           <div class="card-body">
               <h3 class="card-title">Diagnose Values</h3>
               <hr>
               <table class="table table-hover">
                   <thead class="thead-dark">
                   <tr>
                       @if($diagnoseValues->bp !== null)
                           <th>Blood Pressure</th>
                       @endif
                       @if($diagnoseValues->cholesterol !== null)
                           <th>Cholesterol</th>
                       @endif
                       @if($diagnoseValues->hba1c !== null)
                           <th>HbA1C Value</th>
                       @endif
                   </tr>
                   </thead>
                   <tbody>
                   <tr>
                       @if($diagnoseValues->bp !== null)
                           <td>{{$diagnoseValues->bp}}</td>
                       @endif
                       @if($diagnoseValues->cholesterol !== null)
                           <td>{{$diagnoseValues->bp}}</td>
                       @endif
                       @if($diagnoseValues->hba1c !== null)
                           <td>{{$diagnoseValues->bp}}</td>
                       @endif
                   </tr>
                   </tbody>

               </table>
           </div>
       </div>
   </div>
   @endif
   <div class="container mt-3">
       <div class="card w-100">
           <div class="card-body">
               <h3 class="card-title">Attached Reports</h3>
               <hr><br>
               <table class="table table-hover">
                   <thead class="thead-dark">
                   <tr>
                       <th scope="col">Report ID</th>
                       <th scope="col">Title</th>
                       <th scope="col">Description</th>
                       <th scope="col">Status</th>
                       <th scope="col"></th>
                   </tr>
                   </thead>
                   <tbody>
                   @if(count($reports) == 0)
                       <tr>
                           <td colspan="5">
                               <h5 class="text-center">
                                   Sorry no attached reports found!
                               </h5>
                           </td>
                       </tr>
                   @endif
                   @foreach($reports as $report)
                       <tr >
                           <th scope="row">{{ $report['id'] }}</th>
                           <td>{{ $report['title'] }}</td>
                           <td>{{ $report['description'] }}</td>
                           <td>{{ $report['is_ready'] === 1 ? 'Ready' : 'Not Ready' }}</td>
                           <td>
                               <a href="{{ url('/lab/completed_request/download/'.$report['id']) }}">
                                   <button class="btn btn-success" {{ $report['is_ready'] === 0 ? 'disabled': '' }}>Download Report</button>
                               </a>
                           </td>
                       </tr>
                   @endforeach
                   </tbody>
               </table>
           </div>
       </div>
   </div>
@endsection
