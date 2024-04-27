@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Product Stock</div>
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
                            <th>Image </th>
                            <th>Product Name </th>
                            <th>Price </th>
                            <th>QTY </th>
                            <th>Discount </th>
                            <th>Status </th>

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

                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>





</div>




@endsection
