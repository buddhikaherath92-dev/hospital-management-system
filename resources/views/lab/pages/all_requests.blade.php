@extends('lab.layouts.dashboard')

@section('child-content')
    <h4 class="">All Report Requests</h4>
    <hr><br>
    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Report ID</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Dr Name</th>
            <th scope="col">Patient Name</th>
            <th scope="col">Posted date</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($requests as $request)
            <tr >
                <th scope="row">{{ $request['id'] }}</th>
                <td>{{ $request['title'] }}</td>
                <td>{{ $request['description'] }}</td>
                <td>{{ $request['name'] }}</td>
                <td>{{ $request['full_name'] }}</td>
                <td>{{ $request['posted_date'] }}</td>
                <td><a href="{{ url('/lab/single_request/'.$request['id']) }}" class="btn btn-outline-primary">More</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br>
    <h4 class="">Completed Report Requests</h4>
    <hr><br>
    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Report ID</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Dr Name</th>
            <th scope="col">Patient Name</th>
            <th scope="col">Posted date</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($ready as $readyed)
            <tr >
                <th scope="row">{{ $readyed['id'] }}</th>
                <td>{{ $readyed['title'] }}</td>
                <td>{{ $readyed['description'] }}</td>
                <td>{{ $readyed['name'] }}</td>
                <td>{{ $readyed['full_name'] }}</td>
                <td>{{ $readyed['posted_date'] }}</td>
                <td><a href="{{ url('/lab/completed_request/'.$readyed['id']) }}" class="btn btn-outline-primary">More</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection