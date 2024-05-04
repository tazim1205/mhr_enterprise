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
        @php 
        use App\Models\product_size_info;
        use App\Models\product_color_info;
        @endphp
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('product.update',$data->id)}}" method="post" enctype="multipart/form-data" id="formData">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12 mt-2">
                                    <label for="cat_id">@lang('product.categorie') </label><span class="text-danger">*</span>
                                    <select class="form-control" name="cat_id" required id="cat_id" onchange="return GetSubCategorie()">
                                        <option value="">@lang('common.select_one') </option>
                                        @if($cat_name)
                                        @foreach($cat_name as $v)
                                        <option value="{{$v->id}}" @if($data->cat_id == $v->id) selected @endif>
                                            @if(config('app.locale') == 'en'){{$v->cat_name_en}}
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
                                    <select class="form-control" name="sub_cat_id" required id="sub_cat_id">
                                        <option value="" >@lang('common.select_one') </option>
                                        @if($sub_categorie)
                                        @foreach($sub_categorie as $v)
                                        <option value="{{$v->id}}" @if($data->sub_cat_id == $v->id) selected @endif>
                                                @if(config('app.locale') == 'en'){{$v->sub_cat_name_en}}
                                                @elseif(config('app.locale') == 'bn'){{$v->sub_cat_name_bn}}@endif</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @error('sub_cat_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
                                    <label for="product_name_en">@lang('product.product_name_en')</label><span class="text-danger">*</span>
                                    <input type="text" name="product_name_en" class="form-control  mt-1 @error('product_name_en') is-invalid @enderror" id="product_name_en" value="{{$data->product_name_en}}" required>
                                    @error('product_name_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
                                    <label for="product_name_bn">@lang('product.product_name_bn')</label>
                                    <input type="text" name="product_name_bn" class="form-control  mt-1  @error('product_name_bn') is-invalid @enderror" id="product_name_bn" value="{{$data->product_name_bn}}">
                                    @error('product_name_bn')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
                                    <label for="regular_price">@lang('product.reguler_price')</label>
                                    <input type="text" name="regular_price" class="form-control  mt-1  @error('regular_price') is-invalid @enderror" id="regular_price" value="{{$data->regular_price}}">
                                    @error('regular_price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
                                    <label for="discount_amount">@lang('product.discount_amount')</label>
                                    <input type="text" name="discount_amount" class="form-control  mt-1  @error('discount_amount') is-invalid @enderror" id="discount_amount" value="{{$data->discount_amount}}">
                                    @error('discount_amount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
                                    <label for="min_quantity">@lang('product.min_quantity')</label>
                                    <input type="text" name="min_quantity" class="form-control mt-1  @error('min_quantity') is-invalid @enderror" id="min_quantity" value="{{$data->min_quantity}}">
                                    @error('min_quantity')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
                                    <label for="short_details">@lang('product.short_details')</label>
                                    <textarea type="text" name="short_details" class="form-control mt-1  @error('short_details') is-invalid @enderror" id="short_details">{{$data->short_details}}</textarea>
                                    @error('short_details')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
                                    <label for="description">@lang('product.description')</label>
                                    <textarea type="text" name="description" class="form-control mt-1  @error('description') is-invalid @enderror" id="description">{{$data->description}}</textarea>
                                    @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
                                    <label for="information">@lang('product.information')</label>
                                    <textarea type="text" name="information" class="form-control  mt-1  @error('information') is-invalid @enderror" id="information">{{$data->information}}</textarea>
                                    @error('information')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
                                    <label for="size">@lang('size_setting.size_name')</label>
                                    <div class="row">
                                        @if($size)
                                        @foreach($size as $v)
                                        @php
                                        $check = product_size_info::where('size_id',$v->id)->where('product_id',$product_id)->first();
                                        if($check)
                                        {
                                            $checkSizeId = $check->size_id;
                                        }
                                        else
                                        {
                                            $checkSizeId = NULL;
                                        }
                                        @endphp
                                            <div class="checkbox form-check col-lg-3 col-md-4 col-sm-6">
                                                <label>
                                                    <input @if($checkSizeId == $v->id) checked @endif type="checkbox" name="size[]" value="{{$v->id}}">
                                                    @if(config('app.locale') == 'en'){{$v->size_name_en}}
                                                    @elseif(config('app.locale') == 'bn'){{$v->size_name_bn}}@endif
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
                                        @php 
                                        $checkColor = product_color_info::where('product_id',$product_id)->where('color_id',$v->id)->first();
                                        if($checkColor)
                                        {
                                            $checkColorId = $checkColor->color_id;
                                        }
                                        else
                                        {
                                            $checkColorId = NULL;
                                        }
                                        @endphp
                                            <div class="checkbox form-check col-lg-3 col-md-4 col-sm-6">
                                                <label>
                                                    <input @if($checkColorId == $v->id) checked @endif type="checkbox" name="color[]" value="{{$v->id}}">
                                                    @if(config('app.locale') == 'en'){{$v->color_name_en}}
                                                    @elseif(config('app.locale') == 'bn'){{$v->color_name_bn}}@endif
                                                </label>
                                            </div>
                                        @endforeach
                                        @endif
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
                                <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                    <label for="image">@lang('product.image')</label>
                                    <input type="file" class="form-control" name="image[]" multiple>
                                    @error('image')
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

@endsection
