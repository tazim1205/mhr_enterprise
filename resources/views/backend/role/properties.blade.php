@extends('backend.layouts.master')
@section('body')
<main class="content">
    <div class="container-fluid p-0">

        @component('components.beardcrumb')

        {{-- /*Page Title Goese Here in this slot variable*/ --}}
        @slot('title')
        @lang('role.properties_title')
        @endslot

        @endcomponent

        @php
        Use App\Traits\Date;
        $result = App\Traits\Date::explodeDateTime(' ',$data['role']->created_at);
        @endphp

        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-6 col-12" style="border-bottom: 1px solid lightgray;">
                                <h5>{{$data['role']->name}} ( {{$data['role']->name_bn}} )</h5>
                                <b>@lang('common.created_at')</b> : {{ App\Traits\Date::DbToOriginal('-',$result['date'])}}
                                <br>
                                <b>@lang('common.time')</b>: {{Date::twelveHrTime($result['time'])}}
                                <br>
                                <b>@lang('common.create_by')</b> : {{$data['role']->creator->name}}
                            </div>
                            @include('components.history')
                            <div class="col-12">
                                <h4>@lang('role.this_role')</h4>
                                <hr>
                                <table class="table table-bordered dataTable4">
                                    <thead>
                                        <tr>
                                            <th>@lang('common.sl')</th>
                                            <th>@lang('user.profile')</th>
                                            <th>@lang('user.name')</th>
                                            <th>@lang('user.phone')</th>
                                            <th>@lang('user.email')</th>
                                            <th>@lang('user.gender')</th>
                                            <th>@lang('common.actions')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($data['user'])
                                        @foreach ($data['user'] as $v)
                                        <tr class="@if($v->deleted_at != NULL) table-danger @endif">
                                            <td>
                                                {{$data['sl']++}}
                                            </td>
                                            <td>
                                                @php
                                                $path = public_path().'/Backend/profile/'.$v->profile;
                                                @endphp
                                                @if(file_exists($path))
                                                <img src="{{asset('Backend')}}/profile/{{$v->profile}}" alt="">
                                                @else
                                                <img src="{{asset('Backend/img')}}/avatars/user_avatar.png" alt="" style="height: 50px;width:55px;border-radius:100%;">
                                                @endif
                                            </td>
                                            <td>
                                                @if(config('app.locale') == 'en')
                                                {{$v->name ?: $v->name_bn}}
                                                @else
                                                {{$v->name_bn ?: $v->name}}
                                                @endif
                                            </td>
                                            <td>
                                                {{$v->phone}}
                                            </td>
                                            <td>
                                                {{$v->email}}
                                            </td>
                                            <td>
                                                @if($v->gender == 'Male')
                                                @lang('common.male')
                                                @elseif($v->gender == 'Female')
                                                @lang('common.female')
                                                @endif
                                            </td>
                                            <td>
                                                @if($v->deleted_at == NULL)
                                                @if(Auth::user()->can('Admin destroy'))
                                                <form action="{{route('user.destroy',$v->id)}}" id="deleteForm" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return Sure()" id="" type="submit" class="btn btn-sm btn-danger" href="#"><i class="fa fa-trash"></i> @lang('common.destroy')</button>
                                                    </form>
                                                @endif

                                                @else
                                                @if(Auth::user()->can('Admin restore'))
                                                <a class="btn btn-sm btn-warning" href="{{route('user.restore',$v->id)}}"><i class="fa fa-arrow-left"></i> @lang('common.restore')</a>
                                                @endif
                                                @if(Auth::user()->can('Admin delete'))
                                                <a onclick="return Sure()" class="btn btn-sm btn-danger" href="{{route('user.delete',$v->id)}}"><i class="fa fa-trash"></i> @lang('common.delete')</a>
                                                @endif

                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>@lang('common.sl')</th>
                                            <th>@lang('user.profile')</th>
                                            <th>@lang('user.name')</th>
                                            <th>@lang('user.phone')</th>
                                            <th>@lang('user.email')</th>
                                            <th>@lang('user.gender')</th>
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
