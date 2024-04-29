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
                        <h1>Checkout</h1>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
    <!-- End Hero Section -->
    
    <div class="untree_co-section">
        <div class="container">
            <div class="row mb-5">
                <!-- <div class="col-md-12">
                    <div class="border p-4 rounded" role="alert">
                        Returning customer? <a href="#">Click here</a> to login
		            </div>
		        </div> -->
		    </div>
            <form method="post" action="{{url('submitOrder')}}">
            @csrf
                <div class="row">
                    <div class="col-md-6 mb-5 mb-md-0">
                        <h2 class="h3 mb-3 text-black">Billing Details</h2>
                        <div class="p-3 p-lg-5 border bg-white">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="name" class="text-black">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="text-black">Email Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="email" name="email">
                                </div>
                                <div class="col-md-6">
                                    <label for="mobile_no" class="text-black">Mobile No <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Phone Number">
                                </div>
                                <div class="col-md-6">
                                    <label for="division_id" class="text-black">Division</label><span class="text-danger">*</span></label>
                                    <select class="form-control" name="division_id" id="division_id" onchange="return loadDistrict()">
                                        <option value="">Select One</option>
                                        @if($division)
                                        @foreach($division as $d)
                                        <option value="{{$d->id}}">{{$d->division_name}}</opiton>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="district_id" class="text-black">District</label><span class="text-danger">*</span></label>
                                    <select class="form-control" name="district_id" id="district_id" onchange="loadUpazila();shipingCostUpdate();">
                                        <option value="">Select One</option>
                                    
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="upazila_id" class="text-black">Upazila</label><span class="text-danger">*</span></label>
                                    <select class="form-control" name="upazila_id" id="upazila_id" >
                                        <option value="">Select One</option>
                                    
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="address" class="text-black">Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Street address">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="notes" class="text-black">Special Notes</label>
                                <textarea name="notes" id="notes" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <h2 class="h3 mb-3 text-black">Your Order</h2>
                                <div class="p-3 p-lg-5 border bg-white">
                                    <div class="card-body">
                                        <h5 class="font-weight-medium mb-3 text-dark">Products</h5>
                                        <table class="table table-bordered" id="checkoutData">
                                            

                                        </table>

                                        <hr class="mt-0">
                                    </div>
                                    <div class="card border-secondary mb-5">
                                        <div class="card-header bg-secondary border-0">
                                            <h4 class="font-weight-semi-bold m-0">Payment</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="payment_method" id="paypal" value="cash">
                                                    <label class="custom-control-label" for="paypal">Cash</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold">Place Order</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    @push('footer_scripts')

    <script>

    function loadCheckoutData()
    {
        var guest_id = $('#guest_id').val();
        $.ajax({
            'headers' : {
                'X-CSRF-TOKEN' : '{{csrf_token()}}'
            },

            url : '{{url('loadCheckoutData')}}',

            type : 'GET',

            success : function(data)
            {
                $('#checkoutData').html(data);
            }
        })
    }

    loadCheckoutData();

    function loadDistrict()
    {
        var division_id = $('#division_id').val();

        // alert(division_id);

        $.ajax({
            headers : {
                'X-CSRF-TOKEN' : '{{csrf_token()}}'
            },

            url : '{{url('loadDistrict')}}',

            type : 'POST',

            data : {division_id},

            success : function(data)
            {
                $('#district_id').html(data);
            }
        });
    }

    function loadUpazila()
    {
        var district_id = $('#district_id').val();

        // alert(district_id);

        // alert(division_id);

        $.ajax({
            headers : {
                'X-CSRF-TOKEN' : '{{csrf_token()}}'
            },

            url : '{{url('loadUpazila')}}',

            type : 'POST',

            data : {district_id},

            success : function(data)
            {
                // alert(data);
                $('#upazila_id').html(data);
            }
        });
    }
    function shipingCostUpdate()
    {
        var district_id = $('#district_id').val();

        // alert(division_id);

        $.ajax({
            headers : {
                'X-CSRF-TOKEN' : '{{csrf_token()}}'
            },

            url : '{{url('shipingCostUpdate')}}',

            type : 'POST',

            data : {district_id},

            success : function(data)
            {
                loadCheckoutData();
            }
        });
    }


    function MatchCuppon()
    {
        var cuppon_code = $('#cuppon_code').val();

        // alert(cuppon_code);

        $.ajax({
            headers : {
                'X-CSRF-TOKEN' : '{{csrf_token()}}'
            },

            url : '{{url('updateCupponAmount')}}',

            type : 'POST',

            data : {cuppon_code},

            success : function(data)
            {
                if(data != 1)
                {
                    alert('Cuppon Does Not Matched');
                }
                loadCheckoutData();
            }
        })
    }

    </script>

    @endpush

@endsection