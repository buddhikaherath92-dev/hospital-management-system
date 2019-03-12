@extends('nurse.layouts.dashboard')

@section('child-content')

    <div class="jumbotron">
        <table class="table table-bordered">
            <thead class="bg-success">
            <th>Name</th>
            <th>Address</th>
            <th>Telephone Number</th>
            <th>Gender</th>
            </thead>
            <tbody>
            @foreach($results as $result)
                <tr>
                    <td>{{$result->full_name}}</td>
                    <td>{{$result->address}}</td>
                    <td>{{$result->tel_no}}</td>
                    <td>{{$result->gender}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
