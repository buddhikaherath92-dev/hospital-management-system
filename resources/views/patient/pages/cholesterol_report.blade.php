@extends('patient.pages.dashboard_main')

@section('child-content')
    <div class="container">
        <div class="card w-100">
            <div class="card-body">
                <h3 class="card-title">Cholesterol Report</h3>
                <hr>
                <div class="bg-dark p-3 mb-3 text-white">
                    <form class="form-inline justify-content-center" action="{{route('show_cholesterol_report')}}"
                          method="get" >

                        <label for="from_date" class="col-form-label">From :
                            <input type="date" class="form-control mb-2 ml-2 mr-sm-2"
                                   id="from_date" name="from_date"
                                   value="{{$fromDate}}">
                        </label>
                        <label for="to_date" class="col-form-label">To :
                            <input type="date" class="form-control mb-2 ml-2 mr-sm-2"
                                   id="to_date" name="to_date"
                                   value="{{$toDate}}">
                        </label>
                        <button type="submit" class="btn btn-primary mb-2">Search</button>  &nbsp; &nbsp;
                        <a href="{{route('show_cholesterol_report')}}" class="btn btn-info mb-2">Reset Filters</a>
                    </form>
                </div>
                {!! $chart->html() !!}
            </div>
        </div>
    </div>
    {!! Charts::scripts() !!}
    {!! $chart->script() !!}
@endsection
