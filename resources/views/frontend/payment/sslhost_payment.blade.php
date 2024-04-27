@extends('frontend.master_dashboard')
@section('main')

@section('title')
SSL Host Page
@endsection


<div class="page-header breadcrumb-wrap mb-50">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> SSL HOst
        </div>
    </div>
</div>
<div class="row x">
    <div class="col-lg-6">

        <div class="border p-40 cart-totals ml-30 mb-50">
            <div class="d-flex align-items-end justify-content-between mb-30">
                <h4>Your Cart </h4>

            </div>
            <ul class="list-group mb-3">

                @foreach ($carts as $cart)

                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">{{ $cart->name }}</h6>

                    </div>
                    <span>{{ $cart->price }}/tk</span>
                </li>

                @endforeach

                <li class="list-group-item d-flex justify-content-between">
                    <h6>Total (BDT)</h6>
                    <strong>{{ $total_amount }}/tk</strong>
                </li>
            </ul>
        </div>

    </div>

    <div class="col-lg-5 ">

        <div class="border p-40 cart-totals ml-30 mb-50">
            <div class="d-flex align-items-end justify-content-between mb-30">
                <h4>Card Payment </h4>

            </div>

            <div class="table-responsive order_table checkout">

                <form action="{{ url('/pay') }}" method="POST">
                    <input type="hidden" value="{{ csrf_token() }}" name="_token" />

                    <input type="hidden" value="{{ $total_amount }}" name="amount" />

                    <input type="hidden" name="name" value="{{ $data['shipping_name'] }}">
                    <input type="hidden" name="email" value="{{ $data['shipping_email'] }}">
                    <input type="hidden" name="phone" value="{{ $data['shipping_phone'] }}">
                    <input type="hidden" name="post_code" value="{{ $data['post_code'] }}">
                    <input type="hidden" name="division_id" value="{{ $data['division_id'] }}">
                    <input type="hidden" name="district_id" value="{{ $data['district_id'] }}">
                    <input type="hidden" name="state_id" value="{{ $data['state_id'] }}">
                    <input type="hidden" name="address" value="{{ $data['shipping_address'] }}">
                    <input type="hidden" name="notes" value="{{ $data['notes'] }}">
                    <hr class="mb-4">

                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now</button>
                </form>

            </div>
        </div>
    </div>

</div>






@endsection
