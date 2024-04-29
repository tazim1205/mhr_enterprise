@extends('backend.layouts.master')
@section('body')
<main class="content">
    <div class="container-fluid p-0">


        @component('components.beardcrumb')

        {{-- /*Page Title Goese Here in this slot variable*/ --}}
        @slot('title')
        @lang('sub_categorie.create_title')
        @endslot

        {{-- /* Create New Route Will Be goes here */ --}}
        @slot('route_name')
        sub_categorie.index
        @endslot
        @slot('btn_class')
        btn btn-primary
        @endslot
        @slot('icon')
        fa fa-eye
        @endslot
        @slot('btn_name')
        @lang('sub_categorie.view')
        @endslot

        @endcomponent
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('sub_categorie.update',$data->id)}}" method="post" enctype="multipart/form-data" id="formData">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12 mt-2">
                                    <label for="cat_id">@lang('categorie.cat_name')</label><span class="text-danger">*</span>
                                    <select class="form-control" name="cat_id" required>
                                        <option>@lang('common.select_one') </option>
                                        @if($categorie_data)
                                        @foreach($categorie_data as $v)
                                        <option value="{{$v->id}}" @if($data->cat_id == $v->id) selected @endif>
                                            @if(config('app.locale') == 'en'){{$v->cat_name_en}}
                                            @elseif(config('app.locale') == 'en'){{$v->cat_name_bn}}@endif</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @error('cat_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
                                    <label for="sub_cat_name_en">@lang('sub_categorie.sub_cat_name_en')</label>
                                    <input type="text" name="sub_cat_name_en" class="form-control  mt-1  @error('sub_cat_name_en') is-invalid @enderror" id="sub_cat_name_en" value="{{$data->sub_cat_name_en}}" required>
                                    @error('sub_cat_name_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
                                    <label for="sub_cat_name_bn">@lang('sub_categorie.sub_cat_name_bn')</label>
                                    <input type="text" name="sub_cat_name_bn" class="form-control  mt-1  @error('sub_cat_name_bn') is-invalid @enderror" id="sub_cat_name_bn" value="{{$data->sub_cat_name_bn}}" required>
                                    @error('sub_cat_name_bn')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
                                    <label for="order_by">@lang('sub_categorie.order_by')</label><span class="text-danger">*</span>
                                    <input type="text" name="order_by" class="form-control  mt-1 @error('order_by') is-invalid @enderror" id="order_by" value="{{$data->order_by}}" required>
                                    @error('order_by')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-12 mt-2">
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
