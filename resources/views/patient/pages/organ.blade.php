@extends('patient.pages.dashboard_main')
@section('child-content')
<h4>Organs</h4>
<br>
<table class="table table-hover">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Donation/Request ID</th>
        <th scope="col">Organ Name</th>
        <th scope="col">Description</th>
        <th scope="col">Type</th>
        <th scope="col">Posted Date</th>
    </tr>
    </thead>
    <tbody>
    @foreach($donations as $donation)
    <tr>
        <th scope="row">{{ $donation['id'] }}</th>
        <td>{{ $donation['organ_name'] }}</td>
        <td>{{ $donation['description'] }}</td>
        <td>{{ $donation['type'] }}</td>
        <td>{{ $donation['posted_date'] }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
<br>
<hr>
<br>
<div class="container">
    <div class="card w-100">
        <div class="card-body">
            <h3 class="card-title">Organ Donations/Requests</h3>
            <hr>
            <form action="{{ route('store_donation') }}" method="post">
                {{ csrf_field() }}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="form-row">
                    <div class="col-8">
                        <label>Organ Name :</label>
                        <input type="text" class="form-control" name="organ_name">
                    </div>
                    <div class="col-4">
                        <label>Type :</label>
                        <select type="text" class="form-control" name="type">
                            <option value="Request">Request</option>
                            <option value="Donate">Donate</option>
                        </select>
                    </div>
                </div>
                <br>
                <label>Description :</label>
                <textarea name="description" class="form-control"></textarea>
                <br>
                <div class="float-right">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
