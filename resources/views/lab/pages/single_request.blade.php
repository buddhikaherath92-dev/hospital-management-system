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
                <form action="{{ route('ready_request') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{session('success')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <label>Requested Report :</label>
                    <input type="file" class="form-control" name="report">
                    <br>
                    <input type="text" name="report_id" value="{{ $report['id'] }}" hidden>
                    <div class="float-right">
                        <button class="btn btn-success">Ready</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection