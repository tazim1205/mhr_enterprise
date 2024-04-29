@extends('backend.layouts.master')
@section('body')
<main class="content">
    <div class="container-fluid p-0">

        @component('components.beardcrumb')

        {{-- /*Page Title Goese Here in this slot variable*/ --}}
        @slot('title')
        @lang('menu_label.edit_title')
        @endslot

        @if(Auth::user()->can('Menu Label index'))
        {{-- /* Create New Route Will Be goes here */ --}}
        @slot('route_name')
        menu_label.index
        @endslot
        @slot('btn_class')
        btn btn-primary
        @endslot
        @slot('icon')
        fa fa-eye
        @endslot
        @slot('btn_name')
        @lang('menu_label.view')
        @endslot

        @endif

        @endcomponent
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('menu_label.update',$data->id)}}" method="post" enctype="multipart/form-data" id="formData">
                            @csrf
                            @method('PUT')
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                <label for="order_by">@lang('common.sl')</label><span class="text-danger">*</span>
                                <input type="number" name="order_by" class="form-control  mt-1 @error('order_by') is-invalid @enderror" id="order_by" value="{{$data->order_by}}">
                                @error('order_by')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                <label for="label_name_en">@lang('menu_label.label_name_en')</label><span class="text-danger">*</span>
                                <input type="text" name="label_name_en" class="form-control  mt-1 @error('label_name_en') is-invalid @enderror" id="label_name_en" value="{{$data->label_name_en}}">
                                @error('label_name_en')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                <label for="label_name_bn">@lang('menu_label.label_name_bn')</label>
                                <input type="text" name="label_name_bn" class="form-control  mt-1" id="label_name_bn" value="{{$data->label_name_bn}}">
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
