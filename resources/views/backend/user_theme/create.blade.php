@extends('backend.layouts.master')
@section('body')
<main class="content">
    <div class="container-fluid p-0">

        @component('components.beardcrumb')

        {{-- /*Page Title Goese Here in this slot variable*/ --}}
        @slot('title')
        @lang('user_theme.create_title')
        @endslot

        @endcomponent
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('user_theme.update',$data['theme']->id)}}" method="post" enctype="multipart/form-data" id="formData">
                            @csrf
                            @method('PUT')
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                <label for="">@lang('user_theme.color_scheme')</label><span class="text-danger">*</span>
                                <div class="row mt-2">
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <label for="default" style="display:block;">
                                        <div class="mx-1 d-block mb-1">
                                            <input type="radio" class="settings-scheme-label" name="theme" value="default" id="default" @if($data['theme']->theme == 'default') checked @endif>
                                            <div class="settings-scheme">
                                                <div class="settings-scheme-theme settings-scheme-theme-default">

                                                </div>
                                            </div>
                                            <div class="text-center">
                                                @lang('user_theme.default')
                                            </div>
                                        </div>
                                        </label>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <label for="colored" style="display:block;">
                                        <div class="mx-1 d-block mb-1">
                                            <input type="radio" class="settings-scheme-label" name="theme" value="colored"  id="colored" @if($data['theme']->theme == 'colored') checked @endif>
                                            <div class="settings-scheme">
                                                <div class="settings-scheme-theme settings-scheme-theme-colored">

                                                </div>
                                            </div>
                                            <div class="text-center">
                                                @lang('user_theme.colored')
                                            </div>
                                        </div>
                                        </label>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <label for="dark" style="display:block;">
                                        <div class="mx-1 d-block mb-1">
                                            <input type="radio" class="settings-scheme-label" name="theme" value="dark" id="dark" @if($data['theme']->theme == 'dark') checked @endif>
                                            <div class="settings-scheme">
                                                <div class="settings-scheme-theme settings-scheme-theme-dark">

                                                </div>
                                            </div>
                                            <div class="text-center">
                                                @lang('user_theme.dark')
                                            </div>
                                        </div>
                                        </label>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <label for="light" style="display:block;">
                                        <div class="mx-1 d-block mb-1">
                                                <input type="radio" class="settings-scheme-label" name="theme" value="light" id="light" @if($data['theme']->theme == 'light') checked @endif>
                                                <div class="settings-scheme">
                                                    <div class="settings-scheme-theme settings-scheme-theme-light">

                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    @lang('user_theme.light')
                                                </div>
                                            </div>
                                        </label>
                                    </div>

                                </div>

                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mt-2">
                                <label>@lang('user_theme.sidebar_layout')</label>
                                <div>
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" value="default" name="sidebar_layout" id="sidebar_layout" @if($data['theme']->sidebar_layout == 'default') checked @endif>
                                        <span class="form-check-label" id="">
                                            @lang('user_theme.sidebar_default')
                                        </span>
                                    </label>
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" value="compact" name="sidebar_layout" id="sidebar_layout"  @if($data['theme']->sidebar_layout == 'compact') checked @endif>
                                        <span class="form-check-label" id="">
                                            @lang('user_theme.compact')
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mt-2">
                                <label>@lang('user_theme.sidebar_position')</label>
                                <div>
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" value="left" name="sidebar_position" id="sidebar_position" @if($data['theme']->sidebar_position == 'left') checked @endif>
                                        <span class="form-check-label" id="">
                                            @lang('user_theme.left')
                                        </span>
                                    </label>
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" value="right" name="sidebar_position" id="sidebar_position"  @if($data['theme']->sidebar_position == 'right') checked @endif>
                                        <span class="form-check-label" id="" >
                                            @lang('user_theme.right')
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mt-2">
                                <label>@lang('user_theme.layout')</label>
                                <div>
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" value="fluid" name="layout" id="layout" @if($data['theme']->layout == 'fluid') checked @endif>
                                        <span class="form-check-label" id="">
                                            @lang('user_theme.fluid')
                                        </span>
                                    </label>
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" value="boxed" name="layout" id="layout" @if($data['theme']->layout == 'boxed') checked @endif>
                                        <span class="form-check-label" id=""  >
                                            @lang('user_theme.boxed')
                                        </span>
                                    </label>
                                </div>
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

@push('footer_script')
{{-- <script>
    $('.settings-scheme-theme-default').on('click',function(e){
        alert('default');
        $('input#settings-scheme-theme-default').prop('checked',true);

    });
    $('.settings-scheme-theme-dark').on('click',function(e){
        alert('dark');

        $('input#settings-scheme-theme-dark').prop('checked',true);

    });
    $('.settings-scheme-theme-colored').on('click',function(e){
        alert('colored');

        $('input#settings-scheme-theme-colored').prop('checked',true);

    });
    $('.settings-scheme-theme-light').on('click',function(e){
        alert('light');

        $('input#settings-scheme-theme-light').prop('checked',true);
    });
</script> --}}
{{-- <script>
    $('.settings-scheme-theme').on('click',function(e){
        alert();
    });
</script> --}}
@endpush

@endsection
