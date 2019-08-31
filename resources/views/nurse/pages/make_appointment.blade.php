@extends('nurse.layouts.dashboard')

@section('child-content')
    @if(Session::has('message'))
        <p class="alert alert-success">{{ Session::get('message') }}</p>
    @endif
    <div class="card">
        <div class="card-header">
            <h5 class="card-title text-center">{{'Making an appointment for '. $patient['full_name'] }}</h5>
        </div>

        <div class="card-body">
            <div class="row bg-info p-3 border border-primary">
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
            <div class="row mt-3 bg-light">
                <div class="col-6">
                    <div class="bg-dark p-3 mb-3">
                        <form class="form-inline" action="{{route('show_make_appointment')}}" method="get">
                            <input type="text" class="form-control mb-2 mr-sm-2"
                                   name="doctor_name"
                                   value="{{isset($filterParams['doctor_name']) ? $filterParams['doctor_name'] : '' }}"
                                   placeholder="Search by Doctor Name:">
                            <input type="text" class="form-control mb-2 mr-sm-2"
                                   name="doctor_speciality"
                                   value="{{isset($filterParams['doctor_speciality']) ? $filterParams['doctor_speciality'] : '' }}"
                                   placeholder="Search by Doctor Speciality:">
                            <input type="hidden" name="filter_enabled" value="true">
                            <input type="hidden" name="patient_id" value="{{$patient['id']}}">

                            <button type="submit" class="btn btn-primary mb-2">Search</button>  &nbsp; &nbsp;
                            <a href="{{'/nurse/make_appointment?patient_id='.$patient['id']}}" class="btn btn-info mb-2">Reset Filters</a>
                        </form>
                    </div>

                    <table class="table table-hover  border border-dark">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>Name</th>
                                <th>Speciality</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <form method="post" action="{{route('make_appoinment')}}">
                            @csrf
                            @if(count($doctors) == 0)
                                <tr>
                                    <td colspan="3">
                                        <h6 class="text-center">Sorry no relevant records found!</h6>
                                    </td>
                                </tr>
                            @endif
                            @foreach($doctors as $docIndex => $doctor)
                                <tr>
                                    <td>{{'Dr. '.$doctor->name}}</td>
                                    <td>{{$doctor->speciality !== null ? $doctor->speciality : 'Not Defined' }}</td>
                                    <td>
                                        <label for="select_doctor">
                                            <input type="radio" id="select_doctor"
                                                   name="doctor" value="{{$doctor->id}}">
                                            Select Doctor
                                        </label>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="appointment_name">Appointment Title : </label>
                        <input class="form-control" name="title" type="text"
                                   id="appointment_name"
                                   placeholder="Give a Title / Name for appointment">
                    </div>
                    <div class="form-group">
                        <label for="appointment_time">Appointment Time :</label>
                            <input type="time" name="time" class="form-control w-100"
                                   value="{{ Carbon\Carbon::now()->format('H:i')}}"
                                   id="appointment_time" placeholder="Time" required>
                    </div>
                    <div class="form-group">
                        <label for="appointment_date">Appointment Date :</label>
                            <input class="form-control " name="date" type="date"
                                   value="{{ Carbon\Carbon::today()->format('Y-m-d')}}"
                                   min="{{ Carbon\Carbon::today()->format('Y-m-d')}}"
                                   id="appointment_date">
                    </div>
                    <input type="hidden" id="id" name="patient_id" value="{{$patient['id']}}">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary" type="submit">Make Appointment</button>
            <button class="btn btn-info" type="reset">Reset</button>
        </div>

        </form>
    </div>

@endsection
