<!doctype html>
<html lang="en">
<head>
    <title>Prescriptions</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css">
        .main_wrapper{
            background: #C2D0BE;
            padding: 10px;
            width: 100%;
        }
        .footer{
            background: #8E988B;  /* fallback for old browsers */
            padding: 2px;
            border: 1px #353934 solid;
            border-radius: 5px;
            margin-top: 10px;
        }
        .pdf_heading{
            background: #8E988B;  /* fallback for old browsers */
            padding: 5px;
            border: 1px #353934 solid;
            border-radius: 5px;
        }
        .pdf_content{
            background: #B1BEAD;  /* fallback for old browsers */
            padding: 5px;
            border: 1px #353934 solid;
            margin-top:10px
        }
        h2{
            text-align: center;
            color: whitesmoke;
        }
        h4{
            text-align: center;
            color: whitesmoke;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
    </style>
</head>
<body>

<div class="main_wrapper">
    <div class="pdf_heading">
        <h2>Hospital Management System</h2>
    </div>
    <div class="pdf_content">
        <table width="100%">
            <tr>
                <th width="30%">Prescription ID :</th>
                <td colspan="3">{{'#'.$prescription->prescription_id}}</td>
            </tr>
            <tr>
                <th width="30%">Date :</th>
                <td colspan="3">{{Carbon\Carbon::parse($prescription->prescribed_date)->toFormattedDateString()}}</td>
            </tr>
            <tr>
                <th width="30%">Patient Name : </th>
                <td colspan="3">{{$prescription->patient_name}}</td>
            </tr>
            <tr>
                <th width="30%">Patient Age : </th>
                <td colspan="3">{{Carbon\Carbon::parse($prescription->patient_dob)->age.' Years'}}</td>
            </tr>
            <tr>
                <th width="30%">Doctor : </th>
                <td colspan="3">{{'Dr. '.$prescription->doctor_name}}</td>
            </tr>
            <tr>
                <th width="30%">Diagnosis : </th>
                <td colspan="3">
                    {{$prescription->diagnose}}
                </td>
            </tr>
            <tr>
                <th width="30%">Prescription : </th>
                <td colspan="3">
                    {{$prescription->prescription}}
                </td>
            </tr>
            <tr>
               <th width="30%">Diagnose Values :</th>
                <td>{{$diagnoseValues->hba1c !== null ?  'HbA1C : '.$diagnoseValues->hba1c : 'N / A'}}</td>
                <td>{{$diagnoseValues->cholesterol !== null ?  'Cholesterol : '.$diagnoseValues->cholesterol : 'N / A'}}</td>
                <td>{{$diagnoseValues->bp !== null ?  'BP : '.$diagnoseValues->bp : 'N / A'}}</td>
            </tr>
        </table>
    </div>
    <div class="footer">
        <h4>Prescription generated with Hospital Management System</h4>
    </div>
</div>

</body>
</html>
