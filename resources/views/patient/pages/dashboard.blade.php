@extends('patient.layouts.main')

@section('content')
    <br>
    <div class="container">
        <h3 class="display-4 text-center">Patient Dashboard</h3>
    </div>
    <div class="row">
        <div class="col-xl-1"></div>
        <div class="col-xl-2">
            <div class="col-12">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">My Profile</a>
                    <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Medical History</a>
                    <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Organ Donation/Request</a>
                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Settings</a>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="col-8">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                        <div class="container shadow p-5">
                            <form action="{{ route('save_patient_details') }}" method="post">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" class="form-control" name="full_name" value="{{ old('full_name') }}">
                                    @if ($errors->has('full_name'))
                                        <span class="invalid-feedback" style="display: block">
                                            <small>{{ $errors->first('full_name') }}</small>
                                        </span>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">...</div>
                    <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>
                    <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">...</div>
                </div>
            </div>
        </div>
    </div>
@endsection
