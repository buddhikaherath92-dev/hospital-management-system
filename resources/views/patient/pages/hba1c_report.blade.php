@extends('patient.pages.dashboard_main')

@section('child-content')
    <div class="container">
        <div class="card w-100">
            <div class="card-body">
                <h3 class="card-title">HbA1C Report</h3>
                <hr>
                {!! $chart->html() !!}
            </div>
        </div>
    </div>
    {!! Charts::scripts() !!}
    {!! $chart->script() !!}
@endsection
