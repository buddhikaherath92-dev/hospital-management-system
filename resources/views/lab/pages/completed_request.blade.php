@extends('lab.layouts.dashboard')

@section('child-content')
    <div class="container">
        <div class="card w-100">
            <div class="card-body">
                <h3 class="card-title">Diagnose</h3>
                <hr>
                <div class="row">
                    <div class="col-xl-6">
                        <h6><b>Doctor Name : </b>{{ 'Dr. '.$diagnose['name'] }}</h6>
                    </div>
                    <div class="col-xl-6">
                        <h6><b>Posted Date : </b>{{ $diagnose['posted_date'] }}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <h6><b>Diagnose : </b>{{ $diagnose['diagnose'] }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card w-100">
            <div class="card-body">
                <h3 class="card-title">Requested Report</h3>
                <hr>
                <div class="row">
                    <div class="col-xl-6">
                        <h6><b>Title : </b>{{ $report['title'] }}</h6>
                    </div>
                    <div class="col-xl-6">
                        <h6><b>Report Description : </b>{{ $report['description'] }}</h6>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="card w-100">
            <div class="card-body">
                <h3 class="card-title">Attach Report</h3>
                <hr>
                <div class="text-center">
                    <a href="{{ url('/lab/completed_request/download/'.$report['id']) }}">
                        <button class="btn btn-success">Download Report</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection