@extends('nurse.layouts.dashboard')

@section('child-content')
    <div class="bg-dark p-3 mb-3">
        <form class="form-inline" action="{{route('show_nurse_dashboard')}}" method="get">
            <input type="text" class="form-control mb-2 mr-sm-2"
                   id="inlineFormInputName2" name="patient_name"
                   value="{{count($filter_params) > 0 && isset($filter_params['patient_name'])?
                   $filter_params['patient_name'] : '' }}"
                   placeholder="Search by Patient Name:">

            <div class="input-group mb-2 mr-sm-2">
                <select class="custom-select" id="inlineFormCustomSelect" name="patient_gender">
                    <option value=""
                        {{count($filter_params) > 0 && isset($filter_params['patient_gender']) &&
                        $filter_params['patient_gender'] === '' ? 'selected' : '' }}>Any Gender</option>
                    <option value="Male"
                        {{count($filter_params) > 0 && isset($filter_params['patient_gender']) &&
                    $filter_params['patient_gender'] === 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female"
                        {{count($filter_params) > 0 && isset($filter_params['patient_gender']) &&
                    $filter_params['patient_gender'] === 'Female' ? 'selected' : '' }}>Female</option>

                </select>
            </div>

            <div class="input-group mb-2 mr-sm-3">
                <select class="custom-select" id="inlineFormCustomSelect" name="patient_category">
                    <option value=""  {{count($filter_params) > 0 && isset($filter_params['patient_category']) &&
                    $filter_params['patient_category'] === '' ? 'selected' : '' }}>Any Patient Category</option>
                    <option value="3" {{count($filter_params) > 0 && isset($filter_params['patient_category']) &&
                    $filter_params['patient_category'] === '3' ? 'selected' : '' }}>General</option>
                    <option value="1" {{count($filter_params) > 0 && isset($filter_params['patient_category']) &&
                    $filter_params['patient_category'] === '1' ? 'selected' : '' }}>Heart Patient</option>
                    <option value="2" {{count($filter_params) > 0 && isset($filter_params['patient_category']) &&
                    $filter_params['patient_category'] === '2' ? 'selected' : '' }}>Diabetics Patient</option>
                </select>
            </div>

            <input type="hidden" name="filter_enabled" value="true">

            <button type="submit" class="btn btn-primary mb-2">Search</button>  &nbsp; &nbsp;
            <a href="{{route('show_nurse_dashboard')}}" class="btn btn-info mb-2">Reset Filters</a>
        </form>
    </div>

    <h4 class="">{{$heading}}</h4>
    <hr><br>
    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Patient ID</th>
            <th scope="col">Full Name</th>
            <th scope="col">Address</th>
            <th scope="col">Contact No</th>
            <th scope="col">Gender</th>
            <th scope="col">Patient Category</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @if(count($all_patients) === 0)
            <tr>
                <td colspan="6"><h6 class="text-center">Sorry no relavant records found!</h6></td>
            </tr>
        @endif
        @foreach($all_patients as $patient)
            <tr >
                <th scope="row">{{ $patient['id'] }}</th>
                <td>{{ $patient['full_name'] }}</td>
                <td>{{ $patient['address'] }}</td>
                <td>{{ $patient['tel_no'] }}</td>
                <td>{{ $patient['gender'] }}</td>
                <td>{{ array_search($patient['patient_category'],config('constances.patient_categories')) }}</td>
                <td><a href="{{ url('/doctor/single/'.$patient['id']) }}" class="btn btn-primary">Make Appointment</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

