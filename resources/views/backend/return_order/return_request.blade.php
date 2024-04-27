@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Pending Order</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Pending Order</li>
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
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Date </th>
                            <th>Invoice </th>
                            <th>Amount </th>
                            <th>Payment </th>
                            <th>Reason </th>
                            <th>State </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $key => $item)
                        <tr>
                            <td> {{ $key+1 }} </td>
                            <td>{{ $item->order_date }}</td>
                            <td>{{ $item->invoice_no }}</td>
                            <td>${{ $item->amount }}</td>
                            <td>{{ $item->payment_method }}</td>
                            <td>{{ $item->return_reason }}</td>
                            <td>
                                @if($item->return_order == 1)
                                <span class="badge rounded-pill bg-success"> Pending</span></td>
                                @elseif($item->return_order == 2)
                                <span class="badge rounded-pill bg-success"> Success</span></td>
                                @endif

                            <td>
                                <a href="{{ route('admin.order.details',$item->id) }}" class="btn btn-info"
                                    title="Details"><i class="fa fa-eye"></i> </a>

                                <a href="{{ route('return.request.success',$item->id) }}" class="btn btn-info"
                                    title="update" id="success"><i class="fa-solid fa-thumbs-up"></i> </a>


                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                    <tfoot>
                        <tr>
                            <tr>
                                <th>Sl</th>
                                <th>Date </th>
                                <th>Invoice </th>
                                <th>Amount </th>
                                <th>Payment </th>
                                <th>Reason </th>
                                <th>State </th>
                                <th>Action</th>
                            </tr>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>



</div>




@endsection
