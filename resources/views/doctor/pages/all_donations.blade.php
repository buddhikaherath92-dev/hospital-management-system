@extends('doctor.layouts.dashboard')

@section('child-content')
    <h4 class="">All Donations/Requests</h4>
    <hr><br>
    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Donation/Request ID</th>
            <th scope="col">Patient Name</th>
            <th scope="col">Organ Name</th>
            <th scope="col">Description</th>
            <th scope="col">Posted Date</th>
            <th scope="col">Type</th>
        </tr>
        </thead>
        <tbody>
        @foreach($all_donations as $donation)
            <tr >
                <th scope="row">{{ $donation['id'] }}</th>
                <th >{{ $donation['full_name'] }}</th>
                <td>{{ $donation['organ_name'] }}</td>
                <td>{{ $donation['description'] }}</td>
                <td>{{ $donation['posted_date'] }}</td>
                <td>{{ $donation['type'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
