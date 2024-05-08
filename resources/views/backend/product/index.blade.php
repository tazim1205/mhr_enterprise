@extends('backend.layouts.master')
@section('body')

<link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

<main class="content">
    <div class="container-fluid p-0">

    @component('components.beardcrumb')

    {{-- /*Page Title Goese Here in this slot variable*/ --}}
    @slot('title')
    @lang('product.index_title')
    @endslot


    {{-- /* Create New Route Will Be goes here */ --}}
    @slot('route_name')
    product.create
    @endslot
    @slot('btn_class')
    btn btn-primary
    @endslot
    @slot('icon')
    fa fa-plus
    @endslot
    @slot('btn_name')
    @lang('product.create_new')
    @endslot
   
    @endcomponent
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-bordered mb-3">
                            <li class="nav-item">
                                <a href="#users-tab-all" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                    @lang('common.all')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#users-tab-deleted" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                    @lang('common.deleted_list')
                                </a>
                            </li>
                        </ul> <!-- end nav-->
                        <div class="tab-content">
                            <div class="tab-pane show active" id="users-tab-all">
                                <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>@lang('common.sl')</th>
                                            <th>@lang('categorie.cat_name')</th>
                                            <th>@lang('sub_categorie.sub_cat_name')</th>
                                            <th>@lang('product.product_name')</th>
                                            <th>@lang('product.reguler_price')</th>
                                            <th>@lang('product.discount_amount')</th>
                                            <th>@lang('product.status')</th>
                                            <th>@lang('common.actions')</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div> <!-- end all-->
                            <div class="tab-pane" id="users-tab-deleted">
                                @php
                                use App\Models\product;
                                use App\Models\categorie;
                                use App\Models\sub_categorie;
                                $data = product::onlyTrashed()->get();
                                $sl = 1;
                                @endphp
                                <table id="alternative-page-datatable" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>@lang('common.sl')</th>
                                            <th>@lang('categorie.cat_name')</th>
                                            <th>@lang('sub_categorie.sub_cat_name')</th>
                                            <th>@lang('product.product_name')</th>
                                            <th>@lang('product.reguler_price')</th>
                                            <th>@lang('product.discount_amount')</th>
                                            <th>@lang('common.actions')</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if($data)
                                        @foreach ($data as $v)
                                        <tr>
                                            <td>{{$sl++}}</td>
                                            <td>@if($v->cat_id > 0)

                                                @php
                                                $cat_info = categorie::where('id',$v->cat_id)->first();
                                                @endphp

                                                @if(config('app.locale') == 'en') {{$cat_info->cat_name_en}} @elseif(config('app.locale') == 'en') {{$cat_info->cat_name_bn}} @endif

                                                @endif
                                            </td>
                                            <td>@if($v->sub_cat_id > 0)

                                                @php
                                                $sub_cat_info = sub_categorie::where('id',$v->sub_cat_id)->first();
                                                @endphp

                                                @if(config('app.locale') == 'en') {{$sub_cat_info->sub_cat_name_en}} @elseif(config('app.locale') == 'en') {{$sub_cat_info->sub_cat_name_bn}} @endif

                                                @endif
                                            </td>
                                            <td>
                                                @if(config('app.locale') == 'en') {{$v->product_name_en}} @elseif(config('app.locale') == 'en') {{$v->product_name_bn}} @endif
                                            </td>
                                            <td>{{$v->regular_price}}</td>
                                            <td>{{$v->discount_amount}}</td>
                                            <td>
                                                <a onclick="return confirmation();" class="btn btn-warning btn-sm" href="{{url('retrive_product')}}/{{$v->id}}"><i class="fa fa-repeat"></i></a>
                                                <a onclick="return confirmation();" class="btn btn-danger btn-sm" href="{{url('product_per_delete')}}/{{$v->id}}"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div> <!-- end deleted-->
                        </div> <!-- end tab-content-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@push('footer_script')

<script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Datatables Responsive
        $("#datatables-reponsive").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('product.index') }}",
            columns: [
                {data: 'sl', name: 'sl'},
                {data: 'cat_id', name: 'cat_id'},
                {data: 'sub_cat_id', name: 'sub_cat_id'},
                {data: 'product_name', name: 'product_name'},
                {data: 'regular_price', name: 'regular_price'},
                {data: 'discount_amount', name: 'discount_amount'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>

<script>

    function productStatusChange(id)
    {
        // alert(id);

        if(id > 0)
        {
            var message = @json( __('product.status_message') );
            var message_type = @json(__('common.success'));
            $.ajax({
                header : {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },

                url : '{{ url('productStatusChange') }}/'+id,

                type : 'GET',

                success : function(data)
                {
                    toastr.success(message, message_type);
                }
            });
        }
    }

</script>
@endpush

@endsection
