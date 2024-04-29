@extends('backend.layouts.master')
@section('body')
<main class="content">
    <div class="container-fluid p-0">

        @component('components.beardcrumb')

        {{-- /*Page Title Goese Here in this slot variable*/ --}}
        @slot('title')
        @lang('admission_data.index_title')
        @endslot

        @if(Auth::user()->can('admission_data trash'))
        {{-- for deleted list index --}}
        @slot('deleted_list_btn_name')
        @lang('admission_data.deleted_list')
        @endslot

        @slot('deleted_list_route')
        admission_data.trash_list
        @endslot
        @endif

        @endcomponent
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="header-title">Student Admission Data</h4>
                        <ul class="nav nav-tabs nav-bordered mb-3">
                            <li class="nav-item">
                                <a href="#roles-tab-all" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                    All
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#roles-tab-deleted" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                    Deleted
                                </a>
                            </li>
                        </ul> <!-- end nav-->
                        <div class="tab-content">
                            <div class="tab-pane show active" id="roles-tab-all">
                                <table id="datatables-reponsive" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Student Name</th>
                                            <th>Email</th>
                                            <th>phone</th>
                                            <th>Course Name</th>
                                            <th>Course Type</th>
                                            <th>Checked</th>
                                            <th>Checked By</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div> <!-- end all-->
                            @php
                            use App\Models\student_admission;
                            $onlyTrashed = student_admission::onlyTrashed()->get();
                            @endphp

                            <div class="tab-pane" id="roles-tab-deleted">
                                <table id="datatable-roles-deleted" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($onlyTrashed)
                                        @foreach ($onlyTrashed as $v)
                                        <tr>
                                            <td>{{$v->id}}</td>
                                            <td>{{$v->name}}</td>
                                            <td>{{$v->email}}</td>
                                            <td>{{$v->phone}}</td>
                                            <td>
                                                <a href="{{url('retrive_student_admission')}}/{{$v->id}}" class="btn btn-warning btn-sm"><i class="fa fa-rotate-right"></i> Retrive</a>
                                                <a onclick="return Confirm()" href="{{url('permenantadmissionDelete')}}/{{$v->id}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Permenantly Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div> <!-- end deleted-->
                        </div> <!-- end tab-content-->
                    </div> <!-- end card body-->
                </div> <!-- end card -->
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
                ajax: "{{ route('admission_data.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'course', name: 'course'},
                    {data: 'course_type', name: 'course_type'},
                    {data: 'read', name: 'read'},
                    {data: 'read_by', name: 'read_by'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>

    <script>
        function Confirm()
        {
            if(confirm("Are You Sure ?"))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    </script>

@endpush

@endsection
