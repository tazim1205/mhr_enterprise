@extends('backend.layouts.master')
@section('body')
<main class="content">
    <div class="container-fluid p-0">

        @component('components.beardcrumb')

        {{-- /*Page Title Goese Here in this slot variable*/ --}}
        @slot('title')
        @lang('user.index_title')
        @endslot

        @if(Auth::user()->can('Admin create'))

        {{-- /* Create New Route Will Be goes here */ --}}
        @slot('route_name')
        user.create
        @endslot
        @slot('btn_class')
        btn btn-primary
        @endslot
        @slot('icon')
        fa fa-plus
        @endslot
        @slot('btn_name')
        @lang('user.create_new')
        @endslot

        @endif

        @if(Auth::user()->can('Admin trash'))
        {{-- for deleted list index --}}
        @slot('deleted_list_btn_name')
        @lang('user.deleted_list')
        @endslot
        @slot('deleted_list_route')
        user.trash_list
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
                                    <th>@lang('user.profile')</th>
                                    <th>@lang('user.role')</th>
                                    <th>@lang('user.name')</th>
                                    <th>@lang('user.phone')</th>
                                    <th>@lang('user.email')</th>
                                    <th>@lang('user.gender')</th>
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
            ajax: "{{ route('user.index') }}",
            columns: [
                {data: 'sl', name: 'sl'},
                {
                    data: 'profile', name: 'profile',

                },
                {data: 'role', name: 'role'},
                {data: 'name', name: 'name'},
                {data: 'phone', name: 'phone'},
                {data: 'email', name: 'email'},
                {data: 'gender', name: 'gender'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
{{--
<script>

    $('#formData').submit(function(e){
        e.preventDefault();
        let formData = $('#formData').serialize();
        $.ajax({
            headers : {
                'X-CSRF-TOKEN' : '{{ csrf_token() }}'
            },
            url : '{{route('menu_label.store')}}',
            type : 'POST',
            data : formData,
            success : function(response)
            {

            },
            error: function (xhr) {
            $.each(xhr.responseJSON.errors, function(key,value) {
                $('#error_'+key).html(value);
                $('input#'+key).addClass('is-invalid');
            });
            },
        });
    });

</script>
--}}
@endpush

@endsection
