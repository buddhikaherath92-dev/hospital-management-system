@extends('patient.pages.dashboard_main')
@section('child-content')
    <div class="container">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#personal_data">Personal Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#emergency_contact">Emergency Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#patient_bar_code">Patient Bar Code</a>
            </li>
        </ul>
    </div>
    <div class="tab-content">

        <div id="personal_data" class="container tab-pane active"><br>
            <h4>Personal Data</h4>
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
                        <label>Date of Birth</label>
                        <input type="date" class="form-control" name="dob" value="{{ $patient_detail['dob']  }}">
                        @if ($errors->has('age'))
                            <span class="invalid-feedback" style="display: block">
                    <small>{{ $errors->first('age') }}</small>
                </span>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label>Height</label><span> (m)</span>

                        <input type="text" class="form-control" name="height" value="{{ $patient_detail['height']  }}">
                        @if ($errors->has('height'))
                            <span class="invalid-feedback" style="display: block">
                    <small>{{ $errors->first('height') }}</small>
                </span>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label>Weight</label><span> (kg)</span>
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
            <br>
        </div>

        <div id="emergency_contact" class="container tab-pane fade"><br>
            <h4>Emergency Details</h4>
            <form action="{{route('emergency')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Contact Name</label>
                    <input type="text" name="contact_name" class="form-control" id="formGroupExampleInput" placeholder="Contact Name">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Contact Number</label>
                    <input type="text" name="tel" class="form-control" id="formGroupExampleInput2" placeholder="Contact Number">
                </div>
                <button class="btn btn-primary" type="submit">Save or Update</button>
            </form>
            <br>
            <hr>
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Contact Name</th>
                    <th scope="col">Telephone Number</th>
                </tr>
                </thead>
                <tbody>
                @foreach($details as $detail)
                    <tr>
                        <td>{{$detail->contact_name}}</td>
                        <td>{{$detail->tel}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div id="patient_bar_code" class="container tab-pane fade"><br>
            <h4>Patient Bar Code</h4>
            <img src="https://www.incimages.com/uploaded_files/image/970x450/*Barcode_32896.jpg" class="img-thumbnail">
            <br>
            <br>
            <div class="text-center">
                <button class="btn btn-success">Print Bar Code</button>
            </div>
        </div>

    </div>



@endsection
