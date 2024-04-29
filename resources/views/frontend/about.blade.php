@extends('fronted.layouts.master')

@section('content')

    <!-- Navbar Start -->
    <div class="container-fluid  page-header ">

        @include('fronted.layouts.navbar')
        
        <div class="container text-center py-5">
            <h4 class="display-2 text-white mb-4 mt-1 animated slideInDown">About Us</h4>
        
        </div>
    </div>
<!-- Navbar End -->

    <!-- About Start -->
    <div class="container-fluid py-5">
        <div     class="container pt-5">
            <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                <h1 class="text-primary">About Us</h1>
                <h5>About  Agency And It's Innovative IT Solutions</h5>
            </div>
                <div class="row g-5">
                    <div class="col-lg-5 col-md-6 col-sm-12 wow fadeIn" data-wow-delay=".3s">
                        <div class="h-100 position-relative">
                            <img src="{{ asset('') }}fronted/assets/img/one.jpg" class="img-fluid w-75 rounded" alt="" style="margin-bottom: 25%;">
                            <div class="position-absolute w-75" style="top: 25%; left: 25%;">
                                <img src="{{ asset('') }}fronted/assets/img/two.jpg" class="img-fluid w-100 rounded" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6 col-sm-12 wow fadeIn" data-wow-delay=".5s">
                        
                        <p>It was in 2012, with little capital but a pocketful of belief our CEO, Abdul Mannan Sumon started SBIT, a software company, when he was just started his Diploma. The new company initially focused on the international market with the local market added in 2013. Since then the company has shown a continuous Growth.</p>
                    </div>
                </div>
        </div>
    </div>
    <!-- About End -->  

@endsection