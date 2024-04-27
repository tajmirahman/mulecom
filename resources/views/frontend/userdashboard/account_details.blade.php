@extends('dashboard')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@section('user')
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Pages <span></span> Account Details
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
                                        <h5>Account Details</h5>
                                    </div>
                                    <div class="card-body">

                                        <form action="{{ route('user.profile.store') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>User Name <span class="required">*</span></label>
                                                    <input required="" class="form-control" type="text" name="username"
                                                        value="{{ $userData->username }}" />
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Full Name <span class="required">*</span></label>
                                                    <input required="" type="text" class="form-control" name="name"
                                                        value="{{ $userData->name }}" />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Email <span class="required">*</span></label>
                                                    <input name="email" type="email" required="" class="form-control"
                                                        value="{{ $userData->email }}" />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Phone <span class="required">*</span></label>
                                                    <input type="tel" name="phone" required="" class="form-control"
                                                        value="{{ $userData->phone }}" />
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label>Address <span class="required">*</span></label>
                                                    <textarea name="address" class="form-control"
                                                        rows="3">{{ $userData->address }}</textarea>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Photo</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="file" name="photo" class="form-control mb-3"
                                                            id="image" />

                                                        <img id="showImage"
                                                            src="{{ !empty($userData->photo) ? url('upload/user_image/'.$userData->photo): url('upload/no_image.jpg') }}"
                                                            alt="Admin" class="rounded-circle p-1 bg-primary "
                                                            style="width:100px">
                                                    </div>
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

<script type="text/javascript">
    $(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImage').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});


</script>
@endsection
