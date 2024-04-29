@extends('backend.layouts.master')
@section('body')
<main class="content">
    <div class="container-fluid p-0">

    @component('components.beardcrumb')

    {{-- /*Page Title Goese Here in this slot variable*/ --}}
    @slot('title')
    @lang('user_order.index_title')
    @endslot
    
    {{-- for deleted list index --}}
    @slot('deleted_list_btn_name')
    @lang('user_order.deleted_list')
    @endslot

    @slot('deleted_list_route')
    create.trash_list
    @endslot

   

    @endcomponent
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>@lang('common.sl')</th>
                                    <th>@lang('user_order.user_name')</th>
                                    <th>@lang('user_order.mobile')</th>
                                    <th>@lang('user_order.product_info')</th>
                                    <th>@lang('shipping.division_name')</th>
                                    <th>@lang('shipping.district_name')</th>
                                    <th>@lang('user_order.address')</th>
                                    <th>@lang('user_order.total')</th>
                                    <th>@lang('common.status')</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@push('footer_script')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Datatables Responsive
            $("#datatables-reponsive").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('user_order') }}",
                columns: [
                {data: 'sl', name: 'sl'},
                {data: 'name', name: 'name'},
                {data: 'mobile', name: 'mobile'},
                {data: 'product_info', name: 'product_info'},
                {data: 'division_id', name: 'division_id'},
                {data: 'district_id', name: 'district_id'},
                {data: 'address', name: 'address'},
                {data: 'total', name: 'total'},
                {data: 'status', name: 'status', orderable: false, searchable: false},
            ]
            });
        });
    </script>

@endpush

@endsection
