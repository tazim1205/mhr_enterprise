@extends('backend.layouts.master')
@section('body')
<main class="content">
    <div class="container-fluid p-0">

    @component('components.beardcrumb')

    {{-- /*Page Title Goese Here in this slot variable*/ --}}
    @slot('title')
    @lang('color.index_title')
    @endslot


    {{-- /* Create New Route Will Be goes here */ --}}
    @slot('route_name')
    color.create
    @endslot
    @slot('btn_class')
    btn btn-primary
    @endslot
    @slot('icon')
    fa fa-plus
    @endslot
    @slot('btn_name')
    @lang('color.create_new')
    @endslot

    
    {{-- for deleted list index --}}
    @slot('deleted_list_btn_name')
    @lang('color.deleted_list')
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
                                    <th>@lang('color.color_name')</th>
                                    <th>@lang('color.order_by')</th>
                                    <th>@lang('common.status')</th>
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
            ajax: "{{ route('color.index') }}",
            columns: [
                {data: 'sl', name: 'sl'},
                {data: 'color_name', name: 'color_name'},
                {data: 'order_by', name: 'order_by'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>

<script>

    function colorStatusChange(id)
    {
        // alert(id);

        if(id > 0)
        {
            var message = @json( __('color.status_message') );
            var message_type = @json(__('common.success'));
            $.ajax({
                header : {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },

                url : '{{ url('colorStatusChange') }}/'+id,

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
