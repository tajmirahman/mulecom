@extends('vendor.vendor_dashboard')

@section('vendor')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Product</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Product</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('vendor.add.product') }}" class="btn btn-primary">Add Product</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Total Product <span class="badge bg-danger">{{ count($products) }}</span></h6>

    <hr />


    <div class="card">

        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Image </th>
                            <th>Product Name </th>
                            <th>Price </th>
                            <th>QTY </th>
                            <th>Discount </th>
                            <th>Status </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $key => $item)
                        <tr>
                            <td> {{ $key+1 }} </td>
                            <td> <img src="{{ asset($item->product_thambnail) }}" style="width: 70px; height:40px;">
                            </td>
                            <td> {{ $item->product_name }} </td>
                            <td> {{ $item->selling_price }} </td>
                            <td> {{ $item->product_qty }} </td>
                            <td>
                                @if($item->discount_price == NULL)
                                <span class="badge bg-danger">No Discount</span>
                                @else
                                @php
                                $amount=$item->selling_price - $item->discount_price;
                                $discount=($amount / $item->selling_price) * 100;
                                @endphp
                                <span class="badge bg-info">{{ round($discount) }}%</span>
                                @endif
                            </td>
                            <td>
                                @if($item->status == '1')
                                <span class="badge bg-info">Acitve</span>
                                @else
                                <span class="badge bg-danger">InAcitve</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('vendor.edit.product',$item->id) }}" class="btn btn-info" title="Edit"><i
                                        class="fa fa-pencil"></i></a>

                                <a href="{{ route('vendor.delete.product',$item->id) }}" class="btn btn-danger" id="delete"
                                    title="delete"><i class="fa fa-trash"></i></a>

                                <a href="{{ route('edit.category',$item->id) }}" class="btn btn-warning"
                                    title="Details"><i class="fa fa-eye"></i></a>

                                @if($item->status == '1')

                                <a href="{{ route('vendor.product.inactive',$item->id) }}" class="btn btn-secondary"
                                    title="inactive"><i class="fa-solid fa-thumbs-down"></i></a>
                                @else
                                <a href="{{ route('vendor.product.active',$item->id) }}" class="btn btn-secondary"
                                    title="active"><i class="fa-solid fa-thumbs-up"></i></a>
                                @endif

                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Image </th>
                            <th>Product Name </th>
                            <th>Price </th>
                            <th>QTY </th>
                            <th>Discount </th>
                            <th>Status </th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>





</div>




@endsection
