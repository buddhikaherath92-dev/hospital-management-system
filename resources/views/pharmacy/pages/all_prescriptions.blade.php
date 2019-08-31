@extends('pharmacy.layouts.dashboard')

@section('child-content')
    <div class="bg-dark p-3 mb-3">
        <form class="form-inline" action="{{route('show_all_prescriptions')}}" method="get">
            <input type="text" class="form-control mb-2 mr-sm-2"
                   id="inlineFormInputName2" name="patient_name"
                   value="{{count($filterParams) > 0 && isset($filterParams['patient_name']) ?
                   $filterParams['patient_name'] : '' }}"
                   placeholder="Search by Patient Name:">
            <div class="input-group mb-2 mr-sm-2">
                <select class="custom-select" name="doctor_name">
                    <option value=""
                        {{count($filterParams) > 0 && isset($filterParams['doctor_name'])
                        && $filterParams['doctor_name'] === '' ? 'selected' : ''}}>
                        All Doctors
                    </option>
                    @foreach($doctors as $docIndex => $doctor)
                        <option value="{{$doctor->id}}"
                            {{count($filterParams) > 0 && isset($filterParams['doctor_name'])
                   && $filterParams['doctor_name'] == $doctor->id ? 'selected' : ''}}>
                            {{$doctor->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-2 mr-sm-2">
                <select class="custom-select" name="report_status">
                    <option value=""
                        {{count($filterParams) > 0 && isset($filterParams['report_status'])
                           && $filterParams['report_status'] === '' ? 'selected' : ''}}>
                        Any Status
                    </option>
                    <option value="1"
                        {{count($filterParams) > 0 && isset($filterParams['report_status'])
                               && $filterParams['report_status'] === '1' ? 'selected' : ''}}>
                        Ready
                    </option>
                    <option value="0"
                        {{count($filterParams) > 0 && isset($filterParams['report_status'])
                               && $filterParams['report_status'] === '0' ? 'selected' : ''}}>
                        Pending
                    </option>
                </select>
            </div>
            <input type="date" class="form-control mb-2 mr-sm-2"
                   id="inlineFormInputName2" name="posted_date"
                   value="{{count($filterParams) > 0 && isset($filterParams['posted_date'])?
                   $filterParams['posted_date'] : ''}}">

            <input type="hidden" name="filter_enabled" value="true">

            <button type="submit" class="btn btn-primary mb-2">Search</button>  &nbsp; &nbsp;
            <a href="{{route('show_all_prescriptions')}}" class="btn btn-info mb-2">Reset Filters</a>
        </form>
    </div>

    <h4 class="">All Prescriptions</h4>
    <hr><br>
    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Diagnose ID</th>
            <th scope="col">Doctor Name</th>
            <th scope="col">Patient Name</th>
            <th scope="col">Posted Date</th>
            <th scope="col">Status</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($diagnoses as $diagnose)
            <tr >
                <th scope="row">{{ $diagnose['id'] }}</th>
                <td>{{ $diagnose['name'] }}</td>
                <td>{{ $diagnose['full_name'] }}</td>
                <td>{{ $diagnose['posted_date'] }}</td>
                <td>{{ $diagnose['is_ready'] === 1 ? 'Ready' : 'Pending'  }}</td>
                <td>
                    <a href="{{ url('/pharmacy/single/'.$diagnose['id']) }}" >
                        <button class="btn btn-outline-primary">More</button>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
