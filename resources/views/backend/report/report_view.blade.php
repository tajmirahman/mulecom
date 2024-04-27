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

        <form action="{{ route('search-by-date') }}" method="POST">
            @csrf

            <div class="col">

                <div class="card">
                    <div class="card-body">
                        <div>
                            <h5 class="card-title">Search By Date</h5>
                        </div>

                        <label class="form-label mt-2"><strong>Date:</strong></label>
                        <input type="date" name="date" class="form-control mb-5">


                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>

            </div>
        </form>


        <div class="col">
            <form action="{{ route('search-by-month') }}" method="POST">
                @csrf

                <div class="card">
                    <div class="card-body">
                        <div>
                            <h5 class="card-title">Search By Month</h5>
                        </div>

                        <label class="form-label mt-2"><strong>Month:</strong></label>
                        <select name="month" class="form-select mb-3" aria-label="Default select example">
                            <option selected="" disabled>Open this select month</option>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="Augest">Augest</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>


                        <label class="form-label mt-2"><strong>Year:</strong></label>
                        <select name="year_name" class="form-select mb-3" aria-label="Default select example">
                            <option selected="" disabled>Open this select year</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>

                        </select>


                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>

            </form>
        </div>


        <div class="col">
            <form action="{{ route('search-by-year') }}" method="POST">
                @csrf

                <div class="card">
                    <div class="card-body">
                        <div>
                            <h5 class="card-title">Search By Year</h5>
                        </div>

                        <label class="form-label mt-2"><strong>Year:</strong></label>
                        <select name="year" class="form-select mb-3" aria-label="Default select example">
                            <option selected="" disabled>Open this select year</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>

                        </select>


                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>

            </form>
        </div>
    </div>




</div>




@endsection
