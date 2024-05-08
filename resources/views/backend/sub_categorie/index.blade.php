@extends('backend.layouts.master')
@section('body')

<link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

<main class="content">
    <div class="container-fluid p-0">

    @component('components.beardcrumb')

    {{-- /*Page Title Goese Here in this slot variable*/ --}}
    @slot('title')
    @lang('sub_categorie.index_title')
    @endslot

    {{-- /* Create New Route Will Be goes here */ --}}
    @slot('route_name')
    sub_categorie.create
    @endslot
    @slot('btn_class')
    btn btn-primary
    @endslot
    @slot('icon')
    fa fa-plus
    @endslot
    @slot('btn_name')
    @lang('sub_categorie.create_new')
    @endslot

    {{-- for deleted list index --}}
    @slot('deleted_list_btn_name')
    @lang('sub_categorie.deleted_list')
    @endslot

    @slot('deleted_list_route')
    create.trash_list
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
                                            <th>@lang('categorie.order_by')</th>
                                            <th>@lang('common.status')</th>
                                            <th>@lang('common.actions')</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div> <!-- end all-->
                            <div class="tab-pane" id="users-tab-deleted">
                                @php
                                use App\Models\sub_categorie;
                                use App\Models\categorie;
                                $data=  sub_categorie::onlyTrashed()->get();
                                $sl=1;
                                @endphp

                                <table id="alternative-page-datatable" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>@lang('common.sl')</th>
                                            <th>@lang('categorie.cat_name')</th>
                                            <th>@lang('sub_categorie.sub_cat_name')</th>
                                            <th>@lang('categorie.order_by')</th>
                                            <th>@lang('common.actions')</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if($data)
                                        @foreach ($data as $v)
                                        <tr>
                                            <td>{{$sl++}}</td>
                                            <td>
                                            @if($v->cat_id > 0)

                                                @php
                                                $cat_info = categorie::where('id',$v->cat_id)->first();
                                                @endphp
                                                @if(config('app.locale') == 'en') {{$cat_info->cat_name_en}} @elseif(config('app.locale') == 'en') {{$cat_info->cat_name_bn}} @endif
                                            @endif
                                            </td>
                                            <td>
                                                @if(config('app.locale') == 'en') {{$v->sub_cat_name_en}} @elseif(config('app.locale') == 'en') {{$v->sub_cat_name_bn}} @endif
                                            </td>
                                            <td>
                                                {{$v->order_by}}
                                            </td>
                                            <td>
                                                <a onclick="return confirmation();" class="btn btn-warning btn-sm" href="{{url('retrive_subcategorie')}}/{{$v->id}}"><i class="fa fa-repeat"></i></a>
                                                <a onclick="return confirmation();" class="btn btn-danger btn-sm" href="{{url('subcategorie_per_delete')}}/{{$v->id}}"><i class="fa fa-trash"></i></a>
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
            ajax: "{{ route('sub_categorie.index') }}",
            columns: [
                {data: 'sl', name: 'sl'},
                {data: 'categorie', name: 'categorie'},
                {data: 'sub_categorie_name', name: 'sub_categorie_name'},
                {data: 'order_by', name: 'order_by'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>

<script>

    function subcategorieStatusChange(id)
    {
        // alert(id);

        if(id > 0)
        {
            var message = @json( __('sub_categorie.status_message') );
            var message_type = @json(__('common.success'));
            $.ajax({
                header : {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },

                url : '{{ url('subcategorieStatusChange') }}/'+id,

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
