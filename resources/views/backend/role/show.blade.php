@extends('backend.layouts.master')
@section('body')
<main class="content">
    <div class="container-fluid p-0">

        @component('components.beardcrumb')

        {{-- /*Page Title Goese Here in this slot variable*/ --}}
        @slot('title')
        @if(config('app.locale') == 'en')
        {{$data['role']->name ?: $data['role']->name_bn}}
        @else
        {{$data['role']->name_bn ?: $data['role']->name}}
        @endif
        @endslot


        @if(Auth::user()->can('Role create'))
        {{-- /* Create New Route Will Be goes here */ --}}
        @slot('route_name')
        role.create
        @endslot
        @slot('btn_class')
        btn btn-primary
        @endslot
        @slot('icon')
        fa fa-plus
        @endslot
        @slot('btn_name')
        @lang('role.create_new')
        @endslot

        @endif

        @endcomponent
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{route('role.permission',$data['role']->id)}}">
                            @csrf
                            <div>
                                <label class="form-check">
                                    <input class="form-check-input select_all" type="checkbox" value="" name="" id="select_all" onclick="return selectAll()">
                                    <span class="form-check-label">
                                        @lang('common.select_all')
                                    </span>
                                </label>
                            </div>
                            {{-- <hr> --}}
                            @if($data['menus'])
                            @foreach ($data['menus'] as $v)
                            <div class="col-lg-12 mt-2 p-2" style="border:1px solid rgb(235, 235, 235);">
                                <b>
                                    @if(config('app.locale') == 'en')
                                    {{$v->menu_name_en ?: $v->menu_name_bn}}
                                    @else
                                    {{$v->menu_name_bn ?: $v->menu_name_en}}
                                    @endif
                                </b>
                                <hr>
                                @php
                                $permission = Spatie\Permission\Models\Permission::where('parent',$v->system_name)->get();
                                @endphp
                                <div class="row">
                                    @if($permission)
                                    @foreach ($permission as $p)
                                    @php
                                    $permission_id = DB::table('role_has_permissions')->where('role_id',$data['role']->id)->where('permission_id',$p->id)->pluck('permission_id')->first();
                                    @endphp
                                    <div class="col-lg-3 col-md-6 col-6">
                                        <label class="form-check">
                                            <input class="form-check-input permission" type="checkbox" value="{{$p->id}}" name="permissions[]" id="" @if($permission_id == $p->id) checked @endif>
                                            <span class="form-check-label">
                                                {{$p->name}}
                                            </span>
                                        </label>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                            @endforeach
                            @endif
                            <div class="col-12 mt-2" style="text-align: right">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> @lang('common.save_now')</button>
                            </div>
                        </form>
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
            ajax: "{{ route('role.index') }}",
            columns: [
                {data: 'sl', name: 'sl'},
                {data: 'role_name', name: 'role_name'},
                {data: 'permission', name: 'permission'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>

<script>

    function selectAll()
    {
        if($('#select_all').is(':checked'))
        {
            $('input.permission').prop('checked',true);
        }
        else
        {
            $('input.permission').prop('checked',false);
        }
    }

    function checkSelectAll()
    {
        var a = $("input[type='checkbox'].permission");
        if(a.length == a.filter(":checked").length){
            $('#select_all').prop('checked',true);
        }
        else{
            $('#select_all').prop('checked',false);
        }
    }

    checkSelectAll();

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
