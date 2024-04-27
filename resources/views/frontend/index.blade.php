@extends('frontend.master_dashboard')

@section('main')

@section('title')
Home Easy Online Shop
@endsection

@include('frontend.home.home_slider');
<!--End hero slider-->

@include('frontend.home.home_feature_category');

<!--End category slider-->

@include('frontend.home.home_bannar');
<!--End banners-->

@include('frontend.home.home_new_product');

<!--Products Tabs-->


@include('frontend.home.home_feature_product');


<!--End Best Sales-->




<!-- TV Category -->
@include('frontend.home.home_electronics_category');

<!--End TV Category -->



<!-- Tshirt Category -->
@include('frontend.home.home_fashion_category');

<!--End Tshirt Category -->





<!-- Computer Category -->

{{-- @include('frontend.home.home_computer_category'); --}}

<!--End Computer Category -->



@php
$hot_deals =
App\Models\Product::where('hot_deals',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(3)->get();
@endphp

<section class="section-padding mb-30">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp"
                data-wow-delay="0">
                <h4 class="section-title style-1 mb-30 animated animated"> Hot Deals </h4>
                <div class="product-list-small animated animated">

                    @foreach ($hot_deals as $item)

                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">

                            <a href="shop-product-right.html"><img src="{{ asset($item->product_thambnail) }}"
                                    alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="shop-product-right.html">{{ $item->product_name }}</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>

                            @php
                            $amount= $item->selling_price - $item->discount_price;
                            $total_discount= $amount / $item->selling_price * 100;
                            @endphp


                            <div class="product-price">
                                @if($item->discount_price == NULL)
                                    <div class="product-price">
                                        <span>${{ $item->selling_price }}</span>

                                    </div>
                                    @else
                                    <div class="product-price">
                                        <span>${{ $item->discount_price }}</span>
                                        <span class="old-price">${{ $item->selling_price }}</span>
                                    </div>
                                    @endif
                            </div>
                        </div>
                    </article>
                    @endforeach


                </div>
            </div>

            @php
            $speciall_offer =
            App\Models\Product::where('special_offer',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(3)->get();
            @endphp

            <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp"
                data-wow-delay=".1s">
                <h4 class="section-title style-1 mb-30 animated animated"> Special Offer </h4>
                <div class="product-list-small animated animated">

                    @foreach ($speciall_offer as $item)
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">

                            <a href="shop-product-right.html"><img src="{{ asset($item->product_thambnail) }}"
                                    alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="shop-product-right.html">{{ $item->product_name }}</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>

                            @php
                            $amount= $item->selling_price - $item->discount_price;
                            $total_discount= $amount / $item->selling_price * 100;
                            @endphp


                            <div class="product-price">
                                @if($item->discount_price == NULL)
                                    <div class="product-price">
                                        <span>${{ $item->selling_price }}</span>

                                    </div>
                                    @else
                                    <div class="product-price">
                                        <span>${{ $item->discount_price }}</span>
                                        <span class="old-price">${{ $item->selling_price }}</span>
                                    </div>
                                    @endif
                            </div>
                        </div>
                    </article>
                    @endforeach

                </div>
            </div>

            @php
            $new = App\Models\Product::where('status',1)->orderBy('id','DESC')->limit(3)->get();
            @endphp

            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp"
                data-wow-delay=".2s">
                <h4 class="section-title style-1 mb-30 animated animated">Recently added</h4>
                <div class="product-list-small animated animated">

                    @foreach ($new as $item)
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">

                            <a href="shop-product-right.html"><img src="{{ asset($item->product_thambnail) }}"
                                    alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="shop-product-right.html">{{ $item->product_name }}</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>

                            @php
                            $amount= $item->selling_price - $item->discount_price;
                            $total_discount= $amount / $item->selling_price * 100;
                            @endphp


                            <div class="product-price">
                                @if($item->discount_price == NULL)
                                    <div class="product-price">
                                        <span>${{ $item->selling_price }}</span>

                                    </div>
                                    @else
                                    <div class="product-price">
                                        <span>${{ $item->discount_price }}</span>
                                        <span class="old-price">${{ $item->selling_price }}</span>
                                    </div>
                                    @endif
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>


            @php
            $special_deals = App\Models\Product::where('special_deals',1)->orderBy('id','DESC')->limit(3)->get();
            @endphp

            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp"
                data-wow-delay=".3s">
                <h4 class="section-title style-1 mb-30 animated animated"> Special Deals </h4>
                <div class="product-list-small animated animated">

                    @foreach ($special_deals as $item)
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">

                            <a href="shop-product-right.html"><img src="{{ asset($item->product_thambnail) }}"
                                    alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="shop-product-right.html">{{ $item->product_name }}</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>

                            @php
                            $amount= $item->selling_price - $item->discount_price;
                            $total_discount= $amount / $item->selling_price * 100;
                            @endphp


                            <div class="product-price">
                                @if($item->discount_price == NULL)
                                    <div class="product-price">
                                        <span>${{ $item->selling_price }}</span>

                                    </div>
                                    @else
                                    <div class="product-price">
                                        <span>${{ $item->discount_price }}</span>
                                        <span class="old-price">${{ $item->selling_price }}</span>
                                    </div>
                                    @endif
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!--End 4 columns-->




<!--Vendor List -->

@include('frontend.home.home_vendor_list');


<!--End Vendor List -->


@endsection
