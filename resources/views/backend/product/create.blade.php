@extends('backend.layouts.master')
@section('body')
<main class="content">
    <div class="container-fluid p-0">


        @component('components.beardcrumb')

        {{-- /*Page Title Goese Here in this slot variable*/ --}}
        @slot('title')
        @lang('product.create_title')
        @endslot
        
        {{-- /* Create New Route Will Be goes here */ --}}
        @slot('route_name')
        product.index
        @endslot
        @slot('btn_class')
        btn btn-primary
        @endslot
        @slot('icon')
        fa fa-eye
        @endslot
        @slot('btn_name')
        @lang('product.view')
        @endslot


        @endcomponent
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data" id="formData">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12 mt-2">
                                    <label for="cat_id">@lang('product.categorie') </label><span class="text-danger">*</span>
                                    <select class="form-control" name="cat_id" required id="cat_id" onchange="return GetSubCategorie()">
                                        <option>@lang('common.select_one') </option>
                                        @if($cat_name)
                                        @foreach($cat_name as $v)
                                        <option value="{{$v->id}}">@if(config('app.locale') == 'en'){{$v->cat_name_en}}
                                            @elseif(config('app.locale') == 'bn'){{$v->cat_name_bn}}@endif</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @error('cat_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-12 mt-2">
                                    <label for="sub_cat_id">@lang('product.sub_categorie') </label><span class="text-danger">*</span>
                                    <select class="form-control" name="sub_cat_id" id="sub_cat_id" required>
                                        <option value="">@lang('common.select_one') </option>
            
                                    </select>
                                    @error('cat_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
                                    <label for="product_name_en">@lang('product.product_name_en')</label><span class="text-danger">*</span>
                                    <input type="text" name="product_name_en" class="form-control  mt-1 @error('product_name_en') is-invalid @enderror" id="product_name_en" value="{{old('product_name_en')}}" required>
                                    @error('product_name_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
                                    <label for="product_name_bn">@lang('product.product_name_bn')</label>
                                    <input type="text" name="product_name_bn" class="form-control  mt-1  @error('product_name_bn') is-invalid @enderror" id="product_name_bn" value="{{old('product_name_bn')}}">
                                    @error('product_name_bn')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
                                    <label for="regular_price">@lang('product.reguler_price')</label>
                                    <input type="text" name="regular_price" class="form-control  mt-1  @error('regular_price') is-invalid @enderror" id="regular_price" value="{{old('regular_price')}}">
                                    @error('regular_price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
                                    <label for="discount_amount">@lang('product.discount_amount')</label>
                                    <input type="text" name="discount_amount" class="form-control  mt-1  @error('discount_amount') is-invalid @enderror" id="discount_amount" value="{{old('discount_amount')}}">
                                    @error('discount_amount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
                                    <label for="min_quantity">@lang('product.min_quantity')</label>
                                    <input type="text" name="min_quantity" class="form-control mt-1  @error('min_quantity') is-invalid @enderror" id="min_quantity" value="{{old('min_quantity')}}">
                                    @error('min_quantity')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
                                    <label for="short_details">@lang('product.short_details')</label>
                                    <textarea type="text" name="short_details" class="form-control mt-1  @error('short_details') is-invalid @enderror" id="short_details" value="{{old('short_details')}}"></textarea>
                                    @error('short_details')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
                                    <label for="description">@lang('product.description')</label>
                                    <textarea type="text" name="description" class="form-control mt-1  @error('description') is-invalid @enderror" id="description" value="{{old('description')}}"></textarea>
                                    @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
                                    <label for="information">@lang('product.information')</label>
                                    <textarea type="text" name="information" class="form-control  mt-1  @error('information') is-invalid @enderror" id="information" value="{{old('information')}}"></textarea>
                                    @error('information')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
                                    <label for="size">@lang('size_setting.size_name')</label>
                                    <div class="row">
                                        @if($size)
                                        @foreach($size as $v)
                                            <div class="checkbox form-check col-lg-3 col-md-4 col-sm-6">
                                                <label>
                                                    <input type="checkbox" name="size[]" value="{{$v->id}}">
                                                    @if(config('app.locale') == 'en')
                                                    {{$v->size_name_en}}
                                                    @else
                                                    {{$v->size_name_bn}}
                                                    @endif
                                                </label>
                                            </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
                                    <label for="color">@lang('color.color_name')</label>
                                    <div class="row">
                                        @if($color)
                                        @foreach($color as $v)
                                            <div class="checkbox form-check col-lg-3 col-md-4 col-sm-6">
                                                <label>
                                                    <input type="checkbox" name="color[]" value="{{$v->id}}">
                                                    {{$v->color_name_en}}
                                                </label>
                                            </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12 mt-2">
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
                                <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                    <label for="image">@lang('product.image')</label>
                                    <input type="file" class="form-control" name="image[]" multiple>
                                    @error('min_quantity')
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

@push('footer_script')
<script>

    function GetSubCategorie()
    {
        let cat_id = $('#cat_id').val();

        // alert(cat_id);

        if(cat_id != "")
        {
            $.ajax({
                headers : {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },

                url : '{{url('GetSubCategorie')}}/'+cat_id,

                type : 'GET',
                
                success : function(data)
                {
                    // alert(data);
                    $('#sub_cat_id').html(data);
                }
            })
        }
        else{
            let html = '';
            alert('Select Categorie');
            $('#sub_cat_id').html(html);
        }


    }

</script>
@endpush

@endsection
