@extends('backend.layouts.master')
@section('body')
<main class="content">
    <div class="container-fluid p-0">

    @component('components.beardcrumb')

    {{-- /*Page Title Goese Here in this slot variable*/ --}}
    @slot('title')
    @lang('trend.product_trend_title')
    @endslot


    {{-- /* Create New Route Will Be goes here */ --}}
    @slot('route_name')
    add_product_to_trend.create
    @endslot
    @slot('btn_class')
    btn btn-primary
    @endslot
    @slot('icon')
    fa fa-plus
    @endslot
    @slot('btn_name')
    @lang('add_product_to_trend.create_new')
    @endslot

    
    {{-- for deleted list index --}}
    @slot('deleted_list_btn_name')
    @lang('add_product_to_trend.deleted_list')
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
                                    <th>@lang('categorie.cat_name')</th>
                                    <th>@lang('trend.trend_name')</th>
                                    <th>@lang('common.status')</th>
                                    <th>@lang('common.action')</th>
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
            ajax: "{{ route('add_product_to_trend.index') }}",
            columns: [
              {data: 'sl', name: 'sl'},
              {data: 'cat_id', name: 'cat_id'},
              {data: 'trend_id', name: 'trend_id'},
              {data: 'status', name: 'status'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
        });
    });
</script>
@endpush

@endsection
