@extends('backend.layouts.master')
@section('body')

<link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

<main class="content">
    <div class="container-fluid p-0">

    @component('components.beardcrumb')

    {{-- /*Page Title Goese Here in this slot variable*/ --}}
    @slot('title')
    @lang('price_range.index_title')
    @endslot


    {{-- /* Create New Route Will Be goes here */ --}}
    @slot('route_name')
    price_range.create
    @endslot
    @slot('btn_class')
    btn btn-primary
    @endslot
    @slot('icon')
    fa fa-plus
    @endslot
    @slot('btn_name')
    @lang('price_range.create_new')
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
                                            <th>@lang('price_range.from')</th>
                                            <th>@lang('price_range.to')</th>
                                            <th>@lang('price_range.order_by')</th>
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
                                use App\Models\price_range;
                                $data=  price_range::onlyTrashed()->get();
                                $sl=1;
                                @endphp

                                <table id="alternative-page-datatable" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>@lang('common.sl')</th>
                                            <th>@lang('price_range.from')</th>
                                            <th>@lang('price_range.to')</th>
                                            <th>@lang('price_range.order_by')</th>
                                            <th>@lang('common.actions')</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if($data)
                                        @foreach ($data as $v)
                                        <tr>
                                            <td>{{$sl++}}</td>
                                            <td>
                                                {{$v->from}}
                                            </td>
                                            <td>
                                                {{$v->to}}
                                            </td>
                                            <td>
                                                {{$v->order_by}}
                                            </td>
                                            <td>
                                                <a onclick="return confirmation();" class="btn btn-warning btn-sm" href="{{url('retrive_price_range')}}/{{$v->id}}"><i class="fa fa-repeat"></i></a>
                                                <a onclick="return confirmation();" class="btn btn-danger btn-sm" href="{{url('price_range_per_delete')}}/{{$v->id}}"><i class="fa fa-trash"></i></a>
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
            ajax: "{{ route('price_range.index') }}",
            columns: [
                {data: 'sl', name: 'sl'},
                {data: 'from', name: 'from'},
                {data: 'to', name: 'to'},
                {data: 'order_by', name: 'order_by'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>

<script>

    function pricerangeStatusChange(id)
    {
        // alert(id);

        if(id > 0)
        {
            var message = @json( __('price_range.status_message') );
            var message_type = @json(__('common.success'));
            $.ajax({
                header : {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },

                url : '{{ url('pricerangeStatusChange') }}/'+id,

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
