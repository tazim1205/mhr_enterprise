@extends('frontend.layouts.master')

@section('content')

    <!-- Navbar Start -->
        @include('frontend.layouts.navbar')
    <!-- Navbar End -->
    
    <!-- Start Hero Section -->
        <div class="hero">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-5">
                        <div class="intro-excerpt">
                            <h1>Cart</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- End Hero Section -->

    <div class="untree_co-section before-footer-section">
        <div class="container">
            <div class="row mb-5">
                <div class="site-blocks-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('product.product_name')</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="showcartdata">

                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-black btn-lg py-3 btn-block"><a class="text-decoration-none text-light" href="{{url('checkout')}}/{{Auth::guard('guest')->user()->id}}">Proceed To Checkout</a></button>
                </div>
            </div>
        </div>
    </div>

    @push('footer_scripts')
    <script>
        $(document).ready(function(){
            loadCartData();
        });
    </script>

    <script>



    function loadCartData()
    {
        $.ajax({
            headers : {
                'X-CSRF-TOKEN' : '{{csrf_token()}}'
            },

            url : '{{url('getCartData')}}',

            type : 'get',

            success : function(data)
            {
                $('.showcartdata').html(data);
            }
        });
    }

    </script>

<script>

function quantityUpdate(id)
{
    var quantity = $('#productQty-'+id).val();

    // alert(quantity);

    $.ajax({
        headers : {
            'X-CSRF-TOKEN' : '{{csrf_token()}}'
        },

        url : '{{url('productQtyUpdate')}}/'+id,

        type : 'GET',

        data : {quantity},

        success : function(data)
        {
            // alert(data);
            loadCartData();
        }
    });
}
</script>
<script>

function deleteProduct(id)
{
    if(confirm('Are You Sure ?'))
    {
        $.ajax({
        headers : {
            'X-CSRF-TOKEN' : '{{csrf_token()}}'
        },

        url : '{{url('deleteProduct')}}/'+id,

        type : 'GET',

        success : function(data)
        {
            // alert(data);
            loadCartData();
        }
    });
    }

}
</script>

@endpush

@endsection