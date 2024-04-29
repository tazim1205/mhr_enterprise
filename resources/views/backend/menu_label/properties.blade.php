@extends('backend.layouts.master')
@section('body')
<main class="content">
    <div class="container-fluid p-0">

        @component('components.beardcrumb')

        {{-- /*Page Title Goese Here in this slot variable*/ --}}
        @slot('title')
        @lang('menu_label.properties_title')
        @endslot

        @endcomponent

        @php
        Use App\Traits\Date;
        $result = App\Traits\Date::explodeDateTime(' ',$data['menu_label']->created_at);
        @endphp

        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-6 col-12" style="border-bottom: 1px solid lightgray;">
                                <h3>{{$data['menu_label']->label_name_en}} ( {{$data['menu_label']->label_name_bn}} )</h3>
                                <b>@lang('common.created_at')</b> : {{ App\Traits\Date::DbToOriginal('-',$result['date'])}}
                                <br>
                                <b>@lang('common.time')</b>: {{Date::twelveHrTime($result['time'])}}
                                <br>
                                <b>@lang('common.create_by')</b> : {{$data['menu_label']->creator->name}}
                            </div>
                           @include('components.history')
                           <hr>
                           <div class="col-12">
                            <h3>@lang('menu_label.this_menu')</h3>
                            <table class="table table-bordered dataTable4">
                                <thead>
                                    <tr>
                                        <th>@lang('menu.parent')</th>
                                        <th>@lang('menu.menu_name')</th>
                                        <th>@lang('menu.type')</th>
                                        <th>@lang('menu.route_name')</th>
                                        <th>@lang('common.actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['menu'] as $v)
                                    <tr  class="@if($v->deleted_at != NULL) table-danger @endif">
                                        <td>
                                            @if($v->parent_id != NULL)
                                            @if(config('app.locale') == 'en')
                                            {{$v->parent->menu_name_en ?: $v->parent_menu_name_bn}}
                                            @else
                                            {{$v->parent->menu_name_bn ?: $v->parent_menu_name_en}}
                                            @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if(config('app.locale') == 'en')
                                            {{$v->menu_name_en ?: $v->menu_name_bn}}
                                            @else
                                            {{$v->menu_name_bn ?: $v->menu_name_en}}
                                            @endif
                                        </td>
                                        <td>
                                            @if($v->type == 1)
                                            @lang('menu.parent')
                                            @elseif($v->type == 2)
                                            @lang('menu.module')
                                            @else
                                            @lang('menu.single')
                                            @endif
                                        </td>
                                        <td>
                                            {{$v->route}}
                                        </td>
                                        <td>
                                            @if($v->deleted_at == NULL)
                                            @if(Auth::user()->can('Menu destroy'))
                                            <form action="{{route('menu.destroy',$v->id)}}" id="deleteForm" method="post">
                                                @csrf()
                                                @method('DELETE')
                                                <button onclick="return Sure()" id="" type="submit" class="btn btn-sm btn-danger" href="#"><i class="fa fa-trash"></i> @lang('common.destroy')</button>
                                                </form>
                                            @endif
                                            @else
                                            @if(Auth::user()->can('Menu restore'))
                                            <a href="{{route('menu.restore',$v->id)}}" class="btn btn-warning btn-sm">
                                                <i class="fa fa-arrow-left"></i> @lang('common.restore')
                                            </a>
                                            @endif
                                            @if(Auth::user()->can('Menu delete'))
                                            <a onclick="return Sure()" href="{{route('menu.delete',$v->id)}}" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i> @lang('common.delete')
                                            </a>
                                            @endif

                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>@lang('menu.parent')</th>
                                        <th>@lang('menu.menu_name')</th>
                                        <th>@lang('menu.type')</th>
                                        <th>@lang('menu.route_name')</th>
                                        <th>@lang('common.actions')</th>
                                    </tr>
                                </tfoot>
                            </table>
                           </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

@push('footer_script')
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
