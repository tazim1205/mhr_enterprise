@extends('backend.layouts.master')
@section('body')
<main class="content">
    <div class="container-fluid p-0">


        @component('components.beardcrumb')

        {{-- /*Page Title Goese Here in this slot variable*/ --}}
        @slot('title')
        @lang('about_us.create_title')
        @endslot

        @endcomponent
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('about_us.store')}}" method="post" enctype="multipart/form-data" id="formData">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                    <label for="title_en">@lang('about_us.title_en')</label><span class="text-danger">*</span>
                                    <input type="text" name="title_en" class="form-control  mt-1 @error('title_en') is-invalid @enderror" id="title_en" value="{{$data->title_en}}" required>
                                    @error('title_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                    <label for="title_bn">@lang('about_us.title_bn')</label>
                                    <input type="text" name="title_bn" class="form-control  mt-1  @error('title_bn') is-invalid @enderror" id="title_bn" value="{{$data->title_bn}}" required>
                                    @error('title_bn')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                    <label for="description">@lang('about_us.description')</label><span class="text-danger">*</span>
                                    <textarea class="form-control" name="description" rows="6">{{ $data->description }}</textarea>
                                    @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                    <label for="image">@lang('product.image')</label>
                                    <input type="file"  class="form-control" name="image">
                                    <img src="{{ asset('backend/img/about_us/')}}/{{ $data->image }}" width="90px" height="100px" class="mt-3">
                                    @error('image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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


@endsection
