@extends('patient.layouts.main')

@section('content')

    <h1 class="text-center mt-lg-5 display-4">Patient Details Page</h1>
    <br>
    <div class="container shadow p-5">
        <form action="{{ route('save_patient_details') }}" method="post">
            {{ csrf_field() }}
            @if ($errors->any())
                <div class="alert alert-danger text-center">
                    <strong>Error!</strong> Please fix the following errors
                </div>
            @endif
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" class="form-control" name="full_name" value="{{ old('full_name') }}">
                @if ($errors->has('full_name'))
                    <span class="invalid-feedback" style="display: block">
                         <small>{{ $errors->first('full_name') }}</small>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                @if ($errors->has('address'))
                    <span class="invalid-feedback" style="display: block">
                        <small>{{ $errors->first('address') }}</small>
                    </span>
                @endif
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Contact No</label>
                    <input type="tel" class="form-control" name="tel_no" value="{{ old('tel_no') }}">
                    @if ($errors->has('tel_no'))
                        <span class="invalid-feedback" style="display: block">
                            <small>{{ $errors->first('tel_no') }}</small>
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-4">
                    <label>Gender</label>
                    <select name="gender" class="form-control">
                        <option selected>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </select>
                    @if ($errors->has('gender'))
                        <span class="invalid-feedback" style="display: block">
                        <small>{{ $errors->first('gender') }}</small>
                    </span>
                    @endif
                </div>

                <div class="form-group col-md-4">
                    <label>Blood Group</label>
                    <select name="blood_group" class="form-control">
                        <option selected>O+</option>
                        <option>O-</option>
                        <option>A+</option>
                        <option>A-</option>
                        <option>B+</option>
                        <option>B-</option>
                        <option>AB+</option>
                        <option>AB-</option>
                    </select>
                    @if ($errors->has('blood_group'))
                        <span class="invalid-feedback" style="display: block">
                        <small>{{ $errors->first('blood_group') }}</small>
                    </span>
                    @endif
                </div>

            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Age</label>
                    <input type="text" class="form-control" name="age" value="{{ old('age') }}">
                    @if ($errors->has('age'))
                        <span class="invalid-feedback" style="display: block">
                            <small>{{ $errors->first('age') }}</small>
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-3">
                    <label>Height</label>
                    <input type="text" class="form-control" name="height" value="{{ old('height') }}">
                    @if ($errors->has('height'))
                        <span class="invalid-feedback" style="display: block">
                            <small>{{ $errors->first('height') }}</small>
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-3">
                    <label>Weight</label>
                    <input type="text" class="form-control" name="weight" value="{{ old('weight') }}">
                    @if ($errors->has('weight'))
                        <span class="invalid-feedback" style="display: block">
                            <small>{{ $errors->first('weight') }}</small>
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-3">
                    <label>Patient Category</label>
                    <select name="patient_category" class="form-control">
                        @foreach($patient_categories as $catName => $catIndex)
                            <option >{{ $catName }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('patient_category'))
                        <span class="invalid-feedback" style="display: block">
                            <small>{{ $errors->first('patient_category') }}</small>
                        </span>
                    @endif
                </div>

            </div>
            <div class="form-group">
                <label >Allergies</label>
                <textarea type="text" class="form-control" name="allergies" ></textarea>
                @if ($errors->has('allergies'))
                    <span class="invalid-feedback" style="display: block">
                        <small>{{ $errors->first('allergies') }}</small>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label >Medical Condition</label>
                <textarea type="text" class="form-control" name="medical_condition"></textarea>
                @if ($errors->has('medical_condition'))
                    <span class="invalid-feedback" style="display: block">
                        <small>{{ $errors->first('medical_condition') }}</small>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <div class="float-right">
                    <button type="submit" class="btn btn-success ">Save Details</button>
                </div>
            </div>
        </form>
    </div>
@endsection
