@extends('backend.layouts.master')
@section('body')
<main class="content">
    <div class="container-fluid p-0">

        @component('components.beardcrumb')
        @slot('title')
        @lang('menu.create_title')
        @endslot


        @if(Auth::user()->can('Menu index'))
        {{-- /*Page Title Goese Here in this slot variable*/ --}}
        @slot('route_name')
        menu.index
        @endslot
        @slot('btn_class')
        btn btn-primary
        @endslot
        @slot('icon')
        fa fa-eye
        @endslot
        @slot('btn_name')
        @lang('menu.view')
        @endslot
        @endif

        @endcomponent
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('menu.store')}}" method="post" enctype="multipart/form-data" id="formData">
                            @csrf
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-12 mt-2">
                                <label for="label_id">@lang('menu.menu_label')</label>
                                <select class="form-control choices-single label_id @error('label_id') is-invalid @enderror" name="label_id" id="label_id">
                                    <option value="">@lang('common.select_one')</option>
                                    @foreach ($data['menu_label'] as $v)
                                    <option @if(old('label_id') == $v->id) selected @endif value="{{$v->id}}">@if(config('app.locale') == 'en') {{$v->label_name_en ?: $v->label_name_bn}}@else {{$v->label_name_bn ?: $v->laTbel_name_en}} @endif</option>
                                    @endforeach
                                </select>
                                @error('label_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mt-2">
                                <label for="parent_id">@lang('menu.select_parent')</label>
                                <select class="form-control choices-single2 parent_id @error('parent_id') is-invalid @enderror" name="parent_id" id="parent_id">
                                    <option value="">@lang('common.select_one')</option>
                                    @foreach ($data['parent_menu'] as $pm)
                                    <option @if(old('parent_id') == $pm->id) selected @endif value="{{$pm->id}}">@if(config('app.locale') == 'en') {{$pm->menu_name_en ?: $pm->menu_name_bn}}@else {{$pm->menu_name_bn ?: $pm->menu_name_en}} @endif</option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mt-2">
                                <label for="menu_name_en">@lang('menu.menu_name_en')</label><span class="text-danger">*</span>
                                <input type="text" name="menu_name_en" class="form-control  mt-1 @error('menu_name_en') is-invalid @enderror" id="menu_name_en" value="{{old('menu_name_en')}}">
                                @error('menu_name_en')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mt-2">
                                <label for="menu_name_bn">@lang('menu.menu_name_bn')</label>
                                <input type="text" name="menu_name_bn" class="form-control  mt-1 @error('menu_name_bn') is-invalid @enderror" id="menu_name_bn" value="{{old('menu_name_bn')}}">
                                @error('menu_name_bn')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mt-2">
                                <label for="system_name">@lang('menu.system_name')</label>
                                <input type="text" name="system_name" class="form-control  mt-1 @error('system_name') is-invalid @enderror" id="system_name" value="{{old('system_name')}}">
                                @error('system_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mt-2">
                                <label for="route">@lang('menu.route_name')</label>
                                <input type="text" name="route" class="form-control  mt-1 @error('route') is-invalid @enderror" id="route" value="{{old('route')}}">
                                @error('route')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mt-2">
                                <label for="slug">@lang('menu.slug')</label>
                                <input type="text" name="slug" class="form-control  mt-1 @error('slug') is-invalid @enderror" id="slug" value="{{old('slug')}}">
                                @error('slug')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mt-2">
                                <label for="icon">@lang('menu.icon')</label>
                                <input type="text" name="icon" class="form-control  mt-1 @error('icon') is-invalid @enderror" id="icon" value="{{old('icon')}}">
                                @error('icon')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mt-2">
                                <label for="order_by">@lang('menu.order_by')</label><span class="text-danger">*</span>
                                <input type="text" name="order_by" class="form-control  mt-1 @error('order_by') is-invalid @enderror" id="order_by" value="{{old('order_by')}}">
                                @error('order_by')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mt-2">
                                <label for="status">@lang('common.status')</label><span class="text-danger">*</span>
                                <div>
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" value="1" name="status" checked>
                                        <span class="form-check-label">
                                            @lang('common.active')
                                        </span>
                                    </label>
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" value="0" name="status">
                                        <span class="form-check-label">
                                            @lang('common.inactive')
                                        </span>
                                    </label>

                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mt-2">
                                <label for="type">@lang('menu.type')</label><span class="text-danger">*</span>
                                <div>
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" value="1" name="type" id="type" checked>
                                        <span class="form-check-label" id="">
                                            @lang('menu.parent')
                                        </span>
                                    </label>
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" value="2" name="type" id="type">
                                        <span class="form-check-label" id="">
                                            @lang('menu.module')
                                        </span>
                                    </label>
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" value="3" name="type" id="type">
                                        <span class="form-check-label" id="">
                                            @lang('menu.single')
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <h3>@lang('menu.permissions')</h3>
                                <hr>
                                <div class="row">
                                    @foreach ($data['menu_actions'] as $ma)
                                    <div class="col-lg-3 col-md-4 col-6 mt-2">
                                        <label class="form-check">
                                            <input class="form-check-input permission" type="checkbox" value="{{$ma->slug}}" name="permissions[]" >
                                            <span class="form-check-label">
                                                @if(config('app.locale') == 'en'){{$ma->name_en}}@else {{$ma->name_bn}}@endif
                                            </span>
                                        </label>
                                    </div>
                                    @endforeach
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
<script>
    $(document).ready(function(){

        $(document).on('click','#type',function(){
            let type = $('input[name="type"]:checked').val();
            //    alert(type);
            if(type != 1)
            {
                $('.permission').prop("checked" , true);
            }
            else
            {
                $('.permission').prop("checked" , false);
            }
        });
    });


    $(document).on('click','#type',function(){
       let type = $('input[name="type"]:checked').val();
    //    alert(type);
    if(type != 1)
    {
        $('.permission').prop("checked" , true);
    }
    else
    {
        $('.permission').prop("checked" , false);

    }
    });
</script>
@endpush

@endsection
