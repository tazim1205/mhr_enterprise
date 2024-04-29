@extends('backend.layouts.master')
@section('body')
<main class="content">
    <div class="container-fluid p-0">

        @component('components.beardcrumb')

        {{-- /*Page Title Goese Here in this slot variable*/ --}}
        @slot('title')
        @lang('menu.trash_title')
        @endslot

        @if(Auth::user()->can('Menu index'))
        {{-- /* Create New Route Will Be goes here */ --}}
        @slot('route_name')
        menu.index
        @endslot
        @slot('btn_class')
        btn btn-primary
        @endslot
        @slot('icon')
        fa fa-eye
        @endslot
        @slot('btn_name')
        @lang('menu.view')
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
                                    <th>@lang('menu.menu_name')</th>
                                    <th>@lang('menu.type')</th>
                                    <th>@lang('menu.route_name')</th>
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
            ajax: "{{ route('menu.trash_list') }}",
            columns: [
                {data: 'sl', name: 'sl'},
                {data: 'label', name: 'label'},
                {data: 'menu_name', name: 'menu_name'},
                {data: 'type', name: 'type'},
                {data: 'route', name: 'route'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>



@endpush

@endsection
