@extends('backend.layouts.master')
@section('body')
<main class="content">
    <div class="container-fluid p-0">

        @component('components.beardcrumb')

        {{-- /*Page Title Goese Here in this slot variable*/ --}}
        @slot('title')
        @lang('menu.permission_title')
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
                                    <th>@lang('menu.menu_name')</th>
                                    <th>@lang('menu.permission_name')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($data)
                                @foreach ($data as $v)
                                <tr>
                                    <td>
                                        {{$sl++}}
                                    </td>
                                    <td>
                                        {{$menu->menu_name_en}}
                                    </td>
                                    <td>{{$v->name}}</td>
                                </tr>
                                @endforeach
                                @endif
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
        // Datatables Responsive
        $("#datatables-reponsive").DataTable({

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

            }
        })
    }

</script>

@endpush

@endsection
