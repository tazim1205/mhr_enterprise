@extends('frontend.layouts.master')

@section('content')

<style>
h1, p {
  margin: 0;
  padding: 0;
}
h1 {
  font-size: 2rem;
  font-family: 'Dancing Script';
}
small {
  display: block;
  padding: 1rem 0;
  font-size: 0.8rem;
  transition: opacity 0.33s;
}
textarea, input, button {
  line-height: 1.5rem;
  border: 0;
  outline: none;
  font-family: inherit;
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
}
textarea, input {
  color: #4e5e72;
  background-color: transparent;
  background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='10' height='24'><rect fill='rgb(229, 225, 187)' x='0' y='23' width='10' height='1'/></svg>");
}
textarea {
 width: 100%;
 height: 8rem;
 resize: none;
}
input {
 width: 50%;
 margin-bottom: 1rem;
}
input[type=text]:invalid, input [type=email]:invalid {
    box-shadow: none;
    background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='10' height='24'><rect fill='rgba(240, 132, 114, 0.5)' x='0' y='23' width='10' height='1'/></svg>");
  }
button {
 padding: 0.5rem 1rem;
 border-radius: 0.25rem;
 background-color: rgba(78, 94, 114, 0.9);
 color: white;
 font-size: 1rem;
 transition: background-color 0.2s;
}
button:hover,button :focus {
    outline: none;
    background-color: rgba(78, 94, 114, 1);
  }
input[type=text]:focus,
input[type=email]:focus,
textarea:focus {
  background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='10' height='24'><rect fill='rgba(78, 94, 114, 0.3)' x='0' y='23' width='10' height='1'/></svg>");
  outline: none;
}
.wrapper {
  width: 35rem;
}
.side {
  height: 12rem;
  background-color: #fcfcf8;
  outline: 1px solid transparent;
}
.side:nth-of-type(1) {
    padding: 2rem 2rem 0;
    border-radius: 1rem 1rem 0 0;
    box-shadow: inset 0 0.75rem 2rem rgba(229, 225, 187, 0.5);
  }
.side.side:nth-of-type(2) {
    padding: 2rem;
    border-radius: 0 0 1rem 1rem;
    box-shadow: 0 0.3rem 0.3rem rgba(0, 0, 0, 0.05), inset 0 -0.57rem 2rem rgba(229, 225, 187, 0.5);
    text-align: right;
  }
.envelope {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  margin: auto;
}
.envelope.front {
  width: 10rem;
  height: 6rem;
  border-radius: 0 0 1rem 1rem;
  overflow: hidden;
  z-index: 9999;
  opacity: 0;
}
.envelope.front::before, .envelope.front::after {
  position: absolute;
  display: block;
  width: 12rem;
  height: 6rem;
  background-color: #e9dc9d;
  transform: rotate(30deg);
  transform-origin: 0 0;
  box-shadow: 0 0 1rem rgba(0, 0, 0, 0.1);
  content: '';
}
.envelope.front::after{
  right: 0;
  transform: rotate(-30deg);
  transform-origin: 100% 0;
}
.envelope.back {
  top: -4rem;
  width: 10rem;
  height: 10rem;
  overflow: hidden;
  z-index: -9998;
  opacity: 0;
  transform: translateY(-6rem);
}
.envelope.back::before {
    display: block;
    width: 10rem;
    height: 10rem;
    background-color: #e9dc9d;
    border-radius: 1rem;
    content: '';
    transform: scaleY(0.6) rotate(45deg)
  }
.result-message {
  opacity: 0;
  transition: all 0.3s 2s;
  transform: translateY(9rem);
  z-index: -9999;
}
.sent .letter {
    -webkit-animation: scaleLetter 1s forwards ease-in /*,
               pushLetter 0.5s 1.33s forwards ease-out*/ ;
            animation: scaleLetter 1s forwards ease-in /*,
               pushLetter 0.5s 1.33s forwards ease-out*/ ;
  }
.sent .side:nth-of-type(1) {
    transform-origin: 0 100%;
    -webkit-animation: closeLetter 0.66s forwards ease-in;
            animation: closeLetter 0.66s forwards ease-in;
  }
.sent .side:nth-of-type(1) h1, .sent .side:nth-of-type(1) textarea {
    -webkit-animation: fadeOutText 0.66s forwards linear;
            animation: fadeOutText 0.66s forwards linear;
  }
.sent button {
    background-color: rgba(78, 94, 114, 0.2);
  }
.sent .envelope {
    -webkit-animation: fadeInEnvelope 0.5s 1.33s forwards ease-out;
            animation: fadeInEnvelope 0.5s 1.33s forwards ease-out;
  }
.sent .result-message {
    opacity: 1;
    transform: translateY(12rem);
  }

@-webkit-keyframes closeLetter {
   50% {transform: rotateX(-90deg);}
   100% {transform: rotateX(-180deg);}
}
@keyframes closeLetter {
   50% {transform: rotateX(-90deg);}
   100% {transform: rotateX(-180deg);}
}
@-webkit-keyframes fadeOutText {
   49% {opacity: 1;}
   50% {opacity: 0;}
   100% {opacity: 0;}
}
@keyframes fadeOutText {
   49% {opacity: 1;}
   50% {opacity: 0;}
   100% {opacity: 0;}
}
@-webkit-keyframes fadeInEnvelope {
  0% {opacity: 0; transform: translateY(8rem);}
  /*90% {opacity: 1; transform: translateY(4rem);}*/
  100% {opacity: 1; transform: translateY(4.5rem);}
}
@keyframes fadeInEnvelope {
  0% {opacity: 0; transform: translateY(8rem);}
  /*90% {opacity: 1; transform: translateY(4rem);}*/
  100% {opacity: 1; transform: translateY(4.5rem);}
}
@-webkit-keyframes scaleLetter {
  66% {transform: translateY(-8rem) scale(0.5, 0.5);}
  75% {transform: translateY(-8rem) scale(0.5, 0.5);}
  90% {transform: translateY(-8rem) scale(0.3, 0.5);}
  97% {transform: translateY(-8rem) scale(0.33, 0.5);}
  100%{transform: translateY(-8rem) scale(0.3, 0.5);}
}
@keyframes scaleLetter {
  66% {transform: translateY(-8rem) scale(0.5, 0.5);}
  75% {transform: translateY(-8rem) scale(0.5, 0.5);}
  90% {transform: translateY(-8rem) scale(0.3, 0.5);}
  97% {transform: translateY(-8rem) scale(0.33, 0.5);}
  100%{transform: translateY(-8rem) scale(0.3, 0.5);}
}

@media (max-width: 480px) {
  .wrapper {
  width: 20rem !important;
}
}
</style>

    <!-- Navbar Start -->
    @include('frontend.layouts.navbar')
    <!-- Navbar End -->

    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Contact Us</h1>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="untree_co-section before-footer-section">
        <div class="container">
            <div class="pd-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 wow fadeIn" data-wow-delay=".3s">
                            <div>
                                <h1>Know More About MHR Enterprise</h1>
                                <span class="text-dark">Fill out this form and we'll reach out to help find the best plan option for you.</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="wrapper centered">
                                <article class="letter">
                                    <form method="POST" id="form-data">
                                        <div class="side">
                                            <h1>Contact us</h1><br>
                                            <p>
                                                <textarea placeholder="Your Message" id="message" name="message"></textarea>
                                            </p>
                                        </div>
                                        <div class="side">
                                            <p>
                                                <input type="text" placeholder="Your Name" id="name" name="name">
                                            </p>
                                            <p>
                                                <input type="email" placeholder="Your Email" id="email" name="email">
                                            </p>
                                            <p>
                                                <input type="number" placeholder="Your Phone Number" id="phone" name="phone">
                                            </p>
                                            <p>
                                                <button class="btn btn-primary py-3" type="submit" id="submit">Send Message</button>
                                                <button class="btn btn-primary w-100 py-3" type="hidden" id="loading">.....</button>
                                            </p>
                                        </div>
                                    </form>
                                </article>
                                <div class="envelope front"></div>
                                <div class="envelope back"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@push('footer_scripts')

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script>

    $("#loading").hide();

    $('#form-data').on('submit',function(e){
        
        e.preventDefault();
        
        $('#name').on('keyup',function(){
            $('#name').removeClass('is-invalid');
        });
        $('#email').on('keyup',function(){
            $('#email').removeClass('is-invalid');
        });
        $('#phone').on('keyup',function(){
            $('#phone').removeClass('is-invalid');
        });
        $('#message').on('keyup',function(){
            $('#message').removeClass('is-invalid');
        });

        var name = $('#name').val();

        var email = $('#email').val();

        var phone = $('#phone').val();

        var message = $('#message').val();

        if(name == "")
        {
            $('#name').addClass('is-invalid');
        }
        else if(email == "")
        {
            $('#email').addClass('is-invalid');
        }
        else if(phone == "")
        {
            $('#phone').addClass('is-invalid');
        }
        else if(message == "")
        {
            $('#message').addClass('is-invalid');
        }
        else
        {
            $.ajax({
                headers:{
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },
                url : '{{ url('sendMessage') }}',

                type : 'POST',

                data : new FormData(this),

                cache:false,

                contentType: false,

                processData: false,

                beforeSend : function()
                {
                    $('#loading').show();
                    $('#submit').hide();
                },
                success : function(data)
                {
                    if(data == 1)
                    {
                        toastr.success('Message sent successfully. You will recive a email from us', 'Success');
                        $('#loading').hide();
                        $('#submit').show();
                    }
                    else
                    {
                        toastr.success('Message sent Unsuccessfully.', 'Error');
                        $('#loading').hide();
                        $('#submit').show();

                    }

                }
            });
        }

    });
</script>

@endpush
         
@endsection