@extends('doctor.layouts.dashboard')

@section('child-content')
    <h4 class="">All Patients</h4>
    <hr><br>
    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Patient ID</th>
            <th scope="col">Full Name</th>
            <th scope="col">Address</th>
            <th scope="col">Contact No</th>
            <th scope="col">Gender</th>
            <th scope="col">Patient Category</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($all_patients as $patient)
            <tr >
                <th scope="row">{{ $patient['id'] }}</th>
                <td>{{ $patient['full_name'] }}</td>
                <td>{{ $patient['address'] }}</td>
                <td>{{ $patient['tel_no'] }}</td>
                <td>{{ $patient['gender'] }}</td>
                <td>{{ array_search($patient['patient_category'],config('constances.patient_categories')) }}</td>
                <td><a href="{{ url('/doctor/single/'.$patient['id']) }}" class="btn btn-outline-primary">More</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection