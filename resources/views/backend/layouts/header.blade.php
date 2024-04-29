<link rel="preconnect" href="https://fonts.gstatic.com/">
@php
$favicon = public_path().'/Backend/settings/'.$settings->favicon;
@endphp
@if(file_exists($favicon))
<link rel="shortcut icon" href="{{asset('Backend/settings')}}/{{$settings->favicon}}" />
@endif

<link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&family=Noto+Serif+Bengali:wght@100;200;300;400;500;600;700;800;900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

{{-- <link rel="canonical" href="index.html" /> --}}

<title>
    @if(config('app.locale') == 'en')
    {{$settings->title_en ?: $settings->title_bn}}
    @else
    {{$settings->title_bn ?: $settings->title_en}}
    @endif
</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&amp;display=swap" rel="stylesheet">

<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>




<style>
    img,svg {display: inline-block !important;}
    .choices[data-type*=select-one] .choices__inner{
        padding : 0px !important;
    }
    .choices {
    margin-top: 5px;
}
.choices[data-type*=select-one] .choices__inner
{
    padding-bottom: 4px !important;
}
.choices.is-focused .choices__inner{
    box-shadow: none !important;
}
.choices {
    margin-bottom: 0px !important;
}
.sidebar-header
{
    padding: 8px 24px !important;
}
tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
    .showMenu {
    position: absolute;
    background: white;
    width: 492px;
    top: 40px;
}

.d-sm-inline-block {
    position: relative;
}

.showMenu a.dropdown-item {
    padding: 7px 11px;
    border-bottom: 1px solid lightgray;
}
</style>
