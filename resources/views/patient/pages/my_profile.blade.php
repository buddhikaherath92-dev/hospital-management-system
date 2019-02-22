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
            <label>Full Name</label>
            <input type="text" class="form-control" name="full_name" value="{{ $patient_detail['full_name'] }}">
            @if ($errors->has('full_name'))
                <span class="invalid-feedback" style="display: block">
                <small>{{ $errors->first('full_name') }}</small>
            </span>
            @endif
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" class="form-control" name="address" value="{{ $patient_detail['address'] }}">
            @if ($errors->has('address'))
                <span class="invalid-feedback" style="display: block">
                <small>{{ $errors->first('address') }}</small>
            </span>
            @endif
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Contact No</label>
                <input type="tel" class="form-control" name="tel_no" value="{{ $patient_detail['tel_no'] }}">
                @if ($errors->has('tel_no'))
                    <span class="invalid-feedback" style="display: block">
                    <small>{{ $errors->first('tel_no') }}</small>
                </span>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label>Gender</label>
                <select name="gender" class="form-control">
                    <option {{ $patient_detail['gender'] === "Male" ? 'selected' : ''}} >Male</option>
                    <option {{ $patient_detail['gender'] === "Female" ? 'selected' : ''}}>Female</option>
                    <option {{ $patient_detail['gender'] === "Other" ? 'selected' : ''}}>Other</option>
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
                    <option {{ $patient_detail['blood_group'] === "O+" ? 'selected' : ''}}>O+</option>
                    <option {{ $patient_detail['blood_group'] === "O-" ? 'selected' : ''}}>O-</option>
                    <option{{ $patient_detail['blood_group'] === "A+" ? 'selected' : ''}}>A+</option>
                    <option{{ $patient_detail['blood_group'] === "A-" ? 'selected' : ''}}>A-</option>
                    <option{{ $patient_detail['blood_group'] === "B+" ? 'selected' : ''}}>B+</option>
                    <option{{ $patient_detail['blood_group'] === "B-" ? 'selected' : ''}}>B-</option>
                    <option{{ $patient_detail['blood_group'] === "AB+" ? 'selected' : ''}}>AB+</option>
                    <option{{ $patient_detail['blood_group'] === "AB-" ? 'selected' : ''}}>AB-</option>
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
                <input type="text" class="form-control" name="age" value="{{ $patient_detail['age']  }}">
                @if ($errors->has('age'))
                    <span class="invalid-feedback" style="display: block">
                    <small>{{ $errors->first('age') }}</small>
                </span>
                @endif
            </div>
            <div class="form-group col-md-3">
                <label>Height</label>
                <input type="text" class="form-control" name="height" value="{{ $patient_detail['height']  }}">
                @if ($errors->has('height'))
                    <span class="invalid-feedback" style="display: block">
                    <small>{{ $errors->first('height') }}</small>
                </span>
                @endif
            </div>
            <div class="form-group col-md-3">
                <label>Weight</label>
                <input type="text" class="form-control" name="weight" value="{{ $patient_detail['weight']  }}">
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
                        <option value="{{ $catIndex }}" {{ $catIndex === $patient_detail['patient_category'] ? 'selected' : '' }}>{{ $catName }}</option>
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
            <textarea type="text" class="form-control" name="allergies" >{{ $patient_detail['allergies'] }}</textarea>
            @if ($errors->has('allergies'))
                <span class="invalid-feedback" style="display: block">
                <small>{{ $errors->first('allergies') }}</small>
            </span>
            @endif
        </div>

        <div class="form-group">
            <label >Medical Condition</label>
            <textarea type="text" class="form-control" name="medical_condition">{{ $patient_detail['medical_condition'] }}</textarea>
            @if ($errors->has('medical_condition'))
                <span class="invalid-feedback" style="display: block">
                <small>{{ $errors->first('medical_condition') }}</small>
            </span>
            @endif
        </div>
        <input type="text" hidden value="{{ $patient_detail['id'] }}" name="id">
        <div class="form-group">
            <div class="float-right">
                <button type="submit" class="btn btn-success ">Save Changes</button>
            </div>
        </div>
    </form>
@endsection