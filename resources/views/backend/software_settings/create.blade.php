@extends('backend.layouts.master')
@section('body')
<main class="content">
    <div class="container-fluid p-0">

        @component('components.beardcrumb')

        {{-- /*Page Title Goese Here in this slot variable*/ --}}
        @slot('title')
        @lang('software_info.create_title')
        @endslot

        @if(Auth::user()->can('Software Info index'))
        {{-- /* Create New Route Will Be goes here */ --}}
        @slot('route_name')
        software_info.index
        @endslot
        @slot('btn_class')
        btn btn-primary
        @endslot
        @slot('icon')
        fa fa-eye
        @endslot
        @slot('btn_name')
        @lang('software_info.view')
        @endslot

        @endif

        @endcomponent
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('software_info.update',$data->id)}}" method="post" enctype="multipart/form-data" id="formData">
                            @csrf
                            @method('PUT')
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12 mt-2">
                                <label for="logo">@lang('software_info.logo')</label><br>
                                <div style="text-align: center;">
                                    @php
                                    $logo = public_path().'/Backend/settings/'.$data->logo;
                                    @endphp
                                    @if(file_exists($logo))
                                    <img src="{{asset('Backend/settings')}}/{{$data->logo}}" alt="logo" class="img-fluid" style="height: 80px;width:90px;">
                                    @endif
                                </div>
                                <input type="file" name="logo" class="form-control  mt-1 @error('logo') is-invalid @enderror" id="logo" value="{{old('logo')}}">
                                @error('logo')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 mt-2">
                                <label for="favicon">@lang('software_info.favicon')</label><br>
                                <div style="text-align: center;">
                                    @php
                                    $favicon = public_path().'/Backend/settings/'.$data->favicon;
                                    @endphp
                                    @if(file_exists($favicon))
                                    <img src="{{asset('Backend/settings')}}/{{$data->favicon}}" alt="favicon" class="img-fluid" style="height: 80px;width:90px;">
                                    @endif
                                </div>
                                <input type="file" name="favicon" class="form-control  mt-1 @error('favicon') is-invalid @enderror" id="logo" value="{{old('logo')}}">
                                @error('favicon')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                <label for="title_en">@lang('software_info.title_en')</label><span class="text-danger">*</span>
                                <input type="text" name="title_en" class="form-control  mt-1 @error('title_en') is-invalid @enderror" id="title_en" value="{{$data->title_en}}">
                                @error('title_en')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                <label for="title_bn">@lang('software_info.title_bn')</label>
                                <input type="text" name="title_bn" class="form-control  mt-1" id="title_bn" value="{{$data->title_bn}}">
                            </div>
                            <div class="col-12 mt-4" style="text-align: right">
                                <button type="submit" id="submit" class="btn  btn-success"> <i class="fa fa-save"></i> @lang('common.update')</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

{{-- @push('footer_script')
<script>

    $('#formData').submit(function(e){
        e.preventDefault();
        let formData = $('#formData').serialize();
        $.ajax({
            headers : {
                'X-CSRF-TOKEN' : '{{ csrf_token() }}'
            },
            url : '{{route('menu_label.store')}}',
            type : 'POST',
            data : formData,
            success : function(response)
            {

            },
            error: function (xhr) {
            $.each(xhr.responseJSON.errors, function(key,value) {
                $('#error_'+key).html(value);
                $('input#'+key).addClass('is-invalid');
            });
            },
        });
    });

</script>
@endpush --}}

@endsection
