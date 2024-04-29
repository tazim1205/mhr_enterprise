@extends('backend.layouts.master')
@section('body')
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

    
    {{-- for deleted list index --}}
    @slot('deleted_list_btn_name')
    @lang('product.deleted_list')
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
                                    <th>@lang('sub_categorie.sub_cat_name')</th>
                                    <th>@lang('product.product_name')</th>
                                    <th>@lang('product.reguler_price')</th>
                                    <th>@lang('product.discount_amount')</th>
                                    <th>@lang('product.image')</th>
                                    <th>@lang('common.actions')</th>
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
