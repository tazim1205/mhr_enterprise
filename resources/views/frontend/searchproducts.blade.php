@extends('frontend.layouts.master')

@section('content')

@include('frontend.layouts.navbar')

<div class="untree_co-section product-section before-footer-section">
  <div class="container">
    <div class="row">
      @if(count($searchproducts)>0)
      <!-- Start Product -->
      <div class="col-12 col-md-3 col-lg-3 mb-5">
        <div class="product-card">
          @if(isset($searchproducts))
          @foreach($searchproducts as $p)
          @php 
           $symbols=array(' ','!','"','#','$','%','&','\'','(',')','*','+',',','-','.','/',':',';','<','>','=','?','@','[',']','\\','^','_','{','}','|','~','`','”','″');
          $productname=str_replace($symbols,"-",$p->custom_url);
          $offercheck = DB::table('products')->where('product_id',$p->product_id)->first();
          @endphp
          <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 mt-4">
            @if(isset($offercheck))
            <div class="overlay2 p-2">
              <span>
                @php
                $ammount = $offercheck->old_price - $offercheck->ocurrent_price;
                $discount =  $ammount/$offercheck->ocurrent_price*100;
                @endphp
                - {{ intval($discount)  }}% OFF
              </span>
            </div>
            @endif
            <div class="bg-white homeproducts p-3">
              <center>
                <a href="{{ url('product') }}/{{ $productname }}/{{ $p->product_id }}"><img src="{{ asset('public/productImage') }}/{{ $p->image }}" alt=""></a>
              </center>

              <div class="border-top">
               <br>
               <a href="{{ url('product') }}/{{ $productname }}/{{ $p->product_id }}">{{ $p->product_name }}</a><br>
               <div class="mt-2">
                <span>
                 {!! $p->product_us !!}
               </span>
             </div>
             <div class="mt-2">
              @if(isset($offercheck))
              <del>{{ $offercheck->old_price }}৳</del>&nbsp;&nbsp;<strong>{{ $offercheck->ocurrent_price }}৳</strong>
              @else
              <del>@if($p->discount_price > 0){{ $p->sale_price }}৳@endif</del>&nbsp;&nbsp;<strong>{{ $p->current_price }}৳</strong>
              @endif
            </div>

            <div class="mt-4">
              <button onclick="AddCart('{{ $p->id }}')"><i class="fa fa-shopping-basket"></i>&nbsp;&nbsp;ADD TO CART</button>
            </div>
          </div>

        </div>
      </div>


      @endforeach
      @endif



      {{ $searchproducts->links() }}

    </div>

  </div>


@else 

<div class="col-12 text-center">
  <h1>No Product Found</h1>
  </div>


@endif



</div>

</div>
</div>







@endsection




