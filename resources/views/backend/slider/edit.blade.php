@extends('backend.layouts.master')
@section('body')
<main class="content">
    <div class="container-fluid p-0">


        @component('components.beardcrumb')

        {{-- /*Page Title Goese Here in this slot variable*/ --}}
        @slot('title')
        @lang('slider.create_title')
        @endslot


        {{-- /* Create New Route Will Be goes here */ --}}
        @slot('route_name')
        slider.index
        @endslot
        @slot('btn_class')
        btn btn-primary
        @endslot
        @slot('icon')
        fa fa-eye
        @endslot
        @slot('btn_name')
        @lang('slider.view')
        @endslot


        @endcomponent
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('slider.update',$data->id)}}" method="post" enctype="multipart/form-data" id="formData">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                    <label for="title">@lang('slider.title_en')</label><span class="text-danger">*</span>
                                    <input type="text" name="title" class="form-control  mt-1 @error('title') is-invalid @enderror" id="title" value="{{$data->title}}" required>
                                    @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                    <label for="title_bn">@lang('slider.title_bn')</label>
                                    <input type="text" name="title_bn" class="form-control  mt-1  @error('title_bn') is-invalid @enderror" id="title_bn" value="{{$data->title_bn}}" required>
                                    @error('title_bn')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                    <label for="image">@lang('slider.image')</label>
                                    <input type="file" name="image" class="form-control  mt-1  @error('image') is-invalid @enderror" id="image">
                                    <img src="{{ asset($data->image) }}" style="max-height: 100px;">
                                    @error('image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mt-2">
                                    <label for="slider">@lang('slider.slider')</label><span class="text-danger">*</span>
                                    <div>
                                        <label class="form-check">
                                            <input class="form-check-input"  type="checkbox" value="1" <?php if ($data->slider == 1) {
                                        echo "checked";} ?> name="slider" id="slider">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mt-2">
                                    <label for="status">@lang('common.status')</label><span class="text-danger">*</span>
                                    <div>
                                        <label class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="active" value="1" checked @if($data->status == 1) checked @endif />
                                            <span class="form-check-label">
                                                @lang('common.active')
                                            </span>
                                        </label>
                                        <label class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="inactive" value="0" @if($data->status == 0) checked @endif/> 
                                        <span class="form-check-label">
                                                @lang('common.inactive')
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
