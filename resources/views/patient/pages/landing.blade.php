@extends('patient.layouts.main')

@section('content')
    <div class="container">
        <div class="jumbotron text-center mt-lg-5">
            <h1>Welcome!</h1>
            <hr />
            <h4>Ruhunu Hospitals - Patients Portal</h4>

            <br />
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Sign In</a>
            <a href="{{ route('show_registration') }}" class="btn btn-info btn-lg">Sign Up</a>
        </div>
    </div>
@endsection
