@extends('patient.pages.dashboard_main')
@section('child-content')
<form action="" method="post">
    {{ csrf_field() }}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('success')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" name="password" value="{{ old('password') }}">
        @if ($errors->has('password'))
            <span class="invalid-feedback" style="display: block">
                <small>{{ $errors->first('password') }}</small>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" class="form-control" name="confirm_password" value="{{ old('confirm_password') }}">
    </div>
    <button type="submit" class="btn btn-success">Save Changes</button>
</form>
@endsection