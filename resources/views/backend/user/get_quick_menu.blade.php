<div class="search_menu">
    @if($menu)
    @foreach ($menu as $m)
    @if(Auth::user()->can($m->system_name.' '.$m->slug))
    <a class='dropdown-item' href='@if(Route::has($m->route.'.'.$m->slug)) {{route($m->route.'.'.$m->slug)}}@else javascript:; @endif'>
        @if(config('app.locale') == 'en')
        {{$m->menu_name_en ?: $m->menu_name_bn}}
        @else
        {{$m->menu_name_bn ?: $m->menu_name_en}}
        @endif
    </a>
    @endif
    @endforeach
    @endif
</div>
