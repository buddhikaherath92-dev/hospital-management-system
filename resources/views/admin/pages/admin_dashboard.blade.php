@extends('admin.layouts.dashboard')

@section('child-content')
    <div class="container">
        @if(Session::has('message'))
            <p class="alert alert-info">{{ Session::get('message') }}</p>
        @endif


    <div class="jumbotron">
        <h6>Add new user</h6>
        <form action="{{route('add_new_user')}}" method="post">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{csrf_field()}}
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="Enter name">
            </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect2">User Type</label>
                    <select name="user_type" class="form-control">
                        <option value="2">Doctor</option>
                        <option value="5">Nurse</option>
                        <option value="4">Lab</option>
                        <option value="3">Pharmacy</option>
                    </select>
                </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

            <div class="row">
                <div class="col-md-12">
                    <h4>All Users</h4>
                    <div class="table-responsive">
                        <h6>Doctors</h6>
                        <table id="mytable" class="table table-bordred table-striped">
                            <thead>
                            <th>Name</th>
                            <th>Email</th>
                            </thead>
                            <tbody>
                            @foreach($doctors as $doctor)
                            <tr>
                                <td>{{$doctor->name}}</td>
                                <td>{{$doctor->email}}</td>
                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <h6>Nurses</h6>
                        <table id="mytable" class="table table-bordred table-striped">
                            <thead>
                            <th>Name</th>
                            <th>Email</th>
                            </thead>
                            <tbody>
                            @foreach($nurses as $nurse)
                                <tr>
                                    <td>{{$nurse->name}}</td>
                                    <td>{{$nurse->email}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <h6>Lab users</h6>
                        <table id="mytable" class="table table-bordred table-striped">
                            <thead>
                            <th>Name</th>
                            <th>Email</th>
                            </thead>
                            <tbody>
                            @foreach($labs as $lab)
                                <tr>
                                    <td>{{$lab->name}}</td>
                                    <td>{{$lab->email}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <h6>Pharmacy</h6>
                        <table id="mytable" class="table table-bordred table-striped">
                            <thead>
                            <th>Name</th>
                            <th>Email</th>
                            </thead>
                            <tbody>
                            @foreach($pharmacies as $pharmacy)
                                <tr>
                                    <td>{{$pharmacy->name}}</td>
                                    <td>{{$pharmacy->email}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
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

