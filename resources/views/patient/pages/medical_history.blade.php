@extends('patient.pages.dashboard_main')
@section('child-content')

    <div class="container">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{$active_tab === 'diagnoses' ? 'active' : ''}}" data-toggle="tab" href="#diagnoses">Diagnoses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{$active_tab === 'prescriptions' ? 'active' : ''}}" data-toggle="tab" href="#prescriptions">Prescriptions</a>
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
        <div id="diagnoses" class="container tab-pane {{$active_tab === 'diagnoses' ? 'active' : 'fade'}}"><br>
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

        <div id="prescriptions" class="container tab-pane {{$active_tab === 'prescriptions' ? 'active' : 'fade'}}"><br>
            <div class="row" style="margin-bottom: 10px">
                <div class="col-4">
                    <h4>Prescriptions</h4>
                </div>
                <div class="col-8">
                    <div class="search-container text-right">
                        <form action="{{route('show_patient_medical_history')}}" method="GET">
                            <div class="input-group">
                                <input type="hidden" value="prescription_by_doc" name="filter_by">
                                <input type="hidden" value="prescriptions" name="active_tab">
                                <input type="text" class="form-control" name="filter_param"
                                       placeholder="Search by Doctor Name"
                                       value="{{$active_tab === 'prescriptions' ? $filter_param : '' }}">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
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
                @if(count($prescriptions) == 0)
                    <tr>
                        <td colspan="3" class="text-center">
                            Sorry there are no relevant records found!
                        </td>
                    </tr>
                @endif
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
            <hr>
            <div class="card-columns">

                @if($patient_type == 2)
                <div class="card bg-info">
                    <div class="card-header text-center">
                        <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjI0cHgiIHZpZXdCb3g9IjAgLTU5IDUxMiA1MTIiIHdpZHRoPSIyNHB4Ij48cGF0aCBkPSJtNDg5Ljk3NjU2MiAxNDAuNDI1NzgxYzAtMTcuOTM3NS0xNC41OTM3NS0zMi41MzEyNS0zMi41MzEyNS0zMi41MzEyNWgtNDEuMDk3NjU2djE1LjAxNTYyNWg0MS4wOTc2NTZjOS42NjAxNTcgMCAxNy41MTk1MzIgNy44NTkzNzUgMTcuNTE5NTMyIDE3LjUxNTYyNSAwIDkuNjYwMTU3LTcuODU5Mzc1IDE3LjUxOTUzMS0xNy41MTk1MzIgMTcuNTE5NTMxaC0xNjIuMzI0MjE4djE1LjAxMTcxOWg2OS4wNDY4NzV2MzAuMDMxMjVoLTY5LjA0Njg3NXYxNS4wMTU2MjVoNTcuOTY4NzV2MjguMDI3MzQ0aC01Ny45Njg3NXYxNS4wMTE3MTloMzUuODA4NTk0djI3LjAyNzM0M2gtNTQuMDMxMjV2MTUuMDE1NjI2aDY5LjA0Mjk2OHYtNDIuMDQyOTY5aDIyLjE2MDE1NnYtNDMuMDM5MDYzaDExLjA3ODEyNnYtNDUuMDQ2ODc1aDc4LjI2NTYyNGMxNy45Mzc1IDAgMzIuNTMxMjUtMTQuNTg5ODQzIDMyLjUzMTI1LTMyLjUzMTI1em0wIDAiIGZpbGw9IiMwMDAwMDAiLz48cGF0aCBkPSJtMTYyLjcwMzEyNSAyNjEuMDQyOTY5aC0yMy4wNjY0MDZ2LTE0MS4xMzY3MTloMzYuNDIxODc1bDcyLjIwNzAzMS0zOC44MTI1IDQ2LjE5NTMxMy02Mi4xMzY3MTljMTEuNjA1NDY4IDcuMzU1NDY5IDE4Ljg0Mzc1IDIwLjI0NjA5NCAxOC44NDM3NSAzNC4yNTM5MDcgMCA2LjAzNTE1Ni0xLjMyODEyNiAxMS44ODI4MTItMy45NDkyMTkgMTcuMzgyODEybC0yNC45MTQwNjMgNTIuMzE2NDA2aDExNi44OTA2MjV2LTE1LjAxNTYyNWgtOTMuMTA5Mzc1bDE0LjY4NzUtMzAuODQzNzVjMy41ODk4NDQtNy41MzEyNSA1LjQxMDE1Ni0xNS41NTQ2ODcgNS40MTAxNTYtMjMuODM5ODQzIDAtMjEuOTMzNTk0LTEyLjk0OTIxOC00MS44NjMyODItMzIuOTg4MjgxLTUwLjc2OTUzMmwtNS40ODgyODEtMi40NDE0MDYtNTEuNjM2NzE5IDY5LjQ1MzEyNS02NS45Mjk2ODcgMzUuNDQxNDA2aC0zMi42NDA2MjV2LTE1LjAxNTYyNWgtMTM5LjYzNjcxOXYxNS4wMTU2MjVoMTI0LjYyMTA5NHYxNzEuMTY0MDYzaC0xMjQuNjIxMDk0djE1LjAxNTYyNWgxMzkuNjM2NzE5di0xNS4wMTU2MjVoMTkuOTg4MjgxbDYzLjE1MjM0NCAyNy4wMjczNDRoMzkuMTA1NDY4di0xNS4wMTU2MjZoLTM2LjAyNzM0M3ptMCAwIiBmaWxsPSIjMDAwMDAwIi8+PHBhdGggZD0ibTQ0Ni45Mzc1IDE5NS45ODA0NjloMTUuMDExNzE5djE1LjAxNTYyNWgtMTUuMDExNzE5em0wIDAiIGZpbGw9IiMwMDAwMDAiLz48cGF0aCBkPSJtNTAyLjk5MjE4OCAzMDYuNzU3ODEyLTYuNTUwNzgyLTEwLjEyODkwNi0xMi42MDU0NjggOC4xNTYyNSA2LjU1MDc4MSAxMC4xMjVjNC4zNzg5MDYgNi43Njk1MzIgNi41OTc2NTYgMTQuMTIxMDk0IDYuNTk3NjU2IDIxLjg1OTM3NSAwIDE5LjkwNjI1LTE2LjI2NTYyNSA0MS4zOTA2MjUtNDIuNTQyOTY5IDQxLjM5MDYyNXMtNDIuNTM5MDYyLTIxLjQ4NDM3NS00Mi41MzkwNjItNDEuMzkwNjI1YzAtNy42MjUgMi4yODEyNS0xNS4xODM1OTMgNi41OTc2NTYtMjEuODU5Mzc1bDM1Ljk0MTQwNi01NS41NTg1OTQgMjEuMjM4MjgyIDMyLjgyODEyNiAxMi42MDU0NjgtOC4xNTYyNS0zMy44NDM3NS01Mi4zMTY0MDctNDguNTQ2ODc1IDc1LjA1MDc4MWMtNS44OTQ1MzEgOS4xMDU0NjktOS4wMDc4MTIgMTkuNDg0Mzc2LTkuMDA3ODEyIDMwLjAxMTcxOSAwIDMxLjEwMTU2MyAyNS44MjAzMTIgNTYuNDAyMzQ0IDU3LjU1NDY4NyA1Ni40MDIzNDQgMzEuNzM4MjgyIDAgNTcuNTU4NTk0LTI1LjMwMDc4MSA1Ny41NTg1OTQtNTYuNDAyMzQ0IDAtMTAuNTI3MzQzLTMuMTEzMjgxLTIwLjkwNjI1LTkuMDA3ODEyLTMwLjAxMTcxOXptMCAwIiBmaWxsPSIjMDAwMDAwIi8+PHBhdGggZD0ibTEwOS42MDU0NjkgMTQ3LjQzMzU5NGMwLTE1LjE3NTc4Mi0xMi4zNDc2NTctMjcuNTI3MzQ0LTI3LjUyNzM0NC0yNy41MjczNDQtMTUuMTc1NzgxIDAtMjcuNTIzNDM3IDEyLjM1MTU2Mi0yNy41MjM0MzcgMjcuNTI3MzQ0IDAgMTUuMTc5Njg3IDEyLjM0NzY1NiAyNy41MjczNDQgMjcuNTIzNDM3IDI3LjUyNzM0NCAxNS4xNzk2ODcgMCAyNy41MjczNDQtMTIuMzQ3NjU3IDI3LjUyNzM0NC0yNy41MjczNDR6bS0yNy41MjczNDQgMTIuNTExNzE4Yy02Ljg5ODQzNyAwLTEyLjUxMTcxOS01LjYxMzI4MS0xMi41MTE3MTktMTIuNTExNzE4IDAtNi44OTg0MzggNS42MTMyODItMTIuNTExNzE5IDEyLjUxMTcxOS0xMi41MTE3MTkgNi45MDIzNDQgMCAxMi41MTU2MjUgNS42MTMyODEgMTIuNTE1NjI1IDEyLjUxMTcxOSAwIDYuODk4NDM3LTUuNjEzMjgxIDEyLjUxMTcxOC0xMi41MTU2MjUgMTIuNTExNzE4em0wIDAiIGZpbGw9IiMwMDAwMDAiLz48cGF0aCBkPSJtNDcuNTQ2ODc1IDI0Ni4wMzEyNWgxNS4wMTU2MjV2MTUuMDExNzE5aC0xNS4wMTU2MjV6bTAgMCIgZmlsbD0iIzAwMDAwMCIvPjxwYXRoIGQ9Im03Ny41NzQyMTkgMjQ2LjAzMTI1aDE1LjAxNTYyNXYxNS4wMTE3MTloLTE1LjAxNTYyNXptMCAwIiBmaWxsPSIjMDAwMDAwIi8+PHBhdGggZD0ibTQ1MC4xNDA2MjUgMzA3Ljk3NjU2MiAxMi42MDU0NjktOC4xNTYyNSAxNi4wMTU2MjUgMjQuNzU3ODEzLTEyLjYwNTQ2OSA4LjE1MjM0NHptMCAwIiBmaWxsPSIjMDAwMDAwIi8+PC9zdmc+Cg==" />
                         HbA1C Report
                    </div>
                    <div class="card-body">
                        <p class="text-black-50">How your HbA1C value changed with time (HbA1C vs Time)</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{route('show_hba1c_report')}}" class="text-white">View Report</a>
                    </div>
                </div>
                @endif

                @if($patient_type == 1)
                <div class="card bg-info">
                    <div class="card-header text-center">
                        <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjI0cHgiIHZpZXdCb3g9IjAgMCA2MCA2MCIgd2lkdGg9IjI0cHgiPjxnIGlkPSIwMTctLS1CbG9vZC1QcmVzc3VyZS1DaGVjayIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAtMSkiPjxwYXRoIGlkPSJTaGFwZSIgZD0ibTUxIDFjLTQuOTYzIDAtOSA1LjM4My05IDEyIDAgNi4xNjYgMy41MDcgMTEuMjU1IDggMTEuOTIxdjE1LjA3OWMwIDIuMjA5MTM5LTEuNzkwODYxIDQtNCA0aC02di03Yy0uMDA1MjUxNC0xLjI2Njc4NTQtLjgwNTY0OTEtMi4zOTM3NDU0LTItMi44MTYgMC0yLjE3OS0uMTYxLTMuMjE2LjYzMi00LjUyLjYyNC0xLjAxNSAxLjM2OC0yLjk5NSAxLjM2OC02LjY2NHYtMTUuODljLjAyMjc0ODktMS4wMDY3NzUwNC0uNDU2NTA3NC0xLjk1ODk4Mzg5LTEuMjc4NjY0MS0yLjU0MDUwOTM2LS44MjIxNTY3LS41ODE1MjU0Ni0xLjg3OTYyMjItLjcxNjI2NjIyLTIuODIxMzM1OS0uMzU5NDkwNjQtLjI1NDY3MTItLjg4NDkxNTgxLS44OTczMjUyLTEuNjA2MzU0NzUtMS43NDcwMzctMS45NjEyMTE0OS0uODQ5NzExNy0uMzU0ODU2NzQtMS44MTQ1Nzg0LS4zMDQ3NTA4NC0yLjYyMjk2My4xMzYyMTE0OS0uNTQ1OTk4Mi0uODYzNTE2NzUtMS40OTc0OTcyLTEuMzg1Nzg3NzMtMi41MTkxNDU4LTEuMzgyNzQxMDctMS4wMjE2NDg3LjAwMzA0NjY3LTEuOTcwMDE1OS41MzA5ODMyNi0yLjUxMDg1NDIgMS4zOTc3NDEwNy0uOTQ3MjYtLjUzMzAzMzAxLTIuMTA3ODg3Ny0uNTE1OTEwOTctMy4wMzkwMTE5LjA0NDgzMjctLjkzMTEyNDEuNTYwNzQzNjctMS40ODkwODk1IDEuNTc4NTk2NTUtMS40NjA5ODgxIDIuNjY1MTY3M3Y5Ljg5Yy0yLjIwOTEzOSAwLTQgMS43OTA4NjEtNCA0djQuOTNjLjAwNDI1MiAxLjU4NzkzODYuNjM0MDgyNiAzLjExMDIzODcgMS43NTMgNC4yMzcgMi45NTIgMi45NTIgMy4yNDcgMi44MjcgMy4yNDcgNi4wMTctMS4xOTQzNTA5LjQyMjI1NDYtMS45OTQ3NDg2IDEuNTQ5MjE0Ni0yIDIuODE2djdoLTdjLTIuMjA5MTM5IDAtNC0xLjc5MDg2MS00LTR2LTIxLjA1OWM0Ljc0NjQzMjUtLjUzMDY2NzMgOC4yNTE4MDI1LTQuNjc2NDQxMSA3Ljk4NjA1NzItOS40NDUwNDc3MS0uMjY1NzQ1NC00Ljc2ODYwNjYyLTQuMjEwMDUxNi04LjQ5OTIyNDItOC45ODYwNTcyLTguNDk5MjI0Mi00Ljc3NjAwNTYxIDAtOC43MjAzMTE4NCAzLjczMDYxNzU4LTguOTg2MDU3MTggOC40OTkyMjQyLS4yNjU3NDUzNCA0Ljc2ODYwNjYxIDMuMjM5NjI0NjQgOC45MTQzODA0MSA3Ljk4NjA1NzE4IDkuNDQ1MDQ3NzF2MjEuMDU5Yy4wMDMzMDczOCAzLjMxMjMzNzYgMi42ODc2NjI0IDUuOTk2NjkyNiA2IDZoN3Y3Yy4wMDUyNTE0IDEuMjY2Nzg1NC44MDU2NDkxIDIuMzkzNzQ1NCAyIDIuODE2djIuMTg0YzAgMS42NTY4NTQyIDEuMzQzMTQ1OCAzIDMgM2g5YzEuNjU2ODU0MiAwIDMtMS4zNDMxNDU4IDMtM3YtMi4xODRjMS4xOTQzNTA5LS40MjIyNTQ2IDEuOTk0NzQ4Ni0xLjU0OTIxNDYgMi0yLjgxNnYtN2g2YzMuMzEyMzM3Ni0uMDAzMzA3NCA1Ljk5NjY5MjYtMi42ODc2NjI0IDYtNnYtMTUuMDc5YzQuNDkzLS42NjYgOC01Ljc1NSA4LTExLjkyMSAwLTYuNjE3LTQuMDM3LTEyLTktMTJ6bS00OSA5YzAtMy44NjU5OTMyNSAzLjEzNDAwNjc1LTcgNy03IDMuODY1OTkzMiAwIDcgMy4xMzQwMDY3NSA3IDcgMCAzLjg2NTk5MzItMy4xMzQwMDY4IDctNyA3LTMuODY0MTY1NjYtLjAwNDQwODYtNi45OTU1OTEzNi0zLjEzNTgzNDMtNy03em0xOS4xNjcgMTYuNzUzYy0uNzQ1MDIwOC0uNzUwOTczMi0xLjE2NDI3ODYtMS43NjUxNjc3LTEuMTY3LTIuODIzdi00LjkzYzAtMS4xMDQ1Njk1Ljg5NTQzMDUtMiAyLTJ2NWMwIC41NTIyODQ3LjQ0NzcxNTMgMSAxIDFzMS0uNDQ3NzE1MyAxLTF2LTE2Ljg5Yy0uMDE4NTIxLS41NDcxNDE1Ni4zNzQ5MTE2LTEuMDIxNzUxOC45MTYtMS4xMDUuMjc4NTc1Ny0uMDIzNDgzNjYuNTU0MjYyNi4wNzA3MTcyOC43NjAyMTguMjU5NzYzMDYuMjA1OTU1My4xODkwNDU3Ny4zMjMzNzIzLjQ1NTY3MzQyLjMyMzc4Mi43MzUyMzY5NHYxMmMwIC41NTIyODQ3LjQ0NzcxNTMgMSAxIDFzMS0uNDQ3NzE1MyAxLTF2LTEyLjg5Yy0uMDM1ODcwNS0uNDIwNzc5NDYuMTk0NjE3OC0uODE5MjQxMjguNTc3MjUyNy0uOTk3OTM4MjUuMzgyNjM0OS0uMTc4Njk2OTYuODM2MTIxOC0uMDk5NjYzMTggMS4xMzU3NDczLjE5NzkzODI1LjE4NDQ1NTguMTgyMTE4OTcuMjg3ODg4LjQzMDc4ODczLjI4Ny42OXYxM2MwIC41NTIyODQ3LjQ0NzcxNTMuOTk5OTk5OSAxIC45OTk5OTk5czEtLjQ0NzcxNTIgMS0uOTk5OTk5OXYtMTJjMC0uNTUyMjg0NzUuNDQ3NzE1My0xIDEtMXMxIC40NDc3MTUyNSAxIDF2MTJjMCAuNTUyMjg0Ny40NDc3MTUzIDEgMSAxczEtLjQ0NzcxNTMgMS0xdi0xMGMuMDAwNDQyMi0uMjgxMjkyMzEuMTE5MzM2Ny0uNTQ5MzkwNTYuMzI3NTI4LS43Mzg1NTE2NC4yMDgxOTE0LS4xODkxNjEwOC40ODY0MjQ5LS4yODE4OTAyMi43NjY0NzItLjI1NTQ0ODM2LjUzNjk0Mi4wODczMDY1OS45MjUxNDA1LjU2MDM0MzE2LjkwNiAxLjEwNHYxNS44OWMwIDMuMzctLjY3MiA0Ljk2NS0xLjA3NCA1LjYyMS0xLjEgMS44MDgtLjkyNiAzLjIzMy0uOTI2IDUuMzc5aC0xMXYtLjkzYy0uMDA0MjUyLTEuNTg3OTM4Ni0uNjM0MDgyNi0zLjExMDIzODctMS43NTMtNC4yMzd6bTEzLjgzMyAzMi4yNDdoLTljLS41NTIyODQ3IDAtMS0uNDQ3NzE1My0xLTF2LTJoMTF2MmMwIC41NTIyODQ3LS40NDc3MTUzIDEtMSAxem0zLTZjMCAuNTUyMjg0Ny0uNDQ3NzE1MyAxLTEgMWgtMTNjLS41NTIyODQ3IDAtMS0uNDQ3NzE1My0xLTF2LTE2YzAtLjU1MjI4NDcuNDQ3NzE1My0xIDEtMWgxM2MuNTUyMjg0NyAwIDEgLjQ0NzcxNTMgMSAxem0xMy0zMGMtMy44NTkgMC03LTQuNDg2LTctMTBzMy4xNDEtMTAgNy0xMCA3IDQuNDg2IDcgMTAtMy4xNDEgMTAtNyAxMHoiIGZpbGw9IiMwMDAwMDAiLz48cGF0aCBpZD0iU2hhcGUiIGQ9Im0xMS43IDguNzE1IDEuMDA4LTEuMDA4Yy4yNTk5NTY2LS4yNTEwNzQ0Ny4zNjQyMTI2LS42MjI4Nzc4OS4yNzI2OTcyLS45NzI1MDczMi0uMDkxNTE1NS0uMzQ5NjI5NDQtLjM2NDU2MDQtLjYyMjY3NDQtLjcxNDE4OTktLjcxNDE4OTg0LS4zNDk2Mjk0LS4wOTE1MTU0NC0uNzIxNDMyOC4wMTI3NDA1OC0uOTcyNTA3My4yNzI2OTcxNmwtMS4wMDkgMS4wMDdjLTEuMzE4NDgyNS0uNjI5Mzc4NjktMi44OTg2MzA5My0uMjE3NDMxNDMtMy43NDIwMjA5NC45NzU1NTA5NC0uODQzMzkwMDEgMS4xOTI5ODIzNi0uNzA0NzQxNTYgMi44MjAwNDkxNi4zMjgzMzk2NiAzLjg1MzEzMDM2IDEuMDMzMDgxMjMgMS4wMzMwODEyIDIuNjYwMTQ3OTggMS4xNzE3Mjk3IDMuODUzMTMwMzguMzI4MzM5NiAxLjE5Mjk4MjMtLjg0MzM5IDEuNjA0OTI5Ni0yLjQyMzUzODQuOTc1NTUwOS0zLjc0MjAyMDl6bS0zLjcgMS4yODVjLjAwMDA1NzUxLS40MDI2MTY4LjI0MTU2MjAxLS43NjU5MzI5Ny42MTI3Njc1MS0uOTIxODM5MjcuMzcxMjA1NDktLjE1NTkwNjMxLjc5OTcwNjU4LS4wNzM5OTI1IDEuMDg3MjMyNDkuMjA3ODM5Mjd2LjAxNGwuMDExLjAwN2MuMzE4NjQxMy4zMjIyMjY1LjM4MDc2NjMuODE4NDQ5My4xNTEzOTczNiAxLjIwOTI4NDQtLjIyOTM2ODk2LjM5MDgzNTEtLjY5Mjg4OTI0LjU3ODU3My0xLjEyOTU4OTA3LjQ1NzUxMzMtLjQzNjY5OTg0LS4xMjEwNTk4LS43Mzc0MDM0My0uNTIwNjUxOS0uNzMyODA4MjktLjk3Mzc5Nzd6IiBmaWxsPSIjMDAwMDAwIi8+PHBhdGggaWQ9IlNoYXBlIiBkPSJtNTIgNmgtMmMtMS42NTY4NTQyIDAtMyAxLjM0MzE0NTc1LTMgMyAwIDEuNjU2ODU0MiAxLjM0MzE0NTggMyAzIDNoMmMxLjY1Njg1NDIgMCAzLTEuMzQzMTQ1OCAzLTMgMC0xLjY1Njg1NDI1LTEuMzQzMTQ1OC0zLTMtM3ptMCA0aC0yYy0uNTUyMjg0NyAwLTEtLjQ0NzcxNTI1LTEtMXMuNDQ3NzE1My0xIDEtMWgyYy41NTIyODQ3IDAgMSAuNDQ3NzE1MjUgMSAxcy0uNDQ3NzE1MyAxLTEgMXoiIGZpbGw9IiMwMDAwMDAiLz48cGF0aCBpZD0iU2hhcGUiIGQ9Im01MiAxNGgtMmMtMS42NTY4NTQyIDAtMyAxLjM0MzE0NTgtMyAzczEuMzQzMTQ1OCAzIDMgM2gyYzEuNjU2ODU0MiAwIDMtMS4zNDMxNDU4IDMtM3MtMS4zNDMxNDU4LTMtMy0zem0wIDRoLTJjLS41NTIyODQ3IDAtMS0uNDQ3NzE1My0xLTFzLjQ0NzcxNTMtMSAxLTFoMmMuNTUyMjg0NyAwIDEgLjQ0NzcxNTMgMSAxcy0uNDQ3NzE1MyAxLTEgMXoiIGZpbGw9IiMwMDAwMDAiLz48L2c+PC9zdmc+Cg==" />
                         Blood Pressure Report
                    </div>
                    <div class="card-body">
                        <p class="text-black-50">How your blood pressure changed with time (Blood Pressure vs Time)</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{route('show_bp_report')}}" class="text-white">View Report</a>
                    </div>
                </div>
                @endif

                @if($patient_type == 1 || $patient_type == 2)
                <div class="card bg-info">
                    <div class="card-header text-center">
                        <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBpZD0iTGF5ZXJfNSIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgNjQgNjQiIGhlaWdodD0iMjRweCIgdmlld0JveD0iMCAwIDY0IDY0IiB3aWR0aD0iMjRweCI+PHBhdGggZD0ibTQyIDloLTEwdjhoMTB6bS0yIDZoLTZ2LTRoNnoiIGZpbGw9IiMwMDAwMDAiLz48cGF0aCBkPSJtNTkgNDN2LTdjMC0xLjY1NC0xLjM0Ni0zLTMtM2gtMTNjMC0xLjg1OC0xLjI3OS0zLjQxMS0zLTMuODU4di00LjE0MmgyLjVsMy41LTQuNjY3di0xMC4zMzNjMC00Ljk2Mi00LjAzNy05LTktOXMtOSA0LjAzOC05IDl2MTAuMzMzbDMuNSA0LjY2N2gyLjV2NGgtNS4wMDdjLTEuMjQzIDAtMi4yOTQtLjg5LTIuNDk5LTIuMTE3bC0uMTUtLjkwNWMtLjY1NC0zLjkyNS0zLjM1NC03LjAzNi02LjkwNC04LjMyOCAyLjE0NC0xLjQzNiAzLjU2LTMuODggMy41Ni02LjY1IDAtNC40MTEtMy41ODktOC04LThzLTggMy41ODktOCA4YzAgMy4wMzEgMS42OTQgNS42NzMgNC4xODUgNy4wMy0zLjY0OCAxLjcxOS02LjE4NSA1LjQyMi02LjE4NSA5LjcxNXYxNS4yNTVoLTR2MjBoNjJ2LTIwem0tMy04Yy41NTIgMCAxIC40NDkgMSAxdjEyYzAgLjU1MS0uNDQ4IDEtMSAxaC0xNmMtLjU1MiAwLTEtLjQ0OS0xLTF2LTExYzEuNDc0IDAgMi43NS0uODEgMy40NDQtMnptLTE5IDhoLTl2LTZoOXptNC41LTIwaC0xLjV2LTJoM3ptLTEuMDcyLTE5LjA5NmMtLjkxOC42OTctMi4xMzQgMS4wOTYtMy40MjggMS4wOTZzLTIuNTEtLjM5OS0zLjQyOC0xLjA5NmMxLjAxNC0uNTczIDIuMTgyLS45MDQgMy40MjgtLjkwNHMyLjQxNC4zMzEgMy40MjguOTA0em0tOC40NjYgMS4yNDljMS4zMDggMS4xNjYgMy4xMTYgMS44NDcgNS4wMzggMS44NDdzMy43My0uNjgxIDUuMDM4LTEuODQ3YzEuMjEyIDEuMjU5IDEuOTYyIDIuOTY2IDEuOTYyIDQuODQ3djloLTE0di05YzAtMS44ODEuNzUtMy41ODggMS45NjItNC44NDd6bS41MzggMTcuODQ3LTEuNS0yaDN2MnptMy41LTJoMnY4aC0yem0tMjctMTBjMC0zLjMwOSAyLjY5MS02IDYtNnM2IDIuNjkxIDYgNi0yLjY5MSA2LTYgNi02LTIuNjkxLTYtNnptLTIgMTYuNzQ1YzAtNC44MjIgMy45MjMtOC43NDUgOC43NDUtOC43NDUgNC4yOTIgMCA3LjkyIDMuMDczIDguNjI2IDcuMzA3bC4xNS45MDVjLjM2NyAyLjE5NSAyLjI0OCAzLjc4OCA0LjQ3MiAzLjc4OGgxMC4wMDdjMS4xMDMgMCAyIC44OTcgMiAycy0uODk3IDItMiAyaC0xMi42MzZjLTMuMjc5IDAtNi4wODQtMi4yMzEtNi44Mi01LjQyNmwtMS41NjktNi43OTktMS45NDkuNDUgMS41NjkgNi43OThjLjkyIDMuOTg4IDQuMzQ4IDYuOCA4LjQwNSA2Ljk2MXY2LjAxNmgtMTl6bTMwIDE3LjI1NXYzYzAgMS42NTQgMS4zNDYgMyAzIDNoMTZjMS42NTQgMCAzLTEuMzQ2IDMtM3YtM2gydjEwaC01OHYtMTB6bS0zNCAxNnYtNGg1OHY0eiIgZmlsbD0iIzAwMDAwMCIvPjxwYXRoIGQ9Im00MSA0MmgxLjMyM2wyLjcwNyA2Ljc2OCAyLjkxNC03Ljc3MiAxLjMzNSA0LjAwNGg1LjcyMXYtMmgtNC4yNzlsLTIuNjY1LTcuOTk2LTMuMDg2IDguMjI4LTEuMjkzLTMuMjMyaC0yLjY3N3oiIGZpbGw9IiMwMDAwMDAiLz48cGF0aCBkPSJtNSA0N2gydjJoLTJ6IiBmaWxsPSIjMDAwMDAwIi8+PHBhdGggZD0ibTkgNDdoMnYyaC0yeiIgZmlsbD0iIzAwMDAwMCIvPjxwYXRoIGQ9Im0xMyA0N2gydjJoLTJ6IiBmaWxsPSIjMDAwMDAwIi8+PC9zdmc+Cg==" />
                        Cholesterol Report
                    </div>
                    <div class="card-body">
                        <p class="text-black-50">How your cholesterol value changed with time (Cholesterol vs Time)</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{route('show_cholesterol_report')}}" class="text-white">View Report</a>
                    </div>
                </div>
                @endif

            </div>

            @if($patient_type == 3)
                <h5 >No reports available for general patients!</h5>
            @endif

        </div>
    </div>
    </div>
@endsection
