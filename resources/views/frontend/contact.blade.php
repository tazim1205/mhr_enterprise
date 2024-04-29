@extends('fronted.layouts.master')

@section('content')

    <!-- Navbar Start -->
    <div class="container-fluid  page-header ">

        @include('fronted.layouts.navbar')
        
        <div class="container text-center py-5">
            <h4 class="display-2 text-white mb-4 mt-1 animated slideInDown">Contact us</h4>
        
        </div>
    </div>
<!-- Navbar End -->

         <!-- Contact Start -->
         <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                    <h5 class="text-primary">Get In Touch</h5>
                    <h1 class="mb-3">Contact for any query</h1>
                    <p class="mb-2">The contact form is currently inactive.</p>
                </div>
                <div class="row">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay=".3s">
                        <div class="p-5 h-100 rounded contact-map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3649.483946360944!2d90.36854347484837!3d23.836943085449285!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c1a6ee7a7339%3A0x7a8f026abc0c0c4f!2sSkill%20Based%20IT-%20SBIT!5e0!3m2!1sen!2sbd!4v1712139696316!5m2!1sen!2sbd" width="500" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay=".3s">
                        <div class="p-5 h-100 rounded contact-map">
                            <div class="text-center">
                                <h2>Head Office [Dhaka]</h2>
                                <div class="box-dtails">
                                    House # 535, Avenue # 5, Road # 8<br>
                                    Mirpur DOHS<br>
                                    Mirpur, Dhaka-1216.<br>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <h6>Phone Number</h6>
                                <div class="box-dtails">
                                    +8801840241895<br>
                                    +880 1842-981245<br>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <h6>Email Address</h6>
                                <div class="box-dtails">
                                    sbit.marketingteam@gmail.com
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 wow fadeIn mt-4" data-wow-delay=".3s">
                        <div class="p-5 h-100 rounded contact-map">
                            <h5 class="text-center mb-3">Feni Office</h5>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3672.273462644854!2d91.39654507482406!3d23.01372941665911!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x37536836ba1a6935%3A0x8c51de81f4d7516d!2sSkill%20Based%20Information%20Technology%2C%20Mizan%20Rd%2C%20Feni%203900!5e0!3m2!1sen!2sbd!4v1712139735525!5m2!1sen!2sbd" width="500" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn mt-4" data-wow-delay=".3s">
                        <div class="p-5 h-100 rounded contact-map">
                            <div class="text-center">
                                <h2>Feni Office</h2>
                                <div class="box-dtails">
                                    Yousuf Tower (1st Floor),<br>
                                    Hazi Fazal Master Lane,<br>
                                    Mizan Road Feni.<br>
                                    3900 Feni, Bangladesh.<br>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <h6>Phone Number</h6>
                                <div class="box-dtails">
                                    +8801840241895<br>
                                    +880 1842-981245<br>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <h6>Email Address</h6>
                                <div class="box-dtails">
                                    sbit.marketingteam@gmail.com
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-detail position-relative p-5 mt-5">
                    <div class="row g-5">
                        <div class="col-lg-6 wow fadeIn" data-wow-delay=".3s">
                            <div>
                                <h1>Learn More About Skill Based IT</h1>
                                <span class="text-dark">Fill out this form and we'll reach out to help find the best plan option for you.</span>
                            </div>
                        </div>
                        <div class="col-lg-6 wow fadeIn" data-wow-delay=".5s">
                            <form method="POST" id="form-data">
                                <div class="p-5 rounded contact-form">
                                    <div class="mb-4">
                                        <input type="text" class="form-control border-0 py-3" placeholder="Your Name" id="name" name="name">
                                    </div>
                                    <div class="mb-4">
                                        <input type="text" class="form-control border-0 py-3" placeholder="Your Email" id="email" name="email">
                                    </div>
                                    <div class="mb-4">
                                        <input type="number" class="form-control border-0 py-3" placeholder="Phone Number" id="phone" name="phone">
                                    </div>
                                    <div class="mb-4">
                                        <textarea class="w-100 form-control border-0 py-3" rows="6" cols="10" placeholder="Message" id="message" name="message"></textarea>
                                    </div>
                                    <div class="text-start">
                                        <button class="btn btn-primary w-100 py-3" type="submit" id="submit">Send Message</button>
                                        <button class="btn btn-primary w-100 py-3" type="hidden" id="loading">.....</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <!-- Contact End -->
@endsection