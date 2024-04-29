@php
Use App\Traits\Date;
@endphp
<div class="col-lg-6 col-md-6 col-12 p-2">
    <h4>@lang('common.edit_history')</h4>
    <table class="table table-bordered dataTable" style="font-size:12px;">
        <thead>
            <tr>
                <th>@lang('common.date_time')</th>
                <th>@lang('common.edit_by')</th>
            </tr>
        </thead>
        <tbody>
            @if($data['edit_history'])
            @foreach ($data['edit_history'] as $eh)
            <tr>
                <td>{{Date::DbToOriginal('-',$eh->date)}} , {{Date::twelveHrTime($eh->time)}}</td>
                <td>
                    @php
                    $path = public_path().'/Backend/profile/'.$eh->editor->profile;
                    @endphp
                    @if(file_exists($path))
                    <img src="{{asset('Backend/profile')}}/{{$eh->editor->profile}}" alt="" style="height: 40px;width:40px;border-radius:100%;">
                    @else
                    <img src="{{asset('Backend/img/avatars')}}/user_avatar.png" alt="" style="height: 40px;width:40px;border-radius:100%;">
                    @endif
                    {{$eh->editor->name}}
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <th>@lang('common.date_time')</th>
                <th>@lang('common.edit_by')</th>
            </tr>
        </tfoot>
    </table>
</div>
<div class="col-lg-6 col-md-6 col-12 p-2">
    <h4 class="text-danger">@lang('common.delete_history')</h4>
    <table class="table table-bordered dataTable2" style="font-size:12px;">
        <thead>
            <tr>
                <th>@lang('common.date_time')</th>
                <th>@lang('common.edit_by')</th>
            </tr>
        </thead>
        <tbody>
            @if($data['delete_history'])
            @foreach ($data['delete_history'] as $dh)
            <tr>
                <td>{{Date::DbToOriginal('-',$dh->date)}} , {{Date::twelveHrTime($dh->time)}}</td>
                <td>
                    @php
                    $path = public_path().'/Backend/profile/'.$dh->deletor->profile;
                    @endphp
                    @if(file_exists($path))
                    <img src="{{asset('Backend/profile')}}/{{$dh->deletor->profile}}" alt="" style="height: 40px;width:40px;border-radius:100%;">
                    @else
                    <img src="{{asset('Backend/img/avatars')}}/user_avatar.png" alt="" style="height: 40px;width:40px;border-radius:100%;">
                    @endif
                    {{$dh->deletor->name}}
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <th>@lang('common.date_time')</th>
                <th>@lang('common.edit_by')</th>
            </tr>
        </tfoot>
    </table>
</div>
<div class="col-lg-6 col-md-6 col-12 p-2">
    <h4 class="text-success">@lang('common.restore_history')</h4>
    <table class="table table-bordered dataTable3" style="font-size:12px;" >
        <thead>
            <tr>
                <th>@lang('common.date_time')</th>
                <th>@lang('common.edit_by')</th>
            </tr>
        </thead>
        <tbody>
            @if($data['restore_history'])
            @foreach ($data['restore_history'] as $rh)
            <tr>
                <td>{{Date::DbToOriginal('-',$rh->date)}} , {{Date::twelveHrTime($rh->time)}}</td>
                <td>
                    @php
                    $path = public_path().'/Backend/profile/'.$rh->restorer->profile;
                    @endphp
                    @if(file_exists($path))
                    <img src="{{asset('Backend/profile')}}/{{$rh->restorer->profile}}" alt="" style="height: 40px;width:40px;border-radius:100%;">
                    @else
                    <img src="{{asset('Backend/img/avatars')}}/user_avatar.png" alt="" style="height: 40px;width:40px;border-radius:100%;">
                    @endif
                    {{$rh->restorer->name}}
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <th>@lang('common.date_time')</th>
                <th>@lang('common.edit_by')</th>
            </tr>
        </tfoot>
    </table>
</div>
