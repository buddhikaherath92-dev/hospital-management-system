@extends('patient.pages.dashboard_main')
@section('child-content')
<h4>Organs</h4>
<br>
<table class="table table-hover">
    <thead class="thead-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
    </tr>
    <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
    </tr>
    <tr>
        <th scope="row">3</th>
        <td colspan="2">Larry the Bird</td>
        <td>@twitter</td>
    </tr>
    </tbody>
</table>
<br>
<h4>Donate an Organ</h4>
<br>
<form action="" class="">
    <div class="form-row">
        <div class="form-group col-md-5">
            <label>Organ Name</label>
            <input type="text" class="form-control" name="organ_name" value="{{ old('organ_name') }}">
        </div>
        <div class="form-group col-md-4">
            <label>District</label>
            <input type="text" class="form-control" name="district" value="{{ old('district') }}">
        </div>
    </div>
    <button class="btn btn-success">Donate</button>
</form>
@endsection