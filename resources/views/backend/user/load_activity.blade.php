@php
Use App\Traits\Date;
@endphp
@if($data['count'] > 0)
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
@else
<tr class="table-danger">
    <td colspan="2" style="text-align: center">@lang('user.no_activity')</td>
</tr>
@endif
