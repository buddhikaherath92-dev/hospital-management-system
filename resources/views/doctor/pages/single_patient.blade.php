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
                       <h6><b>Age : </b>{{ \Carbon\Carbon::parse($patient['dob'])->age .' Years'}}</h6>
                       <h6><b>Gender : </b>{{ $patient['gender'] }}</h6>
                   </div>
                   <div class="col-xl-6">
                       <h6><b>Patient Category : </b>{{ array_search($patient['patient_category'],config('constances.patient_categories')) }}</h6>
                       <h6><b>Blood Group : </b>{{ $patient['blood_group'] }}</h6>
                       <h6><b>Weight(kg) : </b>{{ $patient['weight'] }}</h6>
                       <h6><b>Height(m) : </b>{{ $patient['height'] }}</h6>
                   </div>

               </div>
               <div class="row">
                   <div class="col-xl-12">
                       <h6><b>Allergies : </b>{{ $patient['allergies'] }}</h6>
                       <h6><b>Medical Condition : </b>{{ $patient['medical_condition'] }}</h6>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <div class="container mt-3">
       <div class="card w-100">
           <div class="card-header">
               <ul class="nav nav-tabs card-header-tabs" role="tablist">
                   <li class="nav-item">
                       <a class="nav-link active" data-toggle="tab" href="#add_diagnose">
                           Add Diagnose
                       </a>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link" data-toggle="tab" href="#request_lab_report">
                           Request Lab Reports
                       </a>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link" data-toggle="tab" href="#patient_diagnose_history">
                           Patient Diagnose History
                       </a>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link" data-toggle="tab" href="#add_events">
                           Add Events
                       </a>
                   </li>
               </ul>
           </div>
           <div class="card-body">
               <div class="tab-content">
                   <div id="add_diagnose" class="container tab-pane active">
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

                           @if($patient['patient_category'] == 1 || $patient['patient_category'] == 2)
                               <div class="form-group">
                                   <label for="f_1" class="mt-3 mr-4">
                                       Cholesterol :
                                       <input id="f_1" class="form-control" type="number" step="any" name="cholesterol">
                                   </label>
                                   @if($patient['patient_category'] == 1)
                                   <label for="f_2" class="mt-3 mr-4">
                                       Blood Pressure :
                                       <input id="f_2" class="form-control" type="number" step="any" name="bp">
                                   </label>
                                   @endif
                                   @if($patient['patient_category'] == 2)
                                   <label for="f_3" class="mt-3 mr-4">
                                       HbA1C:
                                       <input id="f_3" class="form-control" type="number" step="any" name="hba1c">
                                   </label>
                                   @endif
                               </div>
                           @endif
                           <div class="form-row">
                               <div class="col-md-3">
                                   <label for="ware_to_collect"> Get Medicine From :
                                   <select id="ware_to_collect" class="form-control" name="pharmacy_type">
                                       <option value="0">Hospital Pharmacy</option>
                                       <option value="1">External Pharmacy</option>
                                   </select>
                                   </label>
                               </div>
                           </div>
                           <div class="float-right">
                               <button type="submit" class="btn btn-success">Save</button>
                           </div>
                       </form>
                   </div>
                   <div id="request_lab_report" class="container tab-pane fade">
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
                           <input type="hidden" name="patient_id" value="{{ $patient['id'] }}">
                           <div class="float-right">
                               <button type="submit" class="btn btn-success">Request Report</button>
                           </div>

                       </form>
                   </div>
                   <div id="patient_diagnose_history" class="container tab-pane fade">
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
                   <div id="add_events" class="container tab-pane fade">
                       <form action="{{route('add_event')}}" method="post">
                           {{csrf_field()}}
                           <div class="form-row">
                               <div class="col-md-4 mb-3">
                                   <label for="validationDefault01">Event Name</label>
                                   <input type="text" name="name" class="form-control" id="validationDefault01" placeholder="Event Name" required>
                               </div>
                               <div class="col-md-4 mb-3">
                                   <label for="validationDefault02">Patient Type</label>
                                   <select id="inputState" name="type" class="form-control">
                                       @foreach($patient_categories as $catName => $catIndex)
                                           <option >{{ $catName }}</option>
                                       @endforeach
                                   </select>
                               </div>
                               <div class="col-md-4 mb-3">
                                   <label for="validationDefaultUsername">Date</label>
                                   <div class="input-group">
                                       <input type="date" name="date" class="form-control" id="validationDefaultUsername" placeholder="Date" aria-describedby="inputGroupPrepend2" required>
                                   </div>
                               </div>
                           </div>
                           <div class="form-row">
                               <div class="col-md-12 mb-9">
                                   <label for="validationDefault01">Event Description</label>
                                   <textarea type="text" name="description" class="form-control" id="validationDefault01" placeholder="Event Name" value="Mark" required></textarea>
                               </div>
                           </div>
                           <div class="form-row mt-3">
                               <div class="col-md-3 mb-3">
                                   <label for="validationDefault03">Time</label>
                                   <input type="time" name="time" class="form-control" id="validationDefault03" placeholder="Time" required>
                               </div>
                               <div class="col-md-9 mb-6">
                                   <label for="validationDefault04">Venue</label>
                                   <input type="text" name="venue" class="form-control" id="validationDefault04" placeholder="Venue" required>
                               </div>
                           </div>
                           <input type="hidden" name="patient_id" value="{{ $patient['user_id'] }}">
                           <button class="btn btn-primary" type="submit">Submit Event</button>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </div>
@endsection
