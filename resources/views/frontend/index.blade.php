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

            <div class="why-choose-section">
                <div class="container">
                    <div class="row justify-content-between text-center">
                        <div class="col-md-12 col-lg-12 mb-5 mb-lg-0 text-center" style="margin-top: 15px;">
                            <h2 class="mb-4 section-title">Welcome to Astara Foodstuff Trading LLC</h2>
                            <p style="font-size: 16px;margin-bottom: 28px !important;">Astara Foodstuff Trading LLC has been established in a fast dynamic developing city, Dubai, United Arab Emirates.</p>
                        </div> 
                        <div class="col-lg-12">
                            <div class="row my-5">
                                <div class="col-3 col-md-3">
                                    <div class="feature">
                                        <div class="icon">
                                            <i class="fa-solid fa-eye"></i>
                                        </div>
                                        <h3>Fast &amp; Free Shipping</h3>
                                        <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
                                    </div>
                                </div>

                                <div class="col-3 col-md-3">
                                    <div class="feature">
                                        <div class="icon">
                                            <i class="fa-solid fa-chart-line"></i>
                                        </div>
                                        <h3>Easy to Shop</h3>
                                        <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
                                    </div>
                                </div>

                                <div class="col-3 col-md-3">
                                    <div class="feature">
                                        <div class="icon">
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <h3>24/7 Support</h3>
                                        <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
                                    </div>
                                </div>

                                <div class="col-3 col-md-3">
                                    <div class="feature">
                                        <div class="icon">
                                            <i class="fa-solid fa-spinner"></i>
                                        </div>
                                        <h3>Hassle Free Returns</h3>
                                        <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
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
            
            <!-- Start All Product Section -->
            <div class="untree_co-section product-section before-footer-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 mb-5 mb-3 text-center">
                            <h2 class="mb-4 section-title">All Product</h2>
                        </div>

                        <!-- Start Product -->
                        
                        @foreach($data as $p)

                        @php 
                        $productImage = DB::table('product_image_infos')->where('product_id',$p->id)->first();
                        @endphp
                        <!-- Start Product -->
                        <div class="col-12 col-md-3 col-lg-3 mb-5">
                            <div class="product-card">
                                <!-- <div class="badge">Hot</div> -->
                                <div class="product-tumb">
                                    <a href="{{url('shop_details')}}/{{$p->id}}">
                                        <img src="{{asset('backend/img/productImage')}}/{{$productImage->image}}" alt="">
                                    </a>
                                </div>
                                <div class="product-details">
                                    <h4><a href="{{url('shop_details')}}/{{$p->id}}">@if(config('app.locale') == 'en'){{$p->product_name_en}}@elseif(config('app.locale') == 'bn'){{$p->product_name_bn}}@endif</a></h4>
                                    <div class="product-bottom-details">
                                        @if($p->discount_amount > 0)
                                        <div class="product-price"><small> ${{$p->regular_price}}</small> ${{$p->regular_price - $p->discount_amount}}</div>
                                        @else 
                                        <div class="product-price">${{$p->regular_price}}</div>
                                        @endif
                                        <div class="product-links">
                                            <a href="{{url('shop_details')}}/{{$p->id}}">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Product -->
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- End All Product Section -->

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
                                    <a href="{{url('shop_details')}}/{{$product->id}}">
                                        <img src="{{asset('backend/img/productImage')}}/{{$subImageName->image}}" alt="">
                                    </a>
                                </div>
                                <div class="product-details">
                                    <h4><a href="{{url('shop_details')}}/{{$product->id}}">@if(config('app.locale') == 'en'){{$product->product_name_en}}@elseif(config('app.locale') == 'bn'){{$product->product_name_bn}}@endif</a></h4>
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

        <!-- Start Brand Slider -->
		<div class="testimonial-section" style="background: #fff;padding: 21px;">
			<div class="container">
				<div class="row">
					<div class="col-lg-7 mx-auto text-center">
						<h2 class="section-title">Our Brands</h2>
					</div>
				</div>

				<div class="row justify-content-center">
					
                    <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider>

                        <div class="uk-slider-items uk-grid">
                            <div>
                                <div class="uk-panel">
                                    <img src="{{asset('frontend/assets/img/brand/Tamara-1.jpg')}}" width="200" height="300" alt="">
                                </div>
                            </div>
                            <div>
                                <div class="uk-panel">
                                    <img src="{{asset('frontend/assets/img/brand/El-Basha.jpg')}}" width="200" height="300" alt="">
                                </div>
                            </div>
                            <div>
                                <div class="uk-panel">
                                    <img src="{{asset('frontend/assets/img/brand/ulker.jpg')}}" width="200" height="300" alt="">
                                </div>
                            </div>
                            <div>
                                <div class="uk-panel">
                                    <img src="{{asset('frontend/assets/img/brand/sweet.jpg')}}" width="200" height="300" alt="">
                                </div>
                            </div>
                            <div>
                                <div class="uk-panel">
                                    <img src="{{asset('frontend/assets/img/brand/Mandi.jpg')}}" width="200" height="300" alt="">
                                </div>
                            </div>
                            <div>
                                <div class="uk-panel">
                                    <img src="{{asset('frontend/assets/img/brand/saka.jpg')}}" width="200" height="300" alt="">
                                </div>
                            </div>
                            <div>
                                <div class="uk-panel">
                                    <img src="{{asset('frontend/assets/img/brand/Tamara-1.jpg')}}" width="200" height="300" alt="">
                                </div>
                            </div>
                            <div>
                                <div class="uk-panel">
                                    <img src="{{asset('frontend/assets/img/brand/El-Basha.jpg')}}" width="200" height="300" alt="">
                                </div>
                            </div>
                            <div>
                                <div class="uk-panel">
                                    <img src="{{asset('frontend/assets/img/brand/ulker.jpg')}}" width="200" height="300" alt="">
                                </div>
                            </div>
                            <div>
                                <div class="uk-panel">
                                    <img src="{{asset('frontend/assets/img/brand/sweet.jpg')}}" width="200" height="300" alt="">
                                </div>
                            </div>
                            <div>
                                <div class="uk-panel">
                                    <img src="{{asset('frontend/assets/img/brand/Mandi.jpg')}}" width="200" height="300" alt="">
                                </div>
                            </div>
                            <div>
                                <div class="uk-panel">
                                    <img src="{{asset('frontend/assets/img/brand/saka.jpg')}}" width="200" height="300" alt="">
                                </div>
                            </div>
                        </div>

                        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href uk-slidenav-previous uk-slider-item="previous"></a>
                        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href uk-slidenav-next uk-slider-item="next"></a>

                    </div>
					
				</div>
			</div>
		</div>
		<!-- End Brand Slider -->
        
        <!-- Start Clients Slider -->
		<div class="testimonial-section" style="background: #fff;padding: 21px;margin-top: 77px;">
			<div class="container">
				<div class="row">
					<div class="col-lg-7 mx-auto text-center">
						<h2 class="section-title">Our Clients</h2>
					</div>
				</div>

				<div class="row justify-content-center">
					
                    <div class="uk-grid-small uk-child-width-1-4@s uk-flex-center uk-text-center" uk-grid>
                        <div>
                            <div class="uk-card uk-card-default uk-card-body">
                                <img src="{{asset('frontend/assets/img/clients/bayara.png')}}" width="100" height="200" alt="">
                            </div>
                        </div>
                        <div>
                            <div class="uk-card uk-card-default uk-card-body">
                                <img src="{{asset('frontend/assets/img/clients/Fujairah-Welfare-Association.jpg')}}" width="100" height="200" alt="">
                            </div>
                        </div>
                        <div>
                            <div class="uk-card uk-card-default uk-card-body">
                                <img src="{{asset('frontend/assets/img/clients/Sharjah-Charity-International.jpg')}}" width="100" height="200" alt="">
                            </div>
                        </div>
                        <div>
                            <div class="uk-card uk-card-default uk-card-body">
                                <img src="{{asset('frontend/assets/img/clients/union-coop.jpg')}}" width="100" height="200" alt="">
                            </div>
                        </div>
                        <div>
                            <div class="uk-card uk-card-default uk-card-body">
                                <img src="{{asset('frontend/assets/img/clients/Aswaaq.jpg')}}" width="100" height="200" alt="">
                            </div>
                        </div>
                        <div>
                            <div class="uk-card uk-card-default uk-card-body">
                                <img src="{{asset('frontend/assets/img/clients/al-ahli.png')}}" width="100" height="200" alt="">
                            </div>
                        </div>
                        <div>
                            <div class="uk-card uk-card-default uk-card-body">
                                <img src="{{asset('frontend/assets/img/clients/alnoor-logo.jpg')}}" width="100" height="200" alt="">
                            </div>
                        </div>
                    </div>
					
				</div>
			</div>
		</div>
		<!-- End Clients Slider -->

    <!-- Main Content End -->
@endsection