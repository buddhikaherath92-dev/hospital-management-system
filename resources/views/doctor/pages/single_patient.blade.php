@extends('doctor.layouts.dashboard')

@section('child-content')
   <div class="container">
       <div class="card w-100">
           <div class="card-body">
               <h3 class="card-title">{{ $patient['full_name'].'\'s'.' Profile' }}</h3>
               <hr>
               <div class="row">
                   <div class="col-xl-6">
                       <h6><b>Patient Name : </b>{{ $patient['full_name'] }}</h6>
                       <h6><b>Address : </b>{{ $patient['address'] }}</h6>
                       <h6><b>Age : </b>{{ $patient['age'].' Years' }}</h6>
                       <h6><b>Gender : </b>{{ $patient['gender'] }}</h6>
                   </div>
                   <div class="col-xl-6">
                       <h6><b>Patient Category : </b>{{ array_search($patient['patient_category'],config('constances.patient_categories')) }}</h6>
                       <h6><b>Blood Group : </b>{{ $patient['blood_group'] }}</h6>
                       <h6><b>Weight : </b>{{ $patient['weight'] }}</h6>
                       <h6><b>Height : </b>{{ $patient['height'] }}</h6>
                   </div>

               </div>
               <div class="row">
                   <div class="col-xl-12">
                       <h6><b>Allergies : </b>{{ $patient['allergies'] }}</h6>
                       <h6><b>Medical Condition : </b>{{ $patient['allergies'] }}</h6>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <div class="container">
       <div class="card w-100">
           <div class="card-body">
               <h3 class="card-title">Add Diagnose</h3>
               <hr>
               <form action="{{ route('save_diagnose') }}" method="post">
                   {{ csrf_field() }}
                   @if(session('success'))
                       <div class="alert alert-success alert-dismissible fade show" role="alert">
                           <strong>{{session('success')}}</strong>
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                           </button>
                       </div>
                   @elseif(session('errors'))
                       <div class="alert alert-danger alert-dismissible fade show" role="alert">
                           <strong>{{session('errors')}}</strong>
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                           </button>
                       </div>
                   @endif
                   <input type="text" name="patient_id" value="{{ $patient['id'] }}" hidden>
                   <label>Diagnose :</label>
                   <textarea name="diagnose" class="form-control"></textarea>
                   <br>
                   <label>Prescription :</label>
                   <textarea name="prescription" class="form-control"></textarea>
                   <br>
                   <div class="form-row">
                       <div class="col-md-3">
                           <select class="form-control" name="pharmacy_type">
                               <option value="0">From Hospital Pharmacy</option>
                               <option value="1">From External Pharmacy</option>
                           </select>
                       </div>
                   </div>
                   <div class="float-right">
                       <button type="submit" class="btn btn-success">Save</button>
                   </div>
               </form>
           </div>
       </div>
   </div>
   <div class="container">
       <div class="card w-100">
           <div class="card-body">
               <h3 class="card-title">Lab Reports</h3>
               <hr>
               <form action="{{ route('request_report') }}" method="post">
                   {{ csrf_field() }}
                   @if(session('message'))
                       <div class="alert alert-success alert-dismissible fade show" role="alert">
                           <strong>{{session('message')}}</strong>
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                           </button>
                       </div>
                   @endif

                   <input type="text" name="diagnose_id" value="{{ session('diagnose_id') === null ? old('diagnose_id') : session('diagnose_id') }}" hidden>

                   <label>Report Title :</label>
                   <input type="text" class="form-control" name="report-title">
                   <br>
                   <label>Report Description :</label>
                   <textarea name="report-description" class="form-control"></textarea>
                   <br>
                   <div class="float-right">
                       <button type="submit" class="btn btn-success">Request Report</button>
                   </div>

               </form>
           </div>
       </div>
   </div>
    <div class="container">
        <div class="card w-100">
            <div class="card-body">
                <h3 class="card-title">Diagnose History</h3>
                <hr>
                <table class="table table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Doctor Name</th>
                        <th scope="col">Diagnose</th>
                        <th scope="col">Posted Date</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($diagnoses as $diagnose)
                    <tr>
                        <th>{{ 'Dr. '.$diagnose['name'] }}</th>
                        <td>{{ $diagnose['diagnose'] }}</td>
                        <td>{{ $diagnose['posted_date'] }}</td>
                        <td><a href="{{ url('/doctor/single/prescription/'.$diagnose['id']) }}" class="btn btn-outline-primary">More</a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
