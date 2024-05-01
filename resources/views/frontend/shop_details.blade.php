@extends('frontend.layouts.master')

@section('content')

    <!-- Navbar Start -->
        @include('frontend.layouts.navbar')
    <!-- Navbar End -->
    
    @if($data)
    
    <div class="untree_co-section before-footer-section">
        <div class="container">
            <div class="pd-wrap">
                <div class="container">
                    <div class="heading-section">
                        <h2>Product Details</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner border">
                                    <div class="carousel-item active text-center">
                                        <img class="" style="width: 400px;height:450px;" src="{{asset('backend/img/productImage')}}/{{$activeImage->image}}" alt="Image">
                                    </div>
                                @if($image)
                                @foreach($image as $i)
                                    <div class="carousel-item text-center">
                                        <img class="justify-content-center" style="width: 400px;height:450px" src="{{asset('backend/img/productImage')}}/{{$i->image}}" alt="Image">
                                    </div>
                                @endforeach
                                @endif
                                </div>
                                <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                                    <i class="fa fa-2x fa-angle-left text-dark"></i>
                                </a>
                                <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                                    <i class="fa fa-2x fa-angle-right text-dark"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product-dtl">
                                <div class="product-info">
                                    <div class="product-name">@if(config('app.locale') == 'en'){{$data->product_name_en}}@elseif(config('app.locale') == 'bn'){{$data->product_name_bn}}@endif</div>
                                    <!-- <div class="reviews-counter">
                                        <div class="rate">
                                            <input type="radio" id="star5" name="rate" value="5" checked />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rate" value="4" checked />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rate" value="3" checked />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rate" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rate" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                        </div>
                                        <span>3 Reviews</span>
                                    </div> -->
                                    @if($data->discount_amount > 0)
                                    <div class="product-price-discount"><span>${{$data->regular_price - $data->discount_amount}}</span><span class="line-through">${{$data->regular_price}}</span></div>
                                    @else
                                    <div class="product-price-discount">$0</div>
                                    @endif
                                </div>
                                <p>{{$data->short_details}}</p>

                                <form method="post" id="add_to_cart">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="size">Size</label>

                                            @if($size)
                                                @foreach($size as $s)
                                                    @php
                                                    $size_data = DB::table('size_settings')->where('id',$s->size_id)->first();
                                                    @endphp
                                                    <div class="custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input size_id" id="size-{{$s->size_id}}" name="size" value="{{$s->size_id}}">
                                                        <label class="custom-control-label" for="size-{{$s->size_id}}">
                                                        @if(config('app.locale') == 'en'){{$size_data->size_name_en}}
                                                        @elseif(config('app.locale') == 'bn'){{$size_data->size_name_bn}}
                                                        @endif
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @endif
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <label for="color">Color</label>
                                            @if($color)
                                            @foreach($color as $c)
                                                @php
                                                $color_data = DB::table('colors')->where('id',$c->color_id)->first();
                                                @endphp
                                                <div class="custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input" id="color-{{$c->color_id}}" name="color" value="{{$c->color_id}}">
                                                    <label class="custom-control-label" for="color-{{$c->color_id}}">
                                                        @if(config('app.locale') == 'en'){{$color_data->color_name_en}}
                                                        @elseif(config('app.locale') == 'bn'){{$color_data->color_name_bn}}
                                                        @endif
                                                    </label>
                                                </div>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-count">
                                        <label for="size">Quantity</label>
                                        <div class="product-details-quantity">
                                            <input type="hidden" name="product_id" id="product_id" value="{{$data->id}}">
                                            <input type="hidden" name="price" id="price" value="{{$data->regular_price - $data->discount_amount}}">
                                            <input type="number" id="sum" value="1" name="qty" min="1" max="10" step="1" data-decimals="0" style="padding: 4px;text-align: center; border: 1px solid #9e9797;border-radius: 10px;">
                                        </div>
                                        <button type="submit" class="round-black-btn px-3"> Add To Cart</button>
                                        <button type="button" id="AddWishList" class="round-black-btn mx-3 px-3"> Add To Wishlist</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="product-info-tabs">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews (0)</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                            {{$data->description}}
                            </div>
                            <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                <div class="review-heading">REVIEWS</div>
                                <p class="mb-20">There are no reviews yet.</p>
                                <form class="review-form">
                                    <div class="form-group">
                                        <label>Your rating</label>
                                        <div class="reviews-counter">
                                            <div class="rate">
                                                <input type="radio" id="star5" name="rate" value="5" />
                                                <label for="star5" title="text">5 stars</label>
                                                <input type="radio" id="star4" name="rate" value="4" />
                                                <label for="star4" title="text">4 stars</label>
                                                <input type="radio" id="star3" name="rate" value="3" />
                                                <label for="star3" title="text">3 stars</label>
                                                <input type="radio" id="star2" name="rate" value="2" />
                                                <label for="star2" title="text">2 stars</label>
                                                <input type="radio" id="star1" name="rate" value="1" />
                                                <label for="star1" title="text">1 star</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Your message</label>
                                        <textarea class="form-control" rows="10"></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="" class="form-control" placeholder="Name*">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="" class="form-control" placeholder="Email Id*">
                                            </div>
                                        </div>
                                    </div>
                                    <button class="round-black-btn">Submit Review</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@push('footer_scripts')
    <script>

        $('#add_to_cart').on('submit',function(e){
            e.preventDefault();
            // alert('submited');
            var datas = $(this).serialize();
            // alert(data);
            $.ajax({
                headers : {
                    'X-CSRF-TOKEN' : '{{csrf_token()}}'
                },
                url : '{{url('productCart')}}',

                type : 'POST',

                data : datas,

                success : function(data)
                {
                    // alert(data);
                    if(data == 1)
                    {
                        
                        UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Product Added To Cart'});
                        countProductCart();
                        $( "#shopping_cart" ).effect( "shake" );
                    }
                    else if(data == 2)
                    {
                        UIkit.notification({message: '<span uk-icon=\'icon: warning\'></span> দয়া করে লগিন করুন !'});
                    }
                    else if(data == 3)
                    {
                        UIkit.notification({message: '<span uk-icon=\'icon: warning\'></span>Please Select Color & Size'});
                    }
                    else
                    {
                        UIkit.notification({message: '<span uk-icon=\'icon: warning\'></span> Product Does Not Add To Cart'});
                    }
                }
            });
        });

        $('#AddWishList').on('click',function(e){
            e.preventDefault();
            var datas = $('#add_to_cart').serialize();
            // alert(data);
            $.ajax({
                headers : {
                    'X-CSRF-TOKEN' : '{{csrf_token()}}'
                },
                url : '{{url('AddWishList')}}',

                type : 'POST',

                data : datas,

                success : function(data)
                {
                    // alert(data);
                    if(data == 1)
                    {
                        
                        UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Product Added To Wish list'});
                        countProductCart();
                        $( "#shopping_cart" ).effect( "shake" );
                    }
                    else if(data == 2)
                    {
                        UIkit.notification({message: '<span uk-icon=\'icon: warning\'></span> দয়া করে লগিন করুন !'});
                    }
                    else if(data == 3)
                    {
                        UIkit.notification({message: '<span uk-icon=\'icon: warning\'></span>Please Select Color & Size'});
                    }
                    else
                    {
                        UIkit.notification({message: '<span uk-icon=\'icon: warning\'></span> Product Does Not Add To Wish List'});
                    }
                }
            });
        });


        $('#plus').click(function(){
            var number = $('#sum').val();
            var sum=parseInt(number);
            if(sum > 0){
                $('#sum').val(sum+1);
            }
        })

        $('#minus').click(function(){
            var number = $('#sum').val();
            var sum=parseInt(number);
            if(sum > 1){
                $('#sum').val(sum-1);
            }
        })
    </script>

@endpush

    @endif
    
@endsection