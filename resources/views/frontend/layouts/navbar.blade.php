
<style>
    body,
    .multilevel-dropdown-menu {
        font-family: Arial, sans-serif;
    }

    .parent {
        display: block;
        position: relative;
        float: left;
        line-height: 40px;
        background-color: #ffc72c;
        border-right: #CCC 1px solid;
        z-index: 999;
        width: 80%;
        text-align: center;
    }

    .parent a {
        margin: 10px 24px;
        color: #5d3200;
        text-decoration: none;
    }

    .parent:hover>ul {
        display: block;
        position: absolute;
    }

    .child {
        display: none;
    }

    .child li {
        background-color: #E4EFF7;
        line-height: 40px;
        border-bottom: #b5b5b5 1px solid;
        border-right: #b5b5b5 1px solid;
        width: 100%;
    }

    .child li a {
        color: #000000;
    }

    ul {
        list-style: none;
        margin: 0;
        padding: 0px;
        min-width: 12em;
    }

    ul ul ul {
        left: 100%;
        top: 0;
        margin-left: 1px;
    }

    .parent li:hover {
        background-color: #F0F0F0;
    }

    .expand {
        font-size: 12px;
        float: right;
        margin-right: 5px;
    }
    .logosection li {
        display: inline-grid;
        margin-left: 30px !important;
        font-size: 13px;
        color: #fff !important;
    }
    .logosection li a {
        color: #fff;
        font-size: 20px;
        text-align: center;
    }
</style>
<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}">MHR<span>.</span></a>
        
        <ul class="multilevel-dropdown-menu" style="margin-left: 40px;width: 19em;">
            <li class="parent"><a href="#">Category</a>
            
            <ul class="child">
                    @if($categorie)
                    @foreach($categorie as $c)
                    @php
                    $count = DB::table('sub_categories')->where('cat_id',$c->id)->count();
                    @endphp
                    @if($count > 0)
                    <li class="parent"><a href="#">@if(config('app.locale') == 'en'){{$c->cat_name_en}}@elseif(config('app.locale') == 'en') {{$c->cat_name_bn}}@endif <span class="expand">»</span></a>
                        <ul class="child">
                            @foreach($sub_categorie as $s)
                            @if($s->cat_id == $c->id)
                            <li><a href="{{url('sub_categorie_product')}}/{{$s->id}}">@if(config('app.locale') == 'en'){{$s->sub_cat_name_en}}@elseif(config('app.locale') == 'en') {{$s->sub_cat_name_bn}}@endif</a></li>
                            @endif
                            @endforeach
                        </ul>
                    </li>
                    @else
                    <li><a href="{{url('categorie_product')}}/{{$c->id}}">@if(config('app.locale') == 'en'){{$c->cat_name_en}}@elseif(config('app.locale') == 'en') {{$c->cat_name_bn}}@endif</a></li>
                    @endif
                    @endforeach
                    @endif
                </ul>
            </li>
        </ul>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/')}}">Home</a>
                </li>
                <li><a class="nav-link" href="{{url('/shop')}}">New Arrivals</a></li>
                {{--<li><a class="nav-link" href="about.html">About us</a></li>
                <li><a class="nav-link" href="contact.html">Contact us</a></li>--}}
            </ul>
            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5 logosection">
              {{--  @if(Auth::guard('guest')->check())
                <li><a class="nav-link" href="{{url('')}}" style="color: #fff;"></a></li>
                @else
                <li><a class="nav-link" href="{{url('login_guest')}}" style="color: #2f2f2f;background: #f9bf29;border-color: #f9bf29;"><i class="fa-solid fa-circle-user"></i>Login</a></li>
                <li><a class="nav-link" href="{{url('registration')}}" style="color: #2f2f2f;background: #f9bf29;border-color: #f9bf29;">Registration</a></li>
                @endif --}}

                @if(Auth::guard('guest')->check())
                <li><a href="{{ url('guest_dashboard') }}" uk-tooltip="title: Profile; pos:bottom"><i class="fa-solid fa-circle-user"></i></a>{{Auth::guard('guest')->user()->first_name}} {{Auth::guard('guest')->user()->last_name}}</li>
                @else
                <li><a href="{{ url('login_guest') }}" uk-tooltip="title: Profile; pos:bottom"><i class="fa-solid fa-circle-user"></i></a>Account</li>
                @endif

                @if(Auth::guard('guest')->check())

                <li>
                    <a href="@if(Auth::guard('guest')->check()){{url('wishlist')}}/{{Auth::guard('guest')->user()->id}}@endif" uk-tooltip="title: Offers Product; pos:bottom"><i class="fa fa-heart"></i><span id="totalWishList">0</span></a>WishList
                </li>

                <li>
                    <a href="@if(Auth::guard('guest')->check()){{url('add_cart_user')}}/{{Auth::guard('guest')->user()->id}}@endif" uk-tooltip="title: Cart; pos:bottom" uk-toggle="target: #offcanvas-none"><i class="fa fa-shopping-basket"></i><span id="totalProductCart">0</span></a>MyCart
                </li>

                @endif
                
            </ul>
        </div>
    </div>
        
</nav>


<script>

    $(document).ready(function(){

        countProductCart();
        countWishList();
        

    });


    function countProductCart()
    {
        $.ajax({
            headers : {
                'X-CSRF-TOKEN' : '{{csrf_token()}}'
            },
            url : '{{url('getProductCart')}}',

            type : 'GET',

            success : function(data)
            {
                $('#totalProductCart').html(data);
            }
        });
    }

    function countWishList()
    {
        $.ajax({
            headers : {
                'X-CSRF-TOKEN' : '{{csrf_token()}}'
            },
            url : '{{url('totalWishList')}}',

            type : 'GET',

            success : function(data)
            {
                $('#totalWishList').html(data);
            }
        });
    }

</script>