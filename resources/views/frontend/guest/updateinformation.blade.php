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
            <div class="col-md-12 p-0 pt-4 pb-4 userdashboard">
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

                <strong><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;Personal Information</strong>
                
                <form action="{{url('guest_user_update')}}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="row profile-body form-group p-4">
                        <div class="col-lg-6 p-2">
                            <label class="form-label">First Name :</label>
                            <input type="text" class="form-control form-control-sm inputBorder w-80"
                            value="{{Auth::guard('guest')->user()->first_name}}"
                            name="first_name"
                            required>
                        </div>
                        <div class="col-lg-6 p-2">
                            <label class="form-label">Last Name :</label>
                            <input type="text" class="form-control form-control-sm inputBorder"
                            value="{{Auth::guard('guest')->user()->last_name}}"
                            name="last_name"
                            required>
                        </div>
                        <div class="col-lg-6 p-2">
                            <label class="form-label">Email :</label>
                            <input type="email" class="form-control form-control-sm inputBorder"
                            value="{{Auth::guard('guest')->user()->email}}"
                            name="email"
                            required>
                        </div>
                        <div class="col-lg-6 p-2">
                            <label class="form-label">Mobile :</label>
                            <input type="text" class="form-control form-control-sm inputBorder"
                            value="{{Auth::guard('guest')->user()->mobile}}"
                            name="mobile"
                            required>
                        </div>
                        <div class="col-lg-6 p-2">
                            <label class="form-label">Image :</label>
                            <input type="file" class="form-control form-control-sm inputBorder"
                            value=""
                            name="image"
                            required>
                        </div>
                        <div class="col-6 mt-4" style="text-align: right">
                            <button type="submit" id="submit" class="btn  btn-success"> <i class="fa fa-save"></i> Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




@endsection