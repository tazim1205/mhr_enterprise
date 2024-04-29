@extends('backend.layouts.master')
@section('body')
@push('header_script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<style>
    .cover_up {
    position: absolute;
    content: "";
    background: black;
    height: 128px;
    width: 128px;
    border-radius: 100%;

    transition: .3s;
    opacity: 0;
    bottom: 8px;
}
.changetext {
    position: absolute;
    color: white;
    font-size: 13px;
    bottom: 24px;
    left: 33px;
    /* display: none; */
    opacity: 0;
}
#profile_change{
    cursor: pointer;
    position: relative;
}
#profile_change:hover>.cover_up{
    opacity: 0.6;
}
#profile_change:hover>.changetext{
    opacity: 0.6;
}
</style>
@endpush
<main class="content">
    <div class="container-fluid p-0">

        @component('components.beardcrumb')

        {{-- /*Page Title Goese Here in this slot variable*/ --}}
        @slot('title')
        @lang('user.profile')
        @endslot

        @endcomponent

        <div class="row">
            <div class="col-md-4 col-xl-3">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">@lang('user.profile_details')</h5>
                    </div>
                    <div class="card-body text-center">
                        @php
                        use App\Models\User;
                        $user = User::find(Auth::user()->id);
                        $path = public_path().'/Backend/profile/'.$user->profile;
                        @endphp



                         @if(file_exists($path))
                         <label for="" id="profile_change">
                            <div class="option">
                                <div class="file-option">
                                    <label for="profile">
                                        <span><i class="fa fa-file"></i> @lang('user.browse_file')</span>
                                    </label>
                                </div>
                                <div class="file-option">
                                    <a  id="myIcon" data-bs-toggle="modal" data-bs-target="#Takephoto" onclick="Webcam.attach( '#my_camera' );">
                                        <label>
                                            <span onclick=""><i class="fa fa-camera"></i> @lang('user.take_photo')</span>
                                        </label>
                                    </a>
                                </div>
                            </div>
                            <div class="cover_up">

                            </div>
                            <div class="changetext">
                                <b>@lang('user.change_image')</b>
                            </div>
                        <img src="{{asset('Backend/profile')}}/{{$user->profile}}" alt="Christina Mason" class="img-fluid rounded-circle mb-2" width="128" height="128" />
                        </label>
                        @else
                        <label for="" id="profile_change">
                            <div class="option">
                                <div class="file-option">
                                    <label for="profile">
                                        <span><i class="fa fa-file"></i> @lang('user.browse_file')</span>
                                    </label>
                                </div>
                                <div class="file-option" >
                                    <a id="myIcon" data-bs-toggle="modal" data-bs-target="#Takephoto" onclick="Webcam.attach( '#my_camera' );">
                                        <label>
                                            <span onclick=""><i class="fa fa-camera"></i> @lang('user.take_photo')</span>
                                        </label>
                                    </a>
                                </div>
                            </div>
                            <div class="cover_up">

                            </div>
                            <div class="changetext">
                                <b>@lang('user.change_image')</b>
                            </div>
                        <img src="{{asset('Backend')}}/img/avatars/user_avatar.png" alt="Christina Mason" class="img-fluid rounded-circle mb-2" width="128" height="128" />
                        </label>
                        @endif



                        <div>
                            <input type="file" class="form-control d-none" name="profile" id="profile">
                        </div>

                        <h5 class="card-title mt-2 mb-0">@if(config('app.locale') == 'en') {{Auth::user()->name ?: Auth::user()->name_bn}}@else {{Auth::user()->name_bn ?: Auth::user()->name}}@endif</h5>
                        <div class="text-muted mb-2">
                            @if(config('app.locale') == 'en')
                            {{Auth::user()->roles()->pluck('name')->first() ?: Auth::user()->roles()->pluck('name_bn')->first() }}
                            @else
                            {{Auth::user()->roles()->pluck('name_bn')->first() ?: Auth::user()->roles()->pluck('name')->first() }}
                            @endif
                        </div>

                        {{-- <div>
                            <a class="btn btn-primary btn-sm" href="#">Follow</a>
                            <a class="btn btn-primary btn-sm" href="#"><span data-feather="message-square"></span> Message</a>
                        </div> --}}
                    </div>
                    <hr class="my-0" />
                    <div class="card-body d-none">
                        <h5 class="h6 card-title">Skills</h5>
                        <a href="#" class="badge bg-primary me-1 my-1">HTML</a>
                        <a href="#" class="badge bg-primary me-1 my-1">JavaScript</a>
                        <a href="#" class="badge bg-primary me-1 my-1">Sass</a>
                        <a href="#" class="badge bg-primary me-1 my-1">Angular</a>
                        <a href="#" class="badge bg-primary me-1 my-1">Vue</a>
                        <a href="#" class="badge bg-primary me-1 my-1">React</a>
                        <a href="#" class="badge bg-primary me-1 my-1">Redux</a>
                        <a href="#" class="badge bg-primary me-1 my-1">UI</a>
                        <a href="#" class="badge bg-primary me-1 my-1">UX</a>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body d-none">
                        <h5 class="h6 card-title">About</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> Lives in <a href="#">San Francisco, SA</a>
                            </li>

                            <li class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span> Works at <a href="#">GitHub</a></li>
                            <li class="mb-1"><span data-feather="map-pin" class="feather-sm me-1"></span> From <a href="#">Boston</a></li>
                        </ul>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body d-none">
                        <h5 class="h6 card-title">Elsewhere</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1"><span class="fas fa-globe fa-fw me-1"></span> <a href="#">staciehall.co</a></li>
                            <li class="mb-1"><span class="fab fa-twitter fa-fw me-1"></span> <a href="#">Twitter</a></li>
                            <li class="mb-1"><span class="fab fa-facebook fa-fw me-1"></span> <a href="#">Facebook</a></li>
                            <li class="mb-1"><span class="fab fa-instagram fa-fw me-1"></span> <a href="#">Instagram</a></li>
                            <li class="mb-1"><span class="fab fa-linkedin fa-fw me-1"></span> <a href="#">LinkedIn</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            @php
            Use App\Traits\Date;
            @endphp
            <div class="col-md-8 col-xl-9">
                <div class="card">
                    <div class="card-header">

                        <h5 class="card-title mb-0">@lang('common.activities')</h5>
                    </div>
                    <div class="card-body h-100">
                        @foreach ($data['activities'] as $ac)


                        <div class="d-flex align-items-start
                        @if($ac->activity == 'create')
                         bg-success
                         @elseif($ac->activity == 'edit')
                         bg-info
                         @elseif($ac->activity == 'destroy')
                         bg-warning
                         @elseif($ac->activity == 'restore')
                         bg-primary
                         @elseif($ac->activity == 'delete')
                         bg-danger
                         @elseif($ac->activity == 'login')
                         bg-success
                         @elseif($ac->activity == 'change_status')
                         bg-secondary
                         @elseif($ac->activity == 'permission')
                         bg-info
                         @endif
                          text-white p-3">
                            @php
                            $path2 = public_path().'/Backend/profile/'.$ac->activityBy->profile;

                            @endphp
                            @if(file_exists($path2))
                            <img src="{{asset('Backend/profile')}}/{{$ac->activityBy->profile}}" width="36" height="36" class="rounded-circle me-2" alt="{{$ac->activityBy->name}}">
                            @else
                            <img src="{{asset('Backend')}}/img/avatars/user_avatar.png" width="36" height="36" class="rounded-circle me-2" alt="{{Auth::user()->name}}">
                            @endif
                            <div class="flex-grow-1">
                                <strong>
                                    @if(config('app.locale') == 'en')
                                    @if(Auth::user()->id == $ac->activityBy->id)
                                    @lang('common.you')
                                    @else
                                    {{$ac->activityBy->name ?: $ac->activityBy->name_bn}}
                                    @endif


                                    @else

                                    @if(Auth::user()->id == $ac->activityBy->id)
                                    @lang('common.you')
                                    @else
                                    {{$ac->activityBy->name_bn ?: $ac->activityBy->name}}
                                    @endif

                                    @endif
                                </strong>
                                    @if(config('app.locale') == 'en')
                                    {{$ac->description_en ?: $ac->description_bn}}
                                    @else
                                    {{$ac->description_bn ?: $ac->description_en}}
                                    @endif
                                <strong>




                                </strong>
                                <br />
                                <small class="text-light">
                                    @if(date('Y-m-d') == $ac->date)
                                    @lang('common.today')
                                    @else
                                    {{Date::DbToOriginal('-',$ac->date)}}
                                    @endif
                                    , {{Date::twelveHrTime($ac->time)}}
                                </small> <br />

                            </div>
                        </div>
                        <hr />
                        @endforeach
                        <div class="d-grid">
                            {{ $data['activities']->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">@lang('user.crop_image')</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="image_demo" style="width : 350px;margin-top:30px;">

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('common.close')</button>
          <button type="button" class="btn btn-primary crop_image">@lang('common.save_now')</button>
        </div>
      </div>
    </div>
  </div>


<div class="modal fade" id="Takephoto" tabindex="-1" aria-labelledby="takePhotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="takePhotoModalLabel">@lang('user.take_photo')</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="Webcam.reset()"></button>
        </div>
        <form method="POST" action="{{ route('user.image_update') }}">
        <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div id="my_camera"></div>
                        <br/>
                        <button type="button" onclick="take_snapshot()" class="btn btn-info"><i class="fa fa-camera"></i></button>
                        <input type="hidden" name="image" class="image-tag">
                        <input type="hidden" name="type" value="camera">
                    </div>
                    <div class="col-md-6">
                        <div id="results">@lang('user.yout_cap_image')</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="Webcam.reset()">@lang('common.close')</button>
                <button type="submit" class="btn btn-primary">@lang('common.save_now')</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  {{-- <script>
    $(document).ready(function() {
        $('#myIcon').click(function () {
            $('#Takephoto').modal('show');
            // Webcam.attach( '#my_camera' );
        });
    });
</script> --}}

<script>
    function modalCameraOpen()
    {
        // $('#Takephoto').modal('show');

    }
</script>
@push('footer_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js"></script>



<script language="JavaScript">
    Webcam.set({
        width: 400,
        height: 400,
        image_format: 'jpeg',
        jpeg_quality: 90
    });

    // Webcam.attach( '#my_camera' );
    // preload shutter audio clip
    var shutter = new Audio();
    // shutter.autoplay = true;
    shutter.src = navigator.userAgent.match(/Firefox/) ? '/shutter.ogg' : '/shutter.mp3';
    function take_snapshot() {
        shutter.play();
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }
</script>
    <script>
        $image_crop = $('#image_demo').croppie({
            enableExif: true,
        viewport: {
            width:400,
            height:400,
            type:'square' //circle
        },
        boundary:{
            width:500,
            height:500
        },
        enableOrientation: true,
        mouseWheelZoom: 'ctrl',
        // enableZoom: false,

    });
    // $image_crop.croppie 'setZoom', 0.5;
    $('#profile').on('change',function(){
        var reader = new FileReader();

        reader.onload = function (event) {
            $image_crop.croppie('bind', {
                url: event.target.result
            });
        }
        reader.readAsDataURL(this.files[0]);
        $('#exampleModal').modal('show');

    });
    $('.crop_image').click(function(event){
        var loading = '<div class="spinner-border text-dark me-2" role="status"><span class="visually-hidden">Loading...</span></div>';
        $image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function(response){
            $.ajax({
                headers : {
                    'X-CSRF-TOKEN' : '{{csrf_token()}}'
                },
                url: '{{ route('user.image_update') }}',
                type:'POST',
                data: {'image': response},
                beforeSend:function($data)
                {
                    $('.modal-body').html(loading);
                },
                success:function(data){
                    $('#exampleModal').modal('hide');
                    location. reload()
                }
            })
        });
    });
    </script>

@endpush

@endsection
