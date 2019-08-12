@extends('patient.pages.dashboard_main')
@section('child-content')

    <div class="container">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#diagnoses">Diagnoses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#prescriptions">Prescriptions</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#self_uploaded_reports">Self Uploaded Reports</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#lab_reports">Lab Reports</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#events">Events</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#statistic_reports">Statistic Reports</a>
        </li>
    </ul>
    <div class="tab-content">
        <div id="diagnoses" class="container tab-pane active"><br>
            <h4>Diagnose History</h4>
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Doctor Name</th>
                    <th scope="col">Diagnose</th>
                    <th scope="col">Posted Date</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($diagnoses as $diagnose)
                    <tr>
                        <th>{{ 'Dr. '.$diagnose['name'] }}</th>
                        <td>{{ $diagnose['diagnose'] }}</td>
                        <td>{{ $diagnose['posted_date'] }}</td>
                        <td><a href="{{ url('/patient/single/'.$diagnose['id']) }}" class="btn btn-outline-primary">More</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div id="self_uploaded_reports" class="container tab-pane fade"><br>
            <h4>Self Uploaded Reports</h4>
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Report</th>
                    <th scope="col">Download</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reports as $report)
                    <tr>
                        <td>{{$report->title}}</td>
                        <td>{{$report->report}}</td>
                        <td><a href="{{ url('/patient/completed_request/download/'.$report['id']) }}">
                                <button class="btn btn-success">Download Report</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div id="lab_reports" class="container tab-pane fade"><br>
            <h4>Lab Reports</h4>
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Download</th>
                </tr>
                </thead>
                <tbody>
                @foreach($doctor_reports as $report)
                    <tr>
                        <td>{{$report->title}}</td>
                        <td>{{$report->description}}</td>
                        <td><a href="{{ url('/patient/completed_request/doctor_report_download/'.$report['id']) }}">
                                @if($report['is_ready'] == '1')
                                    <button class="btn btn-success">Download Report</button>
                                @else
                                    <button disabled class="btn btn-success">Download Report</button>
                                @endif
                            </a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div id="events" class="container tab-pane fade"><br>
            <h4>Events</h4>
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Doctor Name</th>
                    <th scope="col">Event</th>
                    <th scope="col">Type</th>
                    <th scope="col">Date</th>
                    <th scope="col">Description</th>
                    <th scope="col">Time</th>
                    <th scope="col">Venue</th>
                </tr>
                </thead>
                <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>{{$event->doctor_name}}</td>
                        <td>{{$event->name}}</td>
                        <td>{{$event->type}}</td>
                        <td>{{$event->date}}</td>
                        <td>{{$event->description}}</td>
                        <td>{{$event->time}}</td>
                        <td>{{$event->venue}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div id="prescriptions" class="container tab-pane fade"><br>
            <div class="row" style="margin-bottom: 10px">
                <div class="col-4">
                    <h4>Prescriptions</h4>
                </div>
                <div class="col-8">
                    <div class="search-container text-right">
                        <form action="/action_page.php">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search this blog">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Diagnose</th>
                    <th scope="col">Prescription</th>
                    <th scope="col">Download</th>
                </tr>
                </thead>
                <tbody>
                @foreach($prescriptions as $prescription)
                    <tr>
                        <td>{{$prescription->diagnose}}</td>
                        <td>{{$prescription->prescription}}</td>
                        <td><a class="btn btn-danger" href="/patient/getPDF/{{$prescription->diagnose_id}}">Download Prescriptions</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div id="statistic_reports" class="container tab-pane fade"><br>
            <h4>Reports</h4>

            <table class="table table-hover">
                <thead class="thead bg-primary">
                <tr>
                    <th scope="col">Reports</th>
                </tr>
                </thead>
                <tbody>
                <tr><td><button class="btn btn-success">Report 1</button></td></tr>
                <tr><td><button class="btn btn-success">Report 2</button></td></tr>
                <tr><td><button class="btn btn-success">Report 3</button></td></tr>
                </tbody>
            </table>

        </div>
    </div>
    </div>
@endsection
