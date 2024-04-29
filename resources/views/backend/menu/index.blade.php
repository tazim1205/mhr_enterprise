@extends('backend.layouts.master')
@section('body')
<main class="content">
    <div class="container-fluid p-0">

        @component('components.beardcrumb')

        {{-- /*Page Title Goese Here in this slot variable*/ --}}
        @slot('title')
        @lang('menu.index_title')
        @endslot

        @if(Auth::user()->can('Menu create'))
        {{-- /* Create New Route Will Be goes here */ --}}
        @slot('route_name')
        menu.create
        @endslot
        @slot('btn_class')
        btn btn-primary
        @endslot
        @slot('icon')
        fa fa-plus
        @endslot
        @slot('btn_name')
        @lang('menu.create_new')
        @endslot

        @endif

        @if(Auth::user()->can('Menu trash'))
        {{-- for deleted list index --}}
        @slot('deleted_list_btn_name')
        @lang('menu.deleted_list')
        @endslot

        @slot('deleted_list_route')
        menu.trash_list
        @endslot
        @endif

        @endcomponent
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>@lang('common.sl')</th>
                                    <th>@lang('menu.label')</th>
                                    <th>@lang('menu.parent')</th>
                                    <th>@lang('menu.menu_name')</th>
                                    <th>@lang('menu.type')</th>
                                    <th>@lang('menu.route_name')</th>
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
            ajax: "{{ route('menu.index') }}",
            columns: [
                {data: 'sl', name: 'sl'},
                {data: 'label', name: 'label'},
                {data: 'parent_name', name: 'parent_name'},
                {data: 'menu_name', name: 'menu_name'},
                {data: 'type', name: 'type'},
                {data: 'route', name: 'route'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>

<script>

    function ChangeMenuStatus(id)
    {
        $.ajax({
            headers : {
                'X-CSRF-TOKEN' : '{{csrf_token()}}'
            },
            url : "{{route('menu.status')}}",
            type : 'POST',
            data: {id},
            beforeSend : function(){

            },
            success : function(response)
            {
                window.notyf.open({
                    type: "success",
                    message: @json(__('menu.staus_message')),
                    duration: 1000,
                    ripple: true,
                    dismissible: false,
                    position: {
                        x: "right",
                        y: "top"
                    }
                    });
            }
        })
    }

</script>

@endpush

@endsection
