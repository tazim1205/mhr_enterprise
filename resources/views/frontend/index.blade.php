@extends('frontend.layouts.master')

@section('content')
    <!-- Navbar Start -->

        @include('frontend.layouts.navbar')

    <!-- Navbar End -->
    
    <!-- Main Content Start -->

        <!-- Start Hero Section -->
                <div class="hero">
                    <div class="container">
                        <div class="row justify-content-between">
                            <div class="col-lg-5">
                                <div class="intro-excerpt">
                                    <h1>Celebrate <span clsas="d-block">Your Uniqueness</span></h1>
                                    <p class="mb-4">The e-commerce platform that you can trust. It is more than just sales</p>
                                    <p><a href="" class="btn btn-secondary me-2">Shop Now</a><a href="#" class="btn btn-white-outline">Explore</a></p>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="hero-img-wrap">
                                    <img src="{{ asset('') }}frontend/assets/img/images/couch.png" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- End Hero Section -->

            <!-- Start Why Choose Us Section -->
            <div class="why-choose-section">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-lg-6">
                            <h2 class="section-title">Why Choose Us</h2>
                            <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.</p>

                            <div class="row my-5">
                                <div class="col-6 col-md-6">
                                    <div class="feature">
                                        <div class="icon">
                                            <img src="{{ asset('') }}frontend/assets/img/images/truck.svg" alt="Image" class="imf-fluid">
                                        </div>
                                        <h3>Fast &amp; Free Shipping</h3>
                                        <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
                                    </div>
                                </div>

                                <div class="col-6 col-md-6">
                                    <div class="feature">
                                        <div class="icon">
                                            <img src="{{ asset('') }}frontend/assets/img/images/bag.svg" alt="Image" class="imf-fluid">
                                        </div>
                                        <h3>Easy to Shop</h3>
                                        <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
                                    </div>
                                </div>

                                <div class="col-6 col-md-6">
                                    <div class="feature">
                                        <div class="icon">
                                            <img src="{{ asset('') }}frontend/assets/img/images/support.svg" alt="Image" class="imf-fluid">
                                        </div>
                                        <h3>24/7 Support</h3>
                                        <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
                                    </div>
                                </div>

                                <div class="col-6 col-md-6">
                                    <div class="feature">
                                        <div class="icon">
                                            <img src="{{ asset('') }}frontend/assets/img/images/return.svg" alt="Image" class="imf-fluid">
                                        </div>
                                        <h3>Hassle Free Returns</h3>
                                        <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="img-wrap">
                                <img src="{{ asset('') }}frontend/assets/img/images/why-choose-us-img.jpg" alt="Image" class="img-fluid">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End Why Choose Us Section -->

            <!-- Start Category Wise Product Section -->
            <div class="untree_co-section product-section before-footer-section">
                <div class="container">
                    <div class="row">
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
            <div class="untree_co-section product-section before-footer-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 mb-5 mb-3 text-center">
                            <h2 class="mb-4 section-title">TOP NEW ARRIVAL</h2>
                            <p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. </p>
                        </div>

                        <!-- Start Product -->
                        <div class="col-12 col-md-3 col-lg-3 mb-5">
                            <div class="product-card">
                                <div class="badge">Hot</div>
                                <div class="product-tumb">
                                    <img src="{{ asset('') }}frontend/assets/img/images/product-1.png" alt="">
                                </div>
                                <div class="product-details">
                                    <h4><a href="{{url('/single_product')}}">Dental Doctor Tooth Brash</a></h4>
                                    <div class="product-bottom-details">
                                        <div class="product-price"><small>$96.00</small>$230.99</div>
                                        <div class="product-links">
                                            <a href="">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Product -->
                    </div>
                </div>
            </div>
            <!-- End Product Section -->

            <!-- Start Popular Product Section -->
            <div class="untree_co-section product-section before-footer-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 mb-5 mb-3 text-center">
                            <h2 class="mb-4 section-title">Suggest For You</h2>
                            <p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. </p>
                        </div>

                        <!-- Start Product -->
                        <div class="col-12 col-md-3 col-lg-3 mb-5">
                            <div class="product-card">
                                <div class="badge">Hot</div>
                                <div class="product-tumb">
                                    <img src="{{ asset('') }}frontend/assets/img/images/product-1.png" alt="">
                                </div>
                                <div class="product-details">
                                    <h4><a href="{{url('/single_product')}}">Dental Doctor Tooth Brash</a></h4>
                                    <div class="product-bottom-details">
                                        <div class="product-price"><small>$96.00</small>$230.99</div>
                                        <div class="product-links">
                                            <a href="">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 col-lg-3 mb-5">
                            <div class="product-card">
                                <div class="badge">Hot</div>
                                <div class="product-tumb">
                                    <img src="{{ asset('') }}frontend/assets/img/images/product-2.png" alt="">
                                </div>
                                <div class="product-details">
                                    <h4><a href="{{url('/single_product')}}">Dental Doctor Tooth Brash</a></h4>
                                    <div class="product-bottom-details">
                                        <div class="product-price"><small>$96.00</small>$230.99</div>
                                        <div class="product-links">
                                            <a href="">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 col-lg-3 mb-5">
                            <div class="product-card">
                                <div class="badge">Hot</div>
                                <div class="product-tumb">
                                    <img src="{{ asset('') }}frontend/assets/img/images/product-3.png" alt="">
                                </div>
                                <div class="product-details">
                                    <h4><a href="{{url('/single_product')}}">Dental Doctor Tooth Brash</a></h4>
                                    <div class="product-bottom-details">
                                        <div class="product-price"><small>$96.00</small>$230.99</div>
                                        <div class="product-links">
                                            <a href="">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 col-lg-3 mb-5">
                            <div class="product-card">
                                <div class="badge">Hot</div>
                                <div class="product-tumb">
                                    <img src="{{ asset('') }}frontend/assets/img/images/product-3.png" alt="">
                                </div>
                                <div class="product-details">
                                    <h4><a href="{{url('/single_product')}}">Dental Doctor Tooth Brash</a></h4>
                                    <div class="product-bottom-details">
                                        <div class="product-price"><small>$96.00</small>$230.99</div>
                                        <div class="product-links">
                                            <a href="">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Product -->
                    </div>
                </div>
            </div>
            <!-- End Popular Product Section -->

            <!-- Start Testimonial Slider -->
            {{--<div class="testimonial-section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 mx-auto text-center">
                            <h2 class="section-title">Testimonials</h2>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="testimonial-slider-wrap text-center">

                                <div id="testimonial-nav">
                                    <span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
                                    <span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
                                </div>

                                <div class="testimonial-slider">
                                    
                                    <div class="item">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-8 mx-auto">

                                                <div class="testimonial-block text-center">
                                                    <blockquote class="mb-5">
                                                        <p>&ldquo;Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer convallis volutpat dui quis scelerisque.&rdquo;</p>
                                                    </blockquote>

                                                    <div class="author-info">
                                                        <div class="author-pic">
                                                            <img src="{{ asset('') }}frontend/assets/img/images/person-1.png" alt="Maria Jones" class="img-fluid">
                                                        </div>
                                                        <h3 class="font-weight-bold">Maria Jones</h3>
                                                        <span class="position d-block mb-3">CEO, Co-Founder, XYZ Inc.</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div> 
                                    <!-- END item -->

                                    <div class="item">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-8 mx-auto">

                                                <div class="testimonial-block text-center">
                                                    <blockquote class="mb-5">
                                                        <p>&ldquo;Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer convallis volutpat dui quis scelerisque.&rdquo;</p>
                                                    </blockquote>

                                                    <div class="author-info">
                                                        <div class="author-pic">
                                                            <img src="{{ asset('') }}frontend/assets/img/images/person-1.png" alt="Maria Jones" class="img-fluid">
                                                        </div>
                                                        <h3 class="font-weight-bold">Maria Jones</h3>
                                                        <span class="position d-block mb-3">CEO, Co-Founder, XYZ Inc.</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div> 
                                    <!-- END item -->

                                    <div class="item">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-8 mx-auto">

                                                <div class="testimonial-block text-center">
                                                    <blockquote class="mb-5">
                                                        <p>&ldquo;Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer convallis volutpat dui quis scelerisque.&rdquo;</p>
                                                    </blockquote>

                                                    <div class="author-info">
                                                        <div class="author-pic">
                                                            <img src="{{ asset('') }}frontend/assets/img/images/person-1.png" alt="Maria Jones" class="img-fluid">
                                                        </div>
                                                        <h3 class="font-weight-bold">Maria Jones</h3>
                                                        <span class="position d-block mb-3">CEO, Co-Founder, XYZ Inc.</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div> 
                                    <!-- END item -->

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Testimonial Slider -->

            <!-- Start Blog Section -->
            <div class="blog-section">
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <h2 class="section-title">Recent Blog</h2>
                        </div>
                        <div class="col-md-6 text-start text-md-end">
                            <a href="#" class="more">View All Posts</a>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-12 col-sm-6 col-md-4 mb-4">
                            <div class="post-entry">
                                <a href="#" class="post-thumbnail"><img src="{{ asset('') }}frontend/assets/img/images/post-1.jpg" alt="Image" class="img-fluid"></a>
                                <div class="post-content-entry">
                                    <h3><a href="#">First Time Home Owner Ideas</a></h3>
                                    <div class="meta">
                                        <span>by <a href="#">Kristin Watson</a></span> <span>on <a href="#">Dec 19, 2021</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4 mb-4">
                            <div class="post-entry">
                                <a href="#" class="post-thumbnail"><img src="{{ asset('') }}frontend/assets/img/images/post-2.jpg" alt="Image" class="img-fluid"></a>
                                <div class="post-content-entry">
                                    <h3><a href="#">How To Keep Your Furniture Clean</a></h3>
                                    <div class="meta">
                                        <span>by <a href="#">Robert Fox</a></span> <span>on <a href="#">Dec 15, 2021</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4 mb-4">
                            <div class="post-entry">
                                <a href="#" class="post-thumbnail"><img src="{{ asset('') }}frontend/assets/img/images/post-3.jpg" alt="Image" class="img-fluid"></a>
                                <div class="post-content-entry">
                                    <h3><a href="#">Small Space Furniture Apartment Ideas</a></h3>
                                    <div class="meta">
                                        <span>by <a href="#">Kristin Watson</a></span> <span>on <a href="#">Dec 12, 2021</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>--}}
        <!-- End Blog Section -->	

    <!-- Main Content End -->
@endsection