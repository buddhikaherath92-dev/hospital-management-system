<!doctype html>
<html lang="en">
<head>
    <title>Prescriptions</title>
</head>
<body>
    <table class="table table-bordered">
        <thead class="bg-success">
        <tr>
            <th>Diagnose</th>
            <th>Prescription</th>
        </tr>


        </thead>
        <tbody>
        @foreach($prescriptions as $prescription)
        <tr>
            <td>{{$prescription->diagnose}}</td>
            <td>{{$prescription->prescription}}</td>
        </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
