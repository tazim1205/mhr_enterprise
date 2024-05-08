@extends('backend.layouts.master')
@section('body')

<link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

<main class="content">
    <div class="container-fluid p-0">

    @component('components.beardcrumb')

    {{-- /*Page Title Goese Here in this slot variable*/ --}}
    @slot('title')
    @lang('shipping.index_title')
    @endslot

    {{-- /* Create New Route Will Be goes here */ --}}
    @slot('route_name')
    shipping.create
    @endslot
    @slot('btn_class')
    btn btn-primary
    @endslot
    @slot('icon')
    fa fa-plus
    @endslot
    @slot('btn_name')
    @lang('shipping.create_new')
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
                                            <th>@lang('shipping.division_name')</th>
                                            <th>@lang('shipping.district_name')</th>
                                            <th>@lang('shipping.upazila_name')</th>
                                            <th>@lang('shipping.charge')</th>
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
                                use App\Models\shipping;
                                use App\Models\division_information;
                                use App\Models\district_information;
                                use App\Models\upazila_information;
                                $data = shipping::onlyTrashed()->get();
                                $sl = 1;
                                @endphp

                                <table id="alternative-page-datatable" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>@lang('common.sl')</th>
                                            <th>@lang('shipping.division_name')</th>
                                            <th>@lang('shipping.district_name')</th>
                                            <th>@lang('shipping.upazila_name')</th>
                                            <th>@lang('shipping.charge')</th>
                                            <th>@lang('common.actions')</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if($data)
                                        @foreach ($data as $v)
                                        <tr>
                                            <td>{{$sl++}}</td>
                                            <td>@if($v->division_id > 0)

                                                @php
                                                $div_info = division_information::where('id',$v->division_id)->first();
                                                @endphp

                                                {{$div_info->division_name}}

                                                @endif
                                            </td>
                                            <td>@if($v->district_id > 0)

                                                @php
                                                $dis_info = district_information::where('id',$v->district_id)->first();
                                                @endphp

                                                {{$dis_info->district_name}}

                                                @endif
                                            </td>
                                            <td>@if($v->upazila_id > 0)

                                                @php
                                                $upazila_info = upazila_information::where('id',$v->upazila_id)->first();
                                                @endphp

                                                {{$upazila_info->upazila_name}}

                                                @endif
                                            </td>
                                            <td>{{$v->charge}}</td>
                                            <td>
                                                <a onclick="return confirmation();" class="btn btn-warning btn-sm" href="{{url('retrive_shipping')}}/{{$v->id}}"><i class="fa fa-repeat"></i></a>
                                                <a onclick="return confirmation();" class="btn btn-danger btn-sm" href="{{url('shipping_per_delete')}}/{{$v->id}}"><i class="fa fa-trash"></i></a>
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
            ajax: "{{ route('shipping.index') }}",
            columns: [
                {data: 'sl', name: 'sl'},
                {data: 'division_id', name: 'division_id'},
                {data: 'district_id', name: 'district_id'},
                {data: 'upazila_id', name: 'upazila_id'},
                {data: 'charge', name: 'charge'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>

<script>

    function shippingStatusChange(id)
    {
        if(id > 0)
        {
            var message = @json( __('shipping.status_message') );
            var message_type = @json(__('common.success'));
            $.ajax({
                header : {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },

                url : '{{ url('shippingStatusChange') }}/'+id,

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
