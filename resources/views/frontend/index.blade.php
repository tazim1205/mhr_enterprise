@extends('frontend.layouts.master')

@section('content')
    <!-- Navbar Start -->

        @include('frontend.layouts.navbar')

    <!-- Navbar End -->
    @php

    use App\Models\slider;

    $slider = slider::where("slider",1)->orderBy('id','DESC')->get();

    @endphp
    <!-- Main Content Start -->

        <!-- Start Hero Section -->
                <div class="hero">
                    <div class="container">
                        <div class="row justify-content-between">
                            <div class="col-lg-12">
                                <div class="uk-position-relative uk-visible-toggle" tabindex="-1" uk-slideshow="min-height: 300; max-height: 400; animation: push">
                                    <div class="uk-slideshow-items">
                                        @if(isset($slider))
                                        @foreach($slider as $key => $s)
                                        <div>
                                            <img src="{{asset('/Backend/img/slider')}}/{{$s->image}}" class="w-60 h-60" alt="" uk-cover>
                                            {{--<div class="uk-overlay uk-overlay-primary uk-position-bottom uk-text-center">
                                                <h3 class="uk-margin-remove">@if(config('app.locale') == 'en'){{$s->title}}@elseif(config('app.locale') == 'bn'){{$s->title_bn}}@endif</h3>
                                                <p class="uk-margin-remove"><a href="" class="btn btn-secondary me-2">Shop Now</a><a href="#" class="btn btn-white-outline">Explore</a></p>
                                            </div>--}}
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>

                                    <div class="uk-light">
                                        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href uk-slidenav-previous uk-slideshow-item="previous"></a>
                                        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href uk-slidenav-next uk-slideshow-item="next"></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- End Hero Section -->
            
            <!-- Start Category Wise Product Section -->
            <div class="untree_co-section product-section before-footer-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 mb-5 mb-3 text-center">
                            <h2 class="mb-4 section-title">Category</h2>
                        </div>
                        @if($categorie)
                        @foreach($categorie as $c)

                        @php 
                        $total_product = DB::table('products')->where('cat_id',$c->id)->count();

                        
                        @endphp

                        @if($total_product > 0)

                        @php 
                        $product = DB::table('products')->where('cat_id',$c->id)->orderby('products.id','DESC')->first();

                        $imageName = DB::table('product_image_infos')->where('product_id',$product->id)->first();
                        @endphp
                        <div class="col-12 col-md-3 col-lg-3 mb-5">
                            <div class="product-card">
                                <div class="badge">{{$total_product}} Products</div>
                                <div class="product-tumb">
                                    <a href="{{url('categorie_product')}}/{{$c->id}}">
                                        <img src="{{asset('backend/img/productImage')}}/{{$imageName->image}}" alt="">
                                    </a>
                                </div>
                                <div class="product-details">
                                    <h4><a href="{{url('categorie_product')}}/{{$c->id}}">@if(config('app.locale') == 'en'){{$c->cat_name_en}}@elseif(config('app.locale') == 'bn'){{$c->cat_name_bn}}@endif</a></h4>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <!-- End Category Wise Product Section -->

            <!-- Start Product Section -->
            @php

            @endphp
            @if($add_trend_product)
            @foreach($add_trend_product as $tnd)

            @php
            
            $total_product = DB::table('trend_product_infos')->where('trend_id',$tnd->trend_id)->where('cat_id',$tnd->cat_id)->get();

            $trend_name = DB::table('trends')->where('id',$tnd->trend_id)->first();

            @endphp
            <div class="untree_co-section product-section before-footer-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 mb-5 mb-3 text-center">
                            <h2 class="mb-4 section-title">{{$trend_name->trend_name_en}}</h2>
                        </div>

                        <!-- Start Product -->
                        @foreach($total_product as $t)

                        @php 
                        $product = DB::table('products')->where('id',$t->product_id)->orderby('products.id','DESC')->first();

                        $subImageName = DB::table('product_image_infos')->where('product_id',$t->product_id)->first();
                        @endphp
                        <div class="col-12 col-md-3 col-lg-3 mb-5">
                            <div class="product-card">
                                <div class="product-tumb">
                                    <img src="{{asset('backend/img/productImage')}}/{{$subImageName->image}}" alt="">
                                </div>
                                <div class="product-details">
                                    <h4><a href="#">@if(config('app.locale') == 'en'){{$product->product_name_en}}@elseif(config('app.locale') == 'bn'){{$product->product_name_bn}}@endif</a></h4>
                                    <div class="product-bottom-details">
                                        @if($product->discount_amount > 0)
                                        <div class="product-price"><small> ${{$product->regular_price}}</small> ${{$product->regular_price - $product->discount_amount}}</div>
                                        @else 
                                        <div class="product-price">${{$product->regular_price}}</div>
                                        @endif
                                        <div class="product-links">
                                            <a href="{{url('shop_details')}}/{{$product->id}}">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- End Product -->
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        <!-- End Product Section -->

    <!-- Main Content End -->
@endsection