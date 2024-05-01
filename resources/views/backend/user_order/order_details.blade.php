@extends('backend.layouts.master')
@section('body')
<style>
    table thead tr,
    table tbody tr {
        padding: 0;
        margin: 0;
    }
</style>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <!-- Message -->
                        <!-- Success Message -->

                        <!-- Warning Message -->


                        <!-- Error Message -->


                        <!-- Info Message -->

                        <!-- Flust validation error message -->

                        <div class=" mb-3 border p-3 radius-10">
                            <div class="row order">

                                <div class="col-md-5 col-lg-5">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="information-box mb-3">
                                                <div class="table-responsive order-details">
                                                    <h5 class="h5">Customer Details</h5>
                                                    <table class="table table-bordered">
                                                        <thead class="">
                                                            <tr>
                                                                <th>Customer Name</th>
                                                                <td>{{ $order->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Email</th>
                                                                <td>{{ $order->email }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Phone</th>
                                                                <td>{{ $order->mobile_no }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Address</th>
                                                                <td>
                                                                   {{ $order->address }}
                                                                </td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-7 col-lg-7">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="information-box mb-3">
                                                <div class="table-responsive order-details">
                                                    <h5 class="h5">Product Details</h5>
                                                    <table class="table table-bordered">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>Sl.</th>
                                                                <th>Product Title</th>
                                                                <th>Unit Price</th>
                                                                <th>Quantity</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                            use Carbon\Carbon;
                                                            $count = 1;
                                                            $dateTime = Carbon::parse($order->created_at);
                                                            $timeAgo = $dateTime->diffForHumans();
                                                            $createdAt = Carbon::parse($order->created_at);
                                                            $order_date = $createdAt->format('d F Y');
                                                            @endphp
                                                            @foreach($order->order_info as $v)
                                                            <tr>
                                                                <td>{{ $count++ }}</td>
                                                                <td>
                                                                    {{ $v->product->product_name_en }}
                                                                    
                                                                    <span class="variationItem">
                                                                    @if($v->color_name != null || $v->size_name != null)
                                                                        (
                                                                        @if($v->color_name != null)
                                                                        Color-{{ $v->color_name }}
                                                                        @endif
                                                                        |
                                                                        @if($v->size_name != null)
                                                                        Size-{{ $v->size_name }}
                                                                        @endif
                                                                        )
                                                                    @endif
                                                                    </span>
                                                                   
                                                                </td>
                                                                <td>{{ $v->product->regular_price - $v->product->discount_amount }}</td>
                                                                <td>{{ $v->qty }}</td>
                                                                <td>{{ $v->product->discount_amount * $v->qty }}</td>
                                                            </tr>
                                                            @endforeach
                                                            @php
                                                                $discount_amount = $order->discount_amount ? $order->discount_amount : 0;
                                                            @endphp
                                                            <tr>
                                                                <td colspan="3"></td>
                                                                <th>Shipping</th>
                                                               
                                                                <th>{{ $order->shipping_cost }}</th>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3"></td>
                                                                <th>Total Amount</th>
                                                               
                                                                <th>{{ $order->shipping_cost + $order->total }}</th>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3"></td>
                                                                <th>Paid Amount</th>
                                                                @if($order->is_payment == 1)
                                                                <th>{{ $order->total_amount }}</th>
                                                                @else
                                                                <th>0</th>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3"></td>
                                                                <th>Due Amount</th>
                                                                @if($order->is_payment == 1)
                                                                <th>0</th>
                                                                @else
                                                                <th>{{ $order->shipping_cost + $order->total }}</th>
                                                                @endif
                                                            </tr>
                                                          
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-12 mb-3">
                                    <div class="information-box">
                                        <div class="table-responsive order-details">
                                            <h5 class="h5">Order Details</h5>
                                            <table class="table table-bordered">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Order Id</th>
                                                        <th>Transaction_id</th>
                                                        <th>Coupon Code</th>
                                                        <th>Payment Method</th>
                                                        <th>Shipping Cost</th>
                                                        <th>Order Time</th>
                                                        <th>Order Date</th>
                                                        <th>Issue Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>#{{ $order->id }}</td>
                                                        <td class="text-center">{{ $order->transaction_id ? $order->transaction_id : '-' }}</td>
                                                        <td>
                                                            <span style="text-align: center;display:block;">{{ $order->cuppon_code ? $order->cuppon_code : '-' }}</span>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <div class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>{{ $order->payment_method }}</div>
                                                        </td>
                                                        <td>
                                                            {{ $order->shipping_charge }}
                                                        </td>
                                                        <td>
                                                            {{ $timeAgo }} </td>
                                                        <td>{{ $order_date }}</td>
                                                        <td>-</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="information-box">
                                        <div class="table-responsive order-details">
                                            <h5 class="h5">Update Order Status</h5>
                                            <table class="table table-bordered">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Current Status</th>
                                                        <th style="text-align: center">
                                                            <div class="badge rounded-pill text-secondary bg-light-secondary p-2 text-uppercase px-3 pending">
                                                                <i class="bx bxs-circle me-1"></i>Pending
                                                            </div>
                                                        </th>
                                                    </tr>
                                                </thead>
                                            </table>

                                            <form id="status_form" method="post" style="padding: 0">
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                <select name="status" id="status" class="select2 mb-1">
                                                    <option value="">Select Order Status</option>
                                                    <option value="1" @if($order->status == 1) selected @endif>Pending</option>
                                                    <option value="2" @if($order->status == 2) selected @endif>Processing</option>
                                                    <option value="3" @if($order->status == 3) selected @endif>In Delivery</option>
                                                    <option value="4" @if($order->status == 4) selected @endif>Completed</option>
                                                    <option value="5" @if($order->status == 5) selected @endif>Canceled</option>
                                                </select>
                                                <input type="submit" name="status_btn" id="status_btn" value="Change Status">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<script type="text/javascript">
    $(document).on('submit','#status_form',function(e){
        e.preventDefault();
        $.ajax({
            type : 'POST',
            url : '{{ url("admin/order_list/update_status") }}',
            data : $(this).serialize(),
            success : function(response)
            {
                if(response.status == 'success')
                {
                    toastr.success(response.message)
                }
                else
                {
                    toastr.error(response.message)
                }
            }
        })
    })
</script>

@endsection