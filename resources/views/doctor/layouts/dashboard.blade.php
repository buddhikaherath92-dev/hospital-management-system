@extends('doctor.layouts.doctor_main')

@section('content')
    <br>
    <div class="container">
        <h3 class="display-4 text-center">Doctor Dashboard</h3>
    </div>
    <div class="row" style="margin: 0">
        <div class="col-xl-2"></div>
        <div class="col-xl-8 shadow p-5">
                @yield('child-content')
        </div>
        <div class="col-xl-2"></div>
    </div>
@endsection
