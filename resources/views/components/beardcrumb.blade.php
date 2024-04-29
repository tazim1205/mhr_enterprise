<div class="row mb-2 mb-xl-3">
    <div class="col-auto d-none d-sm-block">
        <h3>{{$title}}</h3>
    </div>

    <div class="col-auto ms-auto text-end mt-n1">
        @if(isset($btn_name))
        <a href="{{route("$route_name")}}" class="{{$btn_class}}"><i class="{{$icon}}"></i> {{$btn_name}}</a>
        @endif
        @if(isset($deleted_list_btn_name))
        <a href="@if(Route::has("$deleted_list_route")){{route("$deleted_list_route")}} @else javascript:; @endif" class="btn btn-danger"><i class="fa fa-eye"></i> {{$deleted_list_btn_name}}</a>
        @endif

    </div>
</div>
