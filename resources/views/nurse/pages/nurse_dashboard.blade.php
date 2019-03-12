@extends('nurse.layouts.dashboard')

@section('child-content')
    <div class="container">
        @if(Session::has('message'))
            <p class="alert alert-info">{{ Session::get('message') }}</p>
        @endif
        <div class="row">
            <div class="col-md-12">
                <h4>All Patients</h4>
                <div class="table-responsive">
                    <table id="mytable" class="table table-bordred table-striped">

                        <thead>
                        <th>Full Name</th>
                        <th>Address</th>
                        <th>Type</th>
                        <th>Birth-Day</th>
                        <th>Gender</th>
                        <th>Add Appoinment</th>
                        </thead>
                        <tbody>
                        @foreach($patients as$patient)
                        <tr>
                            <td>{{$patient->full_name}}</td>
                            <td>{{$patient->address}}</td>
                            <td>{{config('constances.patient_categories_inverse')[$patient->patient_category]}}</td>
                            <td>{{$patient->dob}}</td>
                            <td>{{$patient->gender}}</td>
                            <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" onclick="functionHere(this)" value="{{$patient->id}}" data-toggle="modal" data-target="#edit" id="btnAppoinment" >Make Appoinment</button></p></td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Make an Appoinment</h4>
                </div>
                <form action="{{route('make_appoinment')}}" method="post">
                    {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group">
                        <input class="form-control " name="title" type="text" placeholder="Title">
                    </div>
                    <div class="form-group">

                        <input class="form-control " name="date" type="date" placeholder="Date">
                    </div>
                    <div class="form-group">
                        <select class="custom-select custom-select-sm" name="doctor">
                            <option selected>Select a doctor</option>
                            @foreach($doctors as $doctor)
                            <option>{{$doctor->name}}</option>
                                @endforeach
                        </select>
                    </div>
                    <input type="hidden" id="id" name="patient_id" value="">

                </div>
                <div class="modal-footer ">

                    <button type="submit" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Make Appoinment</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>
        function functionHere (btn) {
            var buttonValue = btn.value;
            var s= document.getElementById('id');
            s.value=buttonValue
        }
    </script>
@endsection

