@extends('frontend.layouts.master')

@section('content')

@include('frontend.layouts.navbar')


<!-- Start Hero Section -->
<input type="hidden" id="cat_id" name="cat_id" value="{{$categories->id}}">
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-12">
                <div class="intro-excerpt">
                    <h1>@if(config('app.locale') == 'en'){{$categories->cat_name_en}}@elseif(config('app.locale') == 'bn'){{$categories->cat_name_bn}}@endif</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<!-- Product Area Start -->

<div class="untree_co-section product-section before-footer-section">
    <div class="container">
        <div class="row">
        
            @if($total_products > 0)
            @foreach($products as $p)

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
            @else 
            
                <div class="col-12 text-center">
                <h1>No Product Found</h1>
                </div>
            
            @endif

        </div>
    </div>
</div>

<!-- Product Area End -->
    


@endsection