<!DOCTYPE html>
<html lang="{{config('app.locale')}}">


<!-- Mirrored from demo.adminkit.io/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 14 Oct 2023 08:47:42 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    @stack('header_script')

    @include('backend.layouts.header')

    @if(config('app.locale') == 'bn')
    <style>
        body {
            font-family: 'Hind Siliguri', sans-serif !important;
        }
    </style>
    @endif

    <style>
        .form-control:focus{
            box-shadow: none !important;
        }
        .card-body.text-center {
    position: relative;
}

.option {
    background: white;
    position: absolute;
    z-index: 99;
    padding: 6px;
    width: 365px;
    transition: .3s;
    opacity: 1;
    left: -49px;
    top: -22px;
    scale: 0;
}

.file-option {
    float: left;
    margin-right: 10px;
    background: lightgray;
    cursor: pointer !important;
    padding: 4px 14px;
}

.option span {
    cursor: pointer;
    color: black;
}
.option {
    text-align: center;
    align-items: center;
}

.file-option i {
    font-size: 24px;
}
#profile_change:hover .option {
    scale: 1;
}
    </style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


	<link href="{{asset('Backend')}}/css/light.css" rel="stylesheet">
    @if($theme->theme == 'dark')
    <link href="{{asset('Backend')}}/css/dark.css" rel="stylesheet">
    @endif

	{{-- <script src="{{asset('Backend')}}/js/settings.js"></script> --}}
	<!-- END SETTINGS -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-120946860-10"></script>

<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-120946860-10', { 'anonymize_ip': true });
  </script></head>
<!--
  HOW TO USE:
  data-theme: default (default), dark, light, colored
  data-layout: fluid (default), boxed
  data-sidebar-position: left (default), right
  data-sidebar-layout: default (default), compact
-->

<body data-theme="{{$theme->theme}}" data-layout="{{$theme->layout}}" data-sidebar-position="{{$theme->sidebar_position}}" data-sidebar-layout="{{$theme->sidebar_layout}}">
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
                @php
                $path = public_path().'/Backend/settings/'.$settings->logo;
                @endphp
				<a class='sidebar-brand' href='{{route('dashboard.index')}}'>
                    @if(file_exists($path))
                    <img src="{{asset('Backend/settings')}}/{{$settings->logo}}" alt="" class="img-fluid" style="height: 50px;">
                    @else
                    @lang('settings.logo')
                    @endif
				</a>
                @php
                use App\Models\User;
                $user = User::find(Auth::user()->id);
                $path = public_path().'/Backend/profile/'.$user->profile;
                $currentRoute = Route::currentRouteName();
                $explodeCurrentRoute = explode('.',$currentRoute);
                $currentMenuId = App\Models\Menu::where('route',$explodeCurrentRoute[0])->first();

                @endphp

                <ul class="sidebar-nav">
                @if($first_menu)
                @if(Auth::user()->can($first_menu->system_name.' '.$first_menu->slug))
                <li class="sidebar-item @if($currentMenuId->id == $first_menu->id) active @endif">
                    <a class='sidebar-link' href='@if(Route::has($first_menu->route.'.'.$first_menu->slug)) {{route($first_menu->route.'.'.$first_menu->slug)}} @else javascript:; @endif'>
                        <i class="{{$first_menu->icon}}"></i> <span class="align-middle">@if(config('app.locale') == 'en') {{$first_menu->menu_name_en ?: $first_menu->menu_name_bn}} @else {{$first_menu->menu_name_bn ?: $first_menu->menu_name_en}} @endif</span>
                    </a>
                </li>
                @endif
                @endif

                    @if($menu_label)
                    @foreach ($menu_label as $label)

                    @php
                    $thisLabel = App\Models\Menu::where('label_id',$label->id)->where('type','!=',2)->get();
                    $totalLabelPermission = 0;
                    foreach ($thisLabel as $tl)
                    {
                        if($tl->type == 1)
                        {
                            $module = App\Models\Menu::where('parent_id',$tl->id)->where('type',2)->get();
                            foreach ($module as $m)
                            {
                                $thispermission = $m->system_name.' '.$m->slug;
                                $getPermission = DB::table('permissions')->where('name',$thispermission)->first();
                                $countPermission = DB::table('role_has_permissions')->where('permission_id',$getPermission->id)->where('role_id',Auth::user()->roles()->pluck('id')->first())->count();
                                $totalLabelPermission = $totalLabelPermission + $countPermission;
                            }
                        }

                        if($tl->type == 3)
                        {
                            $single = App\Models\Menu::where('label_id',$label->id)->where('type',3)->get();
                            foreach ($single as $m)
                            {
                                $thispermission = $m->system_name.' '.$m->slug;
                                $getPermission = DB::table('permissions')->where('name',$thispermission)->first();
                                $countPermission = DB::table('role_has_permissions')->where('permission_id',$getPermission->id)->where('role_id',Auth::user()->roles()->pluck('id')->first())->count();
                                $totalLabelPermission = $totalLabelPermission + $countPermission;
                            }
                        }

                    }
                    @endphp
                    @if($totalLabelPermission > 0)
					<li class="sidebar-header">
						@if(config('app.locale') == 'en') {{$label->label_name_en ?: $label->label_name_bn}} @else {{$label->label_name_bn ?: $label->label_name_en}}@endif
					</li>
                    @if($parent)
                    @foreach ($parent as $m)
                    @php
                    $thisModule = App\Models\Menu::where('parent_id',$m->id)->where('type',2)->where('status',1)->get();
                    $totalParentPermission = 0;
                    foreach ($thisModule as $tm)
                    {
                        $thispermission = $tm->system_name.' '.$tm->slug;
                        $getPermission = DB::table('permissions')->where('name',$thispermission)->first();
                        $countPermission = DB::table('role_has_permissions')->where('permission_id',$getPermission->id)->where('role_id',Auth::user()->roles()->pluck('id')->first())->count();
                        $totalParentPermission = $totalParentPermission + $countPermission;

                        // echo $thispermission.'//';
                    }
                    @endphp
                    @if($m->type == 1 && $label->id == $m->label_id)

                    @if($totalParentPermission > 0)
                    <li class="sidebar-item @if($currentMenuId->parent_id == $m->id) active @endif">
						<a data-bs-target="#{{$m->id}}" data-bs-toggle="collapse" class="sidebar-link @if($currentMenuId->parent_id == $m->id) @else collapsed @endif" aria-expanded="@if($currentMenuId->parent_id == $m->id)true @else false @endif">
							<i class="{{$m->icon}}"></i> <span class="align-middle">
                                @if(config('app.locale') == 'en')
                                {{$m->menu_name_en ?: $m->menu_name_bn}}
                                @else
                                {{$m->menu_name_bn ?: $m->menu_name_en}}
                                @endif
                            </span>
						</a>
						<ul id="{{$m->id}}" class="sidebar-dropdown list-unstyled collapse @if($currentMenuId->parent_id == $m->id) show @else @endif" data-bs-parent="#{{$m->id}}">

                            @php
                            $thisModuleMenu = App\Models\Menu::where('type',2)->where('parent_id',$m->id)->get();
                            @endphp

                            @if($thisModuleMenu)
                            @foreach ($thisModuleMenu as $vm)
                            @if($vm->parent_id == $m->id)

                            @if(Auth::user()->can($vm->system_name.' '.$vm->slug))
							<li class="sidebar-item @if($currentMenuId->id == $vm->id) active @endif"><a class='sidebar-link' href='@if(Route::has($vm->route.'.'.$vm->slug)) {{route($vm->route.'.'.$vm->slug)}} @else javascript:; @endif'>
                                @if(config('app.locale') == 'en')
                                {{$vm->menu_name_en ?: $vm->menu_name_bn}}
                                @else
                                {{$vm->menu_name_bn ?: $vm->menu_name_en}}
                                @endif
                                </a>
                            </li>
                            @endif
                            @endif
                            @endforeach
                            @endif
						</ul>
					</li>
                    @endif

                    @else

                    @endif

                    @endforeach
                    @endif

                    @foreach ($single as $sm)
                    @if($label->id == $sm->label_id)
                    @if(Auth::user()->can($sm->system_name.' '.$sm->slug))
                    <li class="sidebar-item @if($currentMenuId->parent_id == $sm->id) active @endif">
						<a class='sidebar-link' href='@if(Route::has($sm->route.'.'.$sm->slug)) {{route($sm->route.'.'.$sm->slug)}} @else javascript:; @endif'>
							<i class="{{$sm->icon}}"></i> <span class="align-middle">
                                @if(config('app.locale') == 'en')
                                {{$sm->menu_name_en ?: $sm->menu_name_bn}}
                                @else
                                {{$sm->menu_name_bn ?: $sm->menu_name_en}}
                                @endif
                            </span>
						</a>
					</li>
                    @endif

                    @endif
                    @endforeach




                    @endif
                    @endforeach
                    @endif
				</ul>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand">
				<a class="sidebar-toggle js-sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a>

				<div class="d-sm-inline-block">
					<div class="input-group input-group-navbar">
						<input type="text" class="form-control" placeholder="@lang('common.search')" aria-label="Search" id="searchData" name="searchData" onchange="return getQuickMenu()" autocomplete="off">
						<button class="btn" type="button" onclick="return getQuickMenu()">
							<i class="align-middle" data-feather="search"></i>
						</button>
                        <div class="showMenu">

                        </div>
					</div>
				</div>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
                            <form method="post" action="{{url('changeLocale')}}" id="changeLocale">
                                @csrf
                                <input type="hidden" id="locale" name="locale" value="">
                                @if(config('app.locale') == 'en')
							    <a class="nav-flag dropdown-toggle" href="#" id="languageDropdown" data-bs-toggle="dropdown">
								<img src="{{asset('Backend')}}/img/flags/us.png" alt="English" />
                                @elseif(config('app.locale') == 'bn')
							    <a class="nav-flag dropdown-toggle" href="#" id="languageDropdown" data-bs-toggle="dropdown">
								<img src="{{asset('Backend')}}/img/flags/bd_big.png" alt="English" />
                                @endif
							</a>
							<div class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
								<a class="dropdown-item" id="submitLoacaleEn" onclick="submitLoacle();">
									<img src="{{asset('Backend')}}/img/flags/us.png" alt="English" width="20" class="align-middle me-1" />
									<span class="align-middle">English</span>
								</a>
								<a class="dropdown-item" id="submitLoacaleBn" onclick="submitLoacle();">
									<img src="{{asset('Backend')}}/img/flags/bd_big.png" alt="English" width="20" class="align-middle me-1" />
									<span class="align-middle">বাংলা</span>
								</a>

							</div>
                        </form>
						</li>
						<li class="nav-item">
							<a class="nav-icon js-fullscreen d-none d-lg-block" href="#">
								<div class="position-relative">
									<i class="align-middle" data-feather="maximize"></i>
								</div>
							</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-icon pe-md-0 dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                @if(file_exists($path))
								<img src="{{asset('Backend/profile/')}}/{{$user->profile}}" class="avatar img-fluid rounded" alt="Charles Hall" />
                                @else
								<img src="{{asset('Backend')}}/img/avatars/user_avatar.png" class="avatar img-fluid rounded" alt="Charles Hall" />
                                @endif
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class='dropdown-item' href='{{route('user.show',Auth::user()->id)}}'><i class="align-middle me-1" data-feather="user"></i> @lang('user.profile')</a>
								<a class="dropdown-item" href="{{route('user.reset_pass')}}"><i class="fa fa-key"></i> @lang('user.change_pass')</a>
                                {{-- <a class="dropdown-item" href="{{route('user.change_pass')}}"><i class="fa fa-key"></i> @lang('user.change_pass')</a> --}}
								<div class="dropdown-divider"></div>
								<form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    {{-- <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();"> --}}
                                        <a onclick="event.preventDefault();
                                        this.closest('form').submit();" href="route('logout')" type="button" class="dropdown-item"><i class="fas fa-fw fa-sign-out-alt"></i> @lang('common.logout')</a>
                                    {{-- </x-dropdown-link> --}}
                                </form>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			@yield('body')
		</div>
	</div>

	<script src="{{asset('Backend')}}/js/app.js"></script>

    <script src="{{asset('Backend')}}/js/datatables.js"></script>

    @include('sweetalert::alert')



@include('backend.layouts.footer_scripts')


@stack('footer_script')
<script>
      $('#searchData').on('keyup',function(){
        let data = $('#searchData').val();
        // alert(data);
        if(data == '')
        {
            $('.showMenu').hide();
        }
    });
</script>
<script>

    function getQuickMenu()
    {
        let data = $('#searchData').val();
        if(data != '')
        {
            $.ajax({
                headers : {
                    'X-CSRF-TOKEN' : '{{csrf_token()}}'
                },
                url : '{{url('getQuickMenu')}}',
                type : 'POST',
                data : {data},
                beforeSend: function(r)
                {

                },
                success : function(r)
                {
                    $('.showMenu').html(r);
                }
            });
        }
    }
</script>
</body>


<!-- Mirrored from demo.adminkit.io/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 14 Oct 2023 08:48:38 GMT -->
</html>