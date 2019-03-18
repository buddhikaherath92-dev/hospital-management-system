@extends('doctor.layouts.dashboard')

@section('child-content')

<div class="jumbotron">
    <table class="table table-bordered">
        <thead class="bg-success">
        <th>Patient ID</th>
        <th>Title</th>
        <th>Date</th>
        <th>More</th>
        </thead>
        <tbody>
        @foreach($appoinments as $appoinment)
            <tr>
                <td>{{$appoinment->patient_id}}</td>
                <td>{{$appoinment->title}}</td>
                <td>{{$appoinment->date}}</td>
                <td><a href="{{ url('/doctor/single/'.$appoinment->patient_id) }}" class="btn btn-outline-primary">More</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
