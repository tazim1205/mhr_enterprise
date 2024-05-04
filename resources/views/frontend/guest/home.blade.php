@extends('frontend.layouts.master')

@section('content')

@include('frontend.layouts.navbar')


<style>
    .guest-left-dashboard {
    box-shadow: 0px 1px 2px 1px #e5e5e5;
    margin-top: 20px;
    padding: 13px 0px;
}
.guest-menu li {
    list-style: none;
    display: block;
    padding: 10px 16px;
    border-bottom: 1px dashed lightgray;
}
.guest-menu li.active {
    border-left: 6px solid green;
    color: green !important;
    background : lightgray;
}

.guest-menu li.active>.guest-menu li a {
    color: black !important;
}
.guest-menu li a{
    text-decoration: none;
    color:  black;
}
.guest-dashboard-body {
    box-shadow: 0px 1px 1px 1px lightgray;
    margin-top: 19px;
}
.profile-header{
    border-bottom: 1px solid lightgray;
}
.inputBorder{
    border: 1px solid;
    padding: 5px;
}
.saveButton{
    margin-top: 30px;
}
.form-control {
  height: 30px !important;
  border-radius: 4px !important;
  font-family: "Inter", sans-serif !important;
  }

  .userdashboard {
    background: #fff;
    border-radius: 5px;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
}

.userdashboard strong{
  font-size: 20px;
}

.userdashboard a{
  color: #fff;
}
.userdashboard .dash{
  color: #fff;
  font-weight: bold;
  border-radius: 5px;

}

.userdashboard li{
  display: block;
  list-style: none;
  padding: 12px 20px;
  transition: 0.3s;
}

.userdashboard li a{
  color: #222;
  font-size: 15px;


}

.userdashboard li:hover{
  background: #f8f8f8;
}


.userdashboard .active{
 background: #f8f8f8;
 border-left: 4px solid #222;
}


</style>
        </div>
    </div>
</div>
<!-- Navbar End -->



<div class="container" style="padding: 22px;">
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-12 mt-4">
            <div class="col-md-12 p-0 pt-4 userdashboard">
                <div class="guest-left-dashboard">
                    <div class="guest-header" style="text-align: center;">
                        <img src="{{asset('backend')}}/img/guestUserImage/{{Auth::guard('guest')->user()->image}}" height="100px" width="100px" class="rounded-circle"><br>
                        <b>{{Auth::guard('guest')->user()->first_name}} {{Auth::guard('guest')->user()->last_name}}</b><br>
                        <span>{{Auth::guard('guest')->user()->mobile}}</span>
                    </div>
                    @component('components.guest_sidebar')

                    @endcomponent
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-7 col-12 mt-4">
            <div class="col-md-12 p-4 userdashboard">

                <strong><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;Personal Information</strong><br><br>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Name:</th>
                            <td>{{ Auth('guest')->user()->first_name }} {{ Auth('guest')->user()->last_name }}</td>
                        </tr>

                        <tr>
                            <th>Email:</th>
                            <td>{{ Auth('guest')->user()->email }}</td>
                        </tr>

                        <tr>
                            <th>Phone:</th>
                            <td>{{ Auth('guest')->user()->mobile }}</td>
                        </tr>
                    </tbody>
                </table>



                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mt-4">
                        <div class="dash p-3 bg-primary">
                            {{--<label>{{ count($data) }}</label><br>--}}
                            <a href="">Total Order</a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mt-4">
                        <div class="dash p-3 bg-info">
                            {{--<label>{{ count($pending) }}</label><br>--}}
                            <a href="">Pending Order</a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mt-4">
                        <div class="dash p-3 bg-info">
                            {{--<label>{{ count($processing) }}</label><br>--}}
                            <a href="">Processing Order</a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mt-4">
                        <div class="dash p-3 bg-primary">
                            {{--<label>{{ count($delivered) }}</label><br>--}}
                            <a href="">Delivered Order</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection