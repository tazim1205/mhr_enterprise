@extends('backend.layouts.master')
@section('body')
<main class="content">
    <div class="container-fluid p-0">

        @component('components.beardcrumb')

        {{-- /*Page Title Goese Here in this slot variable*/ --}}
        @slot('title')
        @lang('slider.index_title')
        @endslot


        {{-- /* Create New Route Will Be goes here */ --}}
        @slot('route_name')
        slider.create
        @endslot
        @slot('btn_class')
        btn btn-primary
        @endslot
        @slot('icon')
        fa fa-plus
        @endslot
        @slot('btn_name')
        @lang('slider.create_new')
        @endslot

        @endcomponent
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-bordered mb-3">
                            <li class="nav-item">
                                <a href="#users-tab-all" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                    @lang('common.all')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#users-tab-deleted" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                    @lang('common.deleted_list')
                                </a>
                            </li>
                        </ul> <!-- end nav-->
                        <div class="tab-content">
                            <div class="tab-pane show active" id="users-tab-all">
                                <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>@lang('common.sl')</th>
                                            <th>@lang('slider.title_en')</th>
                                            <th>@lang('slider.title_bn')</th>
                                            <th>@lang('slider.image')</th>
                                            <th>@lang('common.status')</th>
                                            <th>@lang('common.actions')</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div> <!-- end all-->

                            <div class="tab-pane" id="users-tab-deleted">
                                @php
                                use App\Models\slider;
                                $data=  slider::onlyTrashed()->get();
                                $sl=1;
                                @endphp

                                <table id="alternative-page-datatable" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>@lang('common.sl')</th>
                                            <th>@lang('slider.title_en')</th>
                                            <th>@lang('slider.title_bn')</th>
                                            <th>@lang('slider.image')</th>
                                            <th>@lang('common.status')</th>
                                            <th>@lang('common.actions')</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if($data)
                                        @foreach ($data as $v)
                                        <tr>
                                            <td>{{$sl++}}</td>
                                            <td>{{$v->title}}</td>
                                            <td>{{$v->title_bn}}</td>
                                            <td><img src="{{asset('/Backend/img/slider')}}/{{$v->image}}" style="max-height: 100px;"></td>
                                            <td>{{$v->status}}</td>
                                            <td>
                                            <a href="{{ url('slider_restore') }}/{{ $v->id }}" class="btn btn-sm btn-info">@lang('common.restore')</a>
                                            <a href="{{ url('slider_delete') }}/{{ $v->id }}" class="btn btn-sm btn-danger">@lang('common.permenantly_delete')</a>  
                                            </td>    
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div> <!-- end deleted-->
                        </div> <!-- end tab-content-->
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
            ajax: "{{ route('slider.index') }}",
            columns: [
                {data: 'sl', name: 'sl'},
                {data: 'title', name: 'title'},
                {data: 'title_bn', name: 'title_bn'},
                {data: 'image', name: 'image'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>

<script>
    function ChangePhotoInfoStatus(id)
    {
        // alert(id);
        $.ajax({
            headers : {
                'X-CSRF-TOKEN' : '{{ csrf_token() }}'
            },

            url : '{{ url('ChangedPhotoInfoStatus') }}/'+id,

            type : 'GET',

            success : function(res)
            {
                toastr.success("Status Changed Successfully");
            }
        });
    }
</script>

@endpush

@endsection
