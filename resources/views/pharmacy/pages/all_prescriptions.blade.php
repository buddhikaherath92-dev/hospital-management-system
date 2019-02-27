@extends('pharmacy.layouts.dashboard')

@section('child-content')
    <h4 class="">All Prescriptions</h4>
    <hr><br>
    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Diagnose ID</th>
            <th scope="col">Doctor Name</th>
            <th scope="col">Patient Name</th>
            <th scope="col">Posted Date</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($diagnoses as $diagnose)
            <tr >
                <th scope="row">{{ $diagnose['id'] }}</th>
                <td>{{ $diagnose['name'] }}</td>
                <td>{{ $diagnose['full_name'] }}</td>
                <td>{{ $diagnose['posted_date'] }}</td>
                <td>
                    <a href="{{ url('/pharmacy/single/'.$diagnose['id']) }}" >
                        <button class="btn btn-outline-primary">More</button>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br>
    <h4 class="">Completed Prescriptions</h4>
    <hr><br>
    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Diagnose ID</th>
            <th scope="col">Doctor Name</th>
            <th scope="col">Patient Name</th>
            <th scope="col">Posted Date</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($completed as $done)
            <tr >
                <th scope="row">{{ $done['id'] }}</th>
                <td>{{ $done['name'] }}</td>
                <td>{{ $done['full_name'] }}</td>
                <td>{{ $done['posted_date'] }}</td>
                <td>
                    <a href="{{ url('/pharmacy/single/'.$done['id']) }}" >
                        <button class="btn btn-outline-primary">More</button>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection