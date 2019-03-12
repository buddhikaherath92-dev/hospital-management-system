@extends('doctor.layouts.dashboard')

@section('child-content')

<div class="jumbotron">
    <table class="table table-bordered">
        <thead class="bg-success">
        <th>Patient ID</th>
        <th>Title</th>
        <th>Date</th>
        </thead>
        <tbody>
        @foreach($appoinments as $appoinment)
            <tr>
                <td>{{$appoinment->patient_id}}</td>
                <td>{{$appoinment->title}}</td>
                <td>{{$appoinment->date}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
