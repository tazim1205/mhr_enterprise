@extends('backend.layouts.master')
@section('body')
<main class="content">
    <div class="container-fluid p-0">


        @component('components.beardcrumb')

        {{-- /*Page Title Goese Here in this slot variable*/ --}}
        @slot('title')
        @lang('shipping.create_title')
        @endslot
        
        {{-- /* Create New Route Will Be goes here */ --}}
        @slot('route_name')
        shipping.index
        @endslot
        @slot('btn_class')
        btn btn-primary
        @endslot
        @slot('icon')
        fa fa-eye
        @endslot
        @slot('btn_name')
        @lang('shipping.view')
        @endslot


        @endcomponent
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('shipping.store')}}" method="post" enctype="multipart/form-data" id="formData">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12 mt-2">
                                    <label for="division_id">@lang('shipping.division_name') </label><span class="text-danger">*</span>
                                    <select class="form-control" name="division_id" id="division_id" onchange="return GetDistrict()" required>
                                        <option value="">@lang('common.select_one') </option>
                                        @if($division)
                                        @foreach($division as $v)
                                        <option value="{{$v->id}}">{{$v->division_name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @error('division_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-12 mt-2">
                                    <label for="district_id">@lang('shipping.district_name') </label><span class="text-danger">*</span>
                                    <select class="form-control" name="district_id" id="district_id" onchange="return GetUpazila()" required>
                                        <option value="">@lang('common.select_one') </option>
                                    
                                    </select>
                                    @error('district_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-12 mt-2">
                                    <label for="upazila_id">@lang('shipping.upazila_name') </label><span class="text-danger">*</span>
                                    <select class="form-control" name="upazila_id" id="upazila_id" required>
                                        <option value="">@lang('common.select_one') </option>
                                        
                                    </select>
                                    @error('upazila_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
                                    <label for="charge">@lang('shipping.charge') </label><span class="text-danger">*</span>
                                    <input type="text" name="charge" class="form-control  mt-1 @error('charge') is-invalid @enderror" id="charge" value="{{old('charge')}}" required>
                                    @error('charge')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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

    function GetDistrict()
    {
        let division_id = $('#division_id').val();

        if(division_id != "")
        {
            $.ajax({
                headers : {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },

                url : '{{url('GetDistrict')}}/'+division_id,

                type : 'GET',
                
                success : function(data)
                {
                     $('#district_id').html(data);
                }
            })
        }
        else{
            let html = '';
            alert('Select Division');
            $('#district_id').html(html);
        }


    }

    function GetUpazila()
    {
        let division_id = $('#division_id').val();
        let district_id = $('#district_id').val();

        if(district_id != "" && division_id != "")
        {
            $.ajax({
                headers : {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },

                url : '{{url('GetUpazila')}}/'+district_id,

                type : 'GET',
                
                success : function(data)
                {
                    $('#upazila_id').html(data);
                }
            })
        }
        else{
            let html = '';
            alert('Select District');
            $('#upazila_id').html(html);
        }


    }

</script>

@endsection
