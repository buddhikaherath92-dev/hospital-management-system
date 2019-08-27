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

            @if(isset($filterParams) && count($filterParams) >0)
            <script>
                $("html, body").animate({ scrollTop: 1000 }, 2000);
            </script>
            @endif

            <div class="bg-dark p-3 mb-3">
                <form class="form-inline" action="{{route('show_admin_dashboard')}}" method="get">
                    <input type="text" class="form-control mb-2 mr-sm-2"
                           id="inlineFormInputName2" name="user_name" placeholder="Search by Username:"
                           value="{{isset($filterParams['user_name'])? $filterParams['user_name'] : ''}}">
                    <input type="email" class="form-control mb-2 mr-sm-2"
                           id="inlineFormInputName2" name="email"
                           placeholder="Search by Email:"
                           value="{{isset($filterParams['email'])? $filterParams['email'] : ''}}">
                    <div class="input-group mb-2 mr-sm-2">
                        <select class="custom-select" name="user_type">
                            <option value=""
                                {{isset($filterParams['user_type']) && $filterParams['user_type'] === '' ?
                                'selected' : ''}}>
                                All User Types
                            </option>
                            @foreach(config('constances.user_types') as $userTypeIndex => $userType)
                                <option value="{{$userType}}"
                                    {{isset($filterParams['user_type']) && $filterParams['user_type'] ==
                                    $userType ? 'selected' : ''}}>
                                    {{$userTypeIndex}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" name="filter_enabled" value="true">

                    <button type="submit" class="btn btn-primary mb-2">Search</button>  &nbsp; &nbsp;
                    <a href="{{route('show_admin_dashboard')}}" class="btn btn-info mb-2">Reset Filters</a>
                </form>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive" id="results_table">
                        <table id="mytable" class="table table-bordred table-striped">
                            <thead>
                            <th>Name</th>
                            <th>Email</th>
                            <th>User Type</th>
                            <th>Remove</th>
                            </thead>
                            <tbody>
                            @if(count($users) == 0)
                                <tr>
                                    <td colspan="4"><h5 class="text-center">Sorry no relevant records found!</h5></td>
                                </tr>
                            @endif
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{array_search($user->user_type, config('constances.user_types'))}}</td>
                                <td><a class="btn btn-danger" href="/admin/remove_user/{{$user->id}}">Remove User</a></td>
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

