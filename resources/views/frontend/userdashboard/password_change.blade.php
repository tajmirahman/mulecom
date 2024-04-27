@extends('dashboard')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@section('user')
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Pages <span></span> Password Change
        </div>
    </div>
</div>

<div class="page-content pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 m-auto">
                <div class="row">

                    <!-- // Start Col md 3 menu -->

                    @include('frontend.body.dashboard_sideber_menu')

                    <!-- // End Col md 3 menu -->

                    <div class="col-md-9">
                        <div class="tab-content account dashboard-content pl-50">
                            <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                aria-labelledby="dashboard-tab">

                                <div class="card">
                                    <div class="card-header">
                                        <h5>Change Password</h5>
                                    </div>
                                    <div class="card-body">

                                        <form action="{{ route('user.password.change') }}" method="post">
                                            @csrf

                                            <div class="row">
                                                <div class="form-group col-md-8">
                                                    <label>Old Password <span class="required">*</span></label>
                                                    <input class="form-control @error('old_password') is-invalid @enderror" type="password" name="old_password"
                                                        />
                                                    @error('old_password')
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-8">
                                                    <label>New Password <span class="required">*</span></label>
                                                    <input class="form-control @error('new_password') is-invalid @enderror" type="password" name="new_password"
                                                        />
                                                    @error('new_password')
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-8">
                                                    <label>Confirm Password <span class="required">*</span></label>
                                                    <input class="form-control" type="password" name="new_password_confirmation"
                                                        />

                                                </div>

                                                <div class="col-md-12">
                                                    <button type="submit"
                                                        class="btn btn-fill-out submit font-weight-bold" name="submit"
                                                        value="Submit">Save Change</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
