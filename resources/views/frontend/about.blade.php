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
                        <h1>About Us</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->
    
    <div class="untree_co-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 wow fadeIn" data-wow-delay=".3s">
                    <div>
                        <h1>@if(config('app.locale') == 'en'){{$about_us->title_en}}@elseif(config('app.locale') == 'bn'){{$about_us->title_bn}}@endif</h1>
                        <span class="text-dark">{!! $about_us->description !!}</span>
                    </div>
                </div>
		    </div>
        </div>
    </div>

@endsection