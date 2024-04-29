@extends('backend.layouts.master')
@section('body')
<main class="content">
    <div class="container-fluid p-0">

        @component('components.beardcrumb')

        {{-- /*Page Title Goese Here in this slot variable*/ --}}
        @slot('title')
        @lang('user.create_title')
        @endslot

        @if(Auth::user()->can('Admin index'))
        {{-- /* Create New Route Will Be goes here */ --}}
        @slot('route_name')
        user.index
        @endslot
        @slot('btn_class')
        btn btn-primary
        @endslot
        @slot('icon')
        fa fa-eye
        @endslot
        @slot('btn_name')
        @lang('user.view')
        @endslot

        @endif

        @endcomponent
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data" id="formData">
                            @csrf
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-12 mt-2">
                                <label for="branch_id">@lang('user.branch')</label><span class="text-danger">*</span>
                                <select class="form-control choices-single @error('branch_id') is-invalid @enderror" name="branch_id" id="branch_id">
                                    <option value="">@lang('common.select_one')</option>
                                    @foreach ($data['branch'] as $b)
                                    <option @if(old('branch_id') == $b->id) selected @endif value="{{$b->id}}">@if(config('app.locale') == 'en') {{$b->branch_name_en ?: $b->branch_name_bn}} @else {{$b->branch_name_bn ?: $b->branch_name_en}} @endif</option>
                                    @endforeach
                                </select>
                                @error('branch_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mt-2">
                                <label for="role_id">@lang('user.select_role')</label><span class="text-danger">*</span>
                                <select class="form-control choices-single3 @error('role_id') is-invalid @enderror" name="role_id" id="role_id">
                                    <option value="">@lang('common.select_one')</option>
                                    @foreach ($data['role'] as $r)
                                    <option @if(old('role_id') == $r->id) selected @endif value="{{$r->id}}">@if(config('app.locale') == 'en') {{$r->name ?: $r->name_bn}} @else {{$r->name_bn ?: $r->name}} @endif</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 mt-2">
                                <label for="user_name_en">@lang('user.user_name_en')</label><span class="text-danger">*</span>
                                <input type="text" name="user_name_en" class="form-control  mt-1 @error('user_name_en') is-invalid @enderror" id="user_name_en" value="{{old('user_name_en')}}">
                                @error('user_name_en')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 mt-2">
                                <label for="user_name_bn">@lang('user.user_name_bn')</label>
                                <input type="text" name="user_name_bn" class="form-control  mt-1 @error('user_name_bn') is-invalid @enderror" id="user_name_bn" value="{{old('user_name_bn')}}">
                                @error('user_name_bn')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 mt-2">
                                <label for="email">@lang('user.email')</label><span class="text-danger">*</span>
                                <input type="text" name="email" class="form-control  mt-1 @error('email') is-invalid @enderror" id="email" value="{{old('email')}}">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 mt-2">
                                <label for="phone">@lang('user.phone')</label><span class="text-danger">*</span>
                                <input type="text" name="phone" class="form-control  mt-1 @error('phone') is-invalid @enderror" id="phone" value="{{old('phone')}}" maxlength="11">
                                @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mt-2">
                                <label for="gender">@lang('user.gender')</label><span class="text-danger">*</span>
                                <select class="form-control choices-single2 @error('gender') is-invalid @enderror" name="gender" id="gender">
                                    <option @if(old('gender') == 'Male') selected @endif value="Male">@lang('common.male')</option>
                                    <option @if(old('gender') == 'Female') selected @endif value="Female">@lang('common.female')</option>
                                </select>
                                @error('gender')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 mt-2">
                                <label for="password">@lang('user.password') (@lang('user.eight_digit'))</label><span class="text-danger">*</span>
                                <input type="text" name="password" class="form-control  mt-1 @error('password') is-invalid @enderror" id="password" value="{{old('password')}}">
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mt-4" style="text-align: right">
                                <button type="submit" id="submit" class="btn  btn-success"> <i class="fa fa-save"></i> @lang('common.save_now')</button>
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
