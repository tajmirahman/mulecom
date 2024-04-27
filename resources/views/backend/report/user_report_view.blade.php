@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Report View</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Report View</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">

            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <hr />


    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 row-cols-xl-3">

        <div class="col">
            <form action="{{ route('user-by-report') }}" method="POST">
                @csrf

                <div class="card">
                    <div class="card-body">
                        <div>
                            <h5 class="card-title">Search By User</h5>
                        </div>

                        <label class="form-label mt-2"><strong>User:</strong></label>
                        <select name="user" class="form-select mb-3" aria-label="Default select example">
                            <option selected="" disabled>Open this select User</option>

                            @foreach ($orders as $order)

                            <option value="{{ $order->id }}">{{ $order->name }}</option>

                            @endforeach


                        </select>


                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>

            </form>
        </div>
    </div>




</div>




@endsection
