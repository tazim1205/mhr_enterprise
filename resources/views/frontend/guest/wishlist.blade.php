@extends('frontend.layouts.master')

@section('content')

@include('frontend.layouts.navbar')

<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-12">
                <div class="intro-excerpt">
                    <h1>@lang('common.wishlist')</h1>
                </div>
                <div class="d-inline-flex">
                    <h5 class="m-0"><a href="{{url('/')}}" style="text-decoration: none;color: #ffc72c;">Home</a></h5>
                    <h5 class="m-0 px-2">-</h5>
                    <h5 class="m-0" style="color: #fff;">@lang('common.wishlist')</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->


    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-12 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>@lang('product.product_name')</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="showWishList">

                    </tbody>
                </table>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="col-lg-4">
                    <button class="btn btn-block btn-primary my-3 py-3"><a class="text-decoration-none text-light" href="{{url('wishListToCart')}}/{{Auth::guard('guest')->user()->id}}">Add To Cart</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

<script>
    $(document).ready(function(){
        loadWishList();
    });
</script>

<script>

    function loadWishList()
    {
        $.ajax({
            headers : {
                'X-CSRF-TOKEN' : '{{csrf_token()}}'
            },

            url : '{{url('getWishList')}}',

            type : 'get',

            success : function(data)
            {
                $('.showWishList').html(data);
            }
        });
    }

</script>


<script>

function WishListDelete(id)
{
    if(confirm('Are You Sure ?'))
    {
        $.ajax({
        headers : {
            'X-CSRF-TOKEN' : '{{csrf_token()}}'
        },

        url : '{{url('WishListDelete')}}/'+id,

        type : 'GET',

        success : function(data)
        {
            
            loadWishList();
        }
    });
    }

}
</script>

@endsection
