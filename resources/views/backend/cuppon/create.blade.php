@extends('backend.layouts.master')
@section('body')
<main class="content">
    <div class="container-fluid p-0">


        @component('components.beardcrumb')

        {{-- /*Page Title Goese Here in this slot variable*/ --}}
        @slot('title')
        @lang('cuppon.create_title')
        @endslot

        {{-- /* Create New Route Will Be goes here */ --}}
        @slot('route_name')
        cuppon.index
        @endslot
        @slot('btn_class')
        btn btn-primary
        @endslot
        @slot('icon')
        fa fa-eye
        @endslot
        @slot('btn_name')
        @lang('cuppon.view')
        @endslot

        @endcomponent
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('cuppon.store')}}" method="post" enctype="multipart/form-data" id="formData">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                    <label for="cuppon_code">@lang('cuppon.cuppon_code')</label><span class="text-danger">*</span>
                                    <input type="text" name="cuppon_code" class="form-control  mt-1 @error('cuppon_code') is-invalid @enderror" id="cuppon_code" value="{{old('cuppon_code')}}" required>
                                    @error('cuppon_code')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                    <label for="discount_amount">@lang('cuppon.discount_amount')</label><span class="text-danger">*</span>
                                    <input type="text" name="discount_amount" class="form-control  mt-1  @error('discount_amount') is-invalid @enderror" id="discount_amount" value="{{old('discount_amount')}}" required>
                                    @error('discount_amount')
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
