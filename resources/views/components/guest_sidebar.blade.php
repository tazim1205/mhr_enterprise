<div class="guest-menu">
    <li class="{{request()->Is('guest_dashboard') ? 'active' : ''}}"><a href="{{url('/guest_dashboard')}}"><i class="fa fa-user"></i> Dashboard</a></li>
    <li class="{{request()->Is('check_order') ? 'active' : ''}}"><a href="{{url('check_order')}}"><i class="fa fa-shopping-cart"></i> Order Information</a></li>
    <li class="{{request()->Is('updateinformation') ? 'active' : ''}}"><a href="{{url('/updateinformation')}}"><i class="fa fa-user"></i> Basic Information</a></li>
    <li><a href="#"><i class="fa fa-key"></i> Change Password</a></li>
    <li><a href="{{url('guestLogout')}}"><i class="fa fa-arrow-left"></i> Logout</a></li>
</div>