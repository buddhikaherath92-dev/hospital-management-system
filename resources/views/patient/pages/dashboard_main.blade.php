@extends('patient.layouts.main')

@section('content')
    <br>
    <div class="container">
        <h3 class="display-4 text-center">Patient Dashboard</h3>
    </div>
    <div class="row" style="margin: 0">
        <div class="col-auto"></div>
        <div class="col-xl-2">
            <div class="col-12">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action {{ Route::currentRouteName()  == 'show_patient_myprofile' ? 'active' : '' }}"  href="{{ route('show_patient_myprofile') }}" >My Profile</a>
                    <a class="list-group-item list-group-item-action {{ Route::currentRouteName()  == 'show_patient_medical_history' ? 'active' : '' }}" href="{{ route('show_patient_medical_history') }}">Medical History</a>
                    <a class="list-group-item list-group-item-action {{ Route::currentRouteName()  == 'show_donation' ? 'active' : '' }}" href="{{ route('show_donation') }}" >Organ Donation/Request</a>
                    <a class="list-group-item list-group-item-action {{ Route::currentRouteName()  == 'show_settings' ? 'active' : '' }}" href="{{ route('show_settings') }}">Settings</a>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                        <div class="container shadow p-5">
                            @yield('child-content')
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
