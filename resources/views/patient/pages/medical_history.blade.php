@extends('patient.pages.dashboard_main')
@section('child-content')
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
            <td><a href="{{ url('/patient/single/'.$diagnose['id']) }}" class="btn btn-outline-primary">More</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
<h4>Attached Reports</h4>
<table class="table table-hover">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Title</th>
        <th scope="col">Report</th>
        <th scope="col">Download</th>
    </tr>
    </thead>
    <tbody>
    @foreach($reports as $report)
        <tr>
            <td>{{$report->title}}</td>
            <td>{{$report->report}}</td>
            <td><a href="{{ url('/patient/completed_request/download/'.$report['id']) }}">
                    <button class="btn btn-success">Download Report</button>
                </a></td>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<h4>Events</h4>
<table class="table table-hover">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Doctor Name</th>
        <th scope="col">Event</th>
        <th scope="col">Type</th>
        <th scope="col">Date</th>
        <th scope="col">Description</th>
        <th scope="col">Time</th>
        <th scope="col">Venue</th>
    </tr>
    </thead>
    <tbody>
    @foreach($events as $event)
        <tr>
            <td>{{$event->doctor_name}}</td>
            <td>{{$event->name}}</td>
            <td>{{$event->type}}</td>
            <td>{{$event->date}}</td>
            <td>{{$event->description}}</td>
            <td>{{$event->time}}</td>
            <td>{{$event->venue}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
    <h4>Download Prescription</h4>
<a class="btn btn-danger" href="{{route('get_pdf')}}">Download Prescriptions</a>

@endsection
