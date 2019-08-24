@extends('lab.layouts.dashboard')

@section('child-content')
    <div class="bg-dark p-3 mb-3">
        <form class="form-inline" action="{{route('show_requests')}}" method="get">
            <input type="text" class="form-control mb-2 mr-sm-2"
                   id="inlineFormInputName2" name="report_title"
                   value="{{count($filterParams) > 0 && isset($filterParams['report_title']) ?
                   $filterParams['report_title'] : '' }}"
                   placeholder="Search by Report Title:">
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
                    <option value="2"
                        {{count($filterParams) > 0 && isset($filterParams['report_status'])
                               && $filterParams['report_status'] === '2' ? 'selected' : ''}}>
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
            <a href="{{route('show_requests')}}" class="btn btn-info mb-2">Reset Filters</a>
        </form>
    </div>

    <h4 class="">All Report Requests</h4>
    <hr><br>
    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Report ID</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Dr Name</th>
            <th scope="col">Patient Name</th>
            <th scope="col">Status</th>
            <th scope="col">Posted date</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @if(count($requests) === 0)
            <tr>
                <td colspan="7"><h6 class="text-center">Sorry no relavant records found!</h6></td>
            </tr>
        @endif
        @foreach($requests as $request)
            <tr >
                <th scope="row">{{ $request['id'] }}</th>
                <td>{{ $request['title'] }}</td>
                <td>{{ $request['description'] }}</td>
                <td>{{ $request['name'] }}</td>
                <td>{{ $request['full_name'] }}</td>
                <td>{{ $request['is_ready'] == 1? 'Ready' : 'Pending' }}</td>
                <td>{{ $request['posted_date'] }}</td>
                <td><a href="{{ url('/lab/single_request/'.$request['id']) }}" class="btn btn-outline-primary">More</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{--    <br>--}}
    {{--    <h4 class="">Completed Report Requests</h4>--}}
    {{--    <hr><br>--}}
    {{--    <table class="table table-hover">--}}
    {{--        <thead class="thead-dark">--}}
    {{--        <tr>--}}
    {{--            <th scope="col">Report ID</th>--}}
    {{--            <th scope="col">Title</th>--}}
    {{--            <th scope="col">Description</th>--}}
    {{--            <th scope="col">Dr Name</th>--}}
    {{--            <th scope="col">Patient Name</th>--}}
    {{--            <th scope="col">Posted date</th>--}}
    {{--            <th scope="col"></th>--}}
    {{--        </tr>--}}
    {{--        </thead>--}}
    {{--        <tbody>--}}
    {{--        @foreach($ready as $readyed)--}}
    {{--            <tr >--}}
    {{--                <th scope="row">{{ $readyed['id'] }}</th>--}}
    {{--                <td>{{ $readyed['title'] }}</td>--}}
    {{--                <td>{{ $readyed['description'] }}</td>--}}
    {{--                <td>{{ $readyed['name'] }}</td>--}}
    {{--                <td>{{ $readyed['full_name'] }}</td>--}}
    {{--                <td>{{ $readyed['posted_date'] }}</td>--}}
    {{--                <td><a href="{{ url('/lab/completed_request/'.$readyed['id']) }}" class="btn btn-outline-primary">More</a></td>--}}
    {{--            </tr>--}}
    {{--        @endforeach--}}
    {{--        </tbody>--}}
    {{--    </table>--}}
@endsection
