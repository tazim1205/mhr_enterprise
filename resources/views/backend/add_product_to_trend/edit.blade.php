@extends('backend.layouts.master')
@section('body')
<main class="content">
    <div class="container-fluid p-0">


        @component('components.beardcrumb')

        {{-- /*Page Title Goese Here in this slot variable*/ --}}
        @slot('title')
        @lang('add_product_to_trend.edit_title')
        @endslot


        {{-- /* Create New Route Will Be goes here */ --}}
        @slot('route_name')
        add_product_to_trend.index
        @endslot
        @slot('btn_class')
        btn btn-primary
        @endslot
        @slot('icon')
        fa fa-eye
        @endslot
        @slot('btn_name')
        @lang('add_product_to_trend.view')
        @endslot


        @endcomponent
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('add_product_to_trend.update',$data->id)}}" method="post" enctype="multipart/form-data" id="formData">
                            @csrf
                            @method('PUT')
                            <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12 mt-2">
                                    <label for="title">@lang('categorie.cat_name') </label><span class="text-danger">*</span>
                                    <select class="form-control" id="cat_id" name="cat_id" onchange="return GetSelectProduct()" required>
                                        <option>@lang('common.select_one') </option>
                                        @if($categorie)
                                        @foreach($categorie as $v)
                                        <option value="{{$v->id}}" @if($v->id == $data->cat_id) selected @endif>@if(config('app.locale') == 'en'){{$v->cat_name_en}}
                                            @elseif(config('app.locale') == 'en'){{$v->cat_name_bn}}@endif</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                    <label for="product_data" class="form-label ">@lang("product.product_name")<span class="text-danger">*</span></label>
                                    <div id="product_data" class="mt-3">

                                    </div>
                                    @error('product_data')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-6 col-12" id="inputSingleBox">
                                    <div>
                                        <label for="defaultFormControlInput" class="form-label">@lang('trend.trend_name') <span class="text-danger">*</span></label>
                                        <select class="form-control" id="trend_id" name="trend_id" required>
                                            <option>@lang('common.select_one') </option>
                                            @if($trend_name)
                                            @foreach($trend_name as $v)
                                            <option value="{{$v->id}}" @if($v->id == $data->trend_id) selected @endif>@if(config('app.locale') == 'en'){{$v->trend_name_en}}
                                                @elseif(config('app.locale') == 'en'){{$v->trend_name_bn}}@endif</option>
                                            @endforeach
                                            @endif
                                        </select>
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

<script>

    $(document).ready(function(){
        GetSelectProduct();
    })

    function GetSelectProduct()
    {
        let cat_id = $('#cat_id').val();

        //  alert(cat_id);

        if(cat_id != "")
        {
            $.ajax({
                headers : {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },

                url : '{{url('GetSelectProduct')}}/'+cat_id,

                type : 'GET',
                
                success : function(data)
                {
                    // alert(data);
                    $('#product_data').html(data);
                }
            })
        }
        else{
            let html = '';
            alert('Select Categorie');
            $('#product_data').html(html);
        }


    }

</script>

@endsection
