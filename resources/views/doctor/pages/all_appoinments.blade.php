@extends('doctor.layouts.dashboard')

@section('child-content')
    <form action="{{ route("filter_appoinments") }}" method="post">
        {{ csrf_field() }}
        {{--@if($errors->any())--}}
            {{--<div class="alert alert-danger" role="alert">--}}
                {{--{{$errors->first()}}--}}
            {{--</div>--}}
        {{--@endif--}}
        <div class="form-row col-6">
            <div class="col-7">
                <input class="form-control position-static" type="date" name="date_picker" id="datepicker" value="{{ $date }}">
            </div>
            <div class="col-3">
                <button class="btn btn-primary" type="submit">Filter</button>
            </div>
        </div>
    </form>
    <br><br>
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

{{--<div class="jumbotron">--}}
    {{--<h6>Patients not registered</h6>--}}
    {{--<table class="table table-bordered">--}}
        {{--<thead class="bg-success">--}}
        {{--<th>Name</th>--}}
        {{--<th>Title</th>--}}
        {{--<th>Date</th>--}}
        {{--</thead>--}}
        {{--<tbody>--}}
        {{--@foreach($unreg_appoinments as $appoinment)--}}
            {{--<tr>--}}
                {{--<td>{{$appoinment->name}}</td>--}}
                {{--<td>{{$appoinment->title}}</td>--}}
                {{--<td>{{$appoinment->date}}</td>--}}
            {{--</tr>--}}
        {{--@endforeach--}}
        {{--</tbody>--}}
    {{--</table>--}}
{{--</div>--}}
@endsection
