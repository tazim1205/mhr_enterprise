@extends('backend.layouts.master')
@section('body')
<main class="content">
    <div class="container-fluid p-0">

        @component('components.beardcrumb')

        {{-- /*Page Title Goese Here in this slot variable*/ --}}
        @slot('title')
        @lang('user.properties_title')
        @endslot

        @endcomponent

        @php
        Use App\Traits\Date;
        $result = App\Traits\Date::explodeDateTime(' ',$data['user']->created_at);
        @endphp
        <input type="hidden" id="user_id" name="user_id" value="{{$data['user']->id}}">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-6 col-12" style="border-bottom: 1px solid lightgray;">
                                <h5>{{$data['user']->name}} ( {{$data['user']->name_bn}} )</h5>
                                <b>@lang('common.created_at')</b> : {{ App\Traits\Date::DbToOriginal('-',$result['date'])}}
                                <br>
                                <b>@lang('common.time')</b>: {{Date::twelveHrTime($result['time'])}}
                                <br>
                                <b>@lang('common.create_by')</b> : {{$data['user']->creator->name}}
                            </div>

                            @include('components.history')
                            <div class="col-lg-6 col-md-6 col-12 p-2">
                                <h4>@lang('user.password_change_history')</h4>
                                <table class="table table-bordered dataTable4" style="font-size:12px;" >
                                    <thead>
                                        <tr>
                                            <th>@lang('common.date_time')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($data['pass_change_history'])
                                        @foreach ($data['pass_change_history'] as $ph)
                                        <tr>
                                            <td>{{Date::DbToOriginal('-',$ph->date)}} , {{Date::twelveHrTime($ph->time)}}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>@lang('common.date_time')</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <hr>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <h4>@lang('user.this_user')</h4>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="mb-3">
												<input type="text" class="form-control flatpickr-minimum" name="search_date" id="search_date" placeholder="@lang('common.date')" onchange="return getDateActivity()">
											</div>
                                    </div>
                                </div>
                                <table class="table table-bordered dataTable5">
                                    <thead>
                                        <tr>
                                            <th>@lang('common.date_time')</th>
                                            <th>@lang('common.description')</th>
                                        </tr>
                                    </thead>
                                    <tbody id="ShowData">
                                        @if($data['activity'])
                                        @foreach ($data['activity'] as $ac)
                                        <tr
                                        class="
                                        @if($ac->activity == 'create')
                                        bg-success
                                        @elseif($ac->activity == 'edit')
                                        bg-info
                                        @elseif($ac->activity == 'destroy')
                                        bg-warning
                                        @elseif($ac->activity == 'restore')
                                        bg-primary
                                        @elseif($ac->activity == 'delete')
                                        bg-danger
                                        @elseif($ac->activity == 'login')
                                        bg-success
                                        @elseif($ac->activity == 'change_status')
                                        bg-secondary
                                        @elseif($ac->activity == 'permission')
                                        bg-info
                                        @endif
                                        " style="color: white;">
                                        <td style="color: white;">
                                            @if(date('Y-m-d') == $ac->date)
                                            @lang('common.today')
                                            @else
                                            {{Date::DbToOriginal('-',$ac->date)}}
                                            @endif
                                            , {{Date::twelveHrTime($ac->time)}}
                                        </td>
                                        <td style="color: white;">
                                            @if(config('app.locale') == 'en')
                                            {{$ac->description_en}}
                                            @else
                                            {{$ac->description_bn}}
                                            @endif
                                        </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>@lang('common.date_time')</th>
                                            <th>@lang('common.description')</th>
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr(".flatpickr-minimum",{
            dateFormat: "d M Y",
        });
    });
</script>
<script>
    function getDateActivity()
    {
        let user_id = $('#user_id').val();
        let date = $('#search_date').val();
        var loading = '<div class="spinner-border text-dark me-2 p-2" style="text-align:center" role="status"><span class="visually-hidden">Loading...</span></div>';
        if(date != '')
        {
            $.ajax({
                headers : {
                    'X-CSRF-TOKEN' : '{{csrf_token()}}'
                },
                url : '{{route('user.activity')}}',
                type : 'POST',
                data : {user_id,date},
                beforeSend : function(r){
                    $('#ShowData').html(loading);
                },
                success : function(r)
                {
                    $('#ShowData').html(r);
                },
                error : function(r)
                {

                }
            });
        }
    }
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
