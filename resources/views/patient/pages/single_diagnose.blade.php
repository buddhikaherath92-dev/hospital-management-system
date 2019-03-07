@extends('patient.pages.dashboard_main')

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
               <div class="row">
                   <div class="col-xl-12">
                        <p>Status : {{ $diagnose['is_ready'] === 1?'Ready': 'Not yet'}}</p>
                   </div>
               </div>
           </div>
           </div>
       </div>
   </div>
   <div class="container">
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
               <h4>Attach a report</h4>
               <form action="{{route('attach_report')}}" method="post" enctype="multipart/form-data">
                   {{csrf_field()}}
                   <div class="form-group">
                       <label for="exampleFormControlFile1">Report Title</label>
                       <input type="text" name="title" class="form-control-file" id="exampleFormControlFile1">
                   </div>
                   <div class="form-group">
                       <label for="exampleFormControlFile1">Upload your report</label>
                       <input type="file" name="report" class="form-control-file" id="exampleFormControlFile1">
                   </div>
                   <button class="btn btn-success" type="submit">Upload Report</button>
               </form>
           </div>
       </div>
   </div>
@endsection
