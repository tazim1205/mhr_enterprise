@extends('backend.layouts.master')
@section('body')
<main class="content">
    <div class="container-fluid p-0">

        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3><strong>@lang('common.dashboard')</strong></h3>
            </div>

            <div class="d-none col-auto ms-auto text-end mt-n1">
                <a href="#" class="btn btn-light bg-white me-2">Invite a Friend</a>
                <a href="#" class="btn btn-primary">New Project</a>
            </div>
        </div>
        @php
        use App\Models\User;
        $user = User::find(Auth::user()->id);
        $path = public_path().'/Backend/profile/'.$user->profile;
        @endphp
        <div class="row">

            <div class="col-12 bg-success p-3 mb-3 rounded">
                <div class="welcome-profile" style="text-align: center;">

                    @if(file_exists($path))
                    <img src="{{asset('Backend/profile/')}}/{{$user->profile}}" class="img-fluid rounded" alt="{{Auth::user()->name}}" style="height: 80px;width:80px;border-radius:100%;" />
                    @else
                    <img src="{{asset('Backend')}}/img/avatars/user_avatar.png" class="img-fluid rounded" alt="{{Auth::user()->name}}" style="height: 80px;width:80px;border-radius:100%;" />
                    @endif
                </div>
                <div class="welcom-text mt-2" style="text-align: center;color:white !important;">
                    @if(config('app.locale') == 'en')
                    @php
                    if(Auth::user()->gender == 'Male')
                    {
                        $titlename = 'Mr.';
                    }
                    else {
                        $titlename = 'Mrs.';
                    }
                    @endphp
                    <h3>Welcome {{$titlename}} {{Auth::user()->name ?: Auth::user()->name_bn}}</h3>
                    @else
                    @php
                    if(Auth::user()->gender == 'Male')
                    {
                        $titlename = 'মি.';
                    }
                    else {
                        $titlename = 'মিসেস.';
                    }
                    @endphp
                    <h3>স্বাগতম {{$titlename}} {{Auth::user()->name_bn ?: Auth::user()->name}}</h3>
                    @endif
                </div>
            </div>

            <div class="col-xl-6 col-xxl-5 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="@if(Auth::user()->can('Role index')){{route('role.index')}}@else javascript:;@endif" style="text-decoration: none !important">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">@lang('common.total_roles')</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="key"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3">{{$data['total_roles']}}</h1>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="@if(Auth::user()->can('Admin index')){{route('user.index')}}@else javascript:;@endif" style="text-decoration: none !important">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">@lang('common.total_users')</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="user"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3">{{$data['total_users']}}</h1>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xxl-6 d-flex order-2 order-xxl-1">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">@lang('common.calendar')</h5>
                    </div>
                    <div class="card-body d-flex">
                        <div class="align-self-center w-100">
                            <div class="chart">
                                <div id="datetimepicker-dashboard"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

        </div>
    </div>
</main>

@endsection
