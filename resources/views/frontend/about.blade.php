@extends('frontend.layouts.master')

@section('content')

    <!-- Navbar Start -->
        @include('frontend.layouts.navbar')
    <!-- Navbar End -->

    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-12">
                    <div class="intro-excerpt">
                        <h1>@if(config('app.locale') == 'en'){{$about_us->title_en}}@elseif(config('app.locale') == 'bn'){{$about_us->title_bn}}@endif</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->
    
    <div class="untree_co-section p-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <h1><span class="text-dark">{!! $about_us->description !!}</span></h1>
                    </div>
                </div>
		    </div>
        </div>
    </div>

@endsection