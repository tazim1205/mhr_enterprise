@extends('backend.layouts.master')

@section('title') @lang('menu.create_title') @endsection

@section('body')
<main class="content">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row mb-3">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Student Name</th>
                                    <td>:</td>
                                    <td>{{$data->name}}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>:</td>
                                    <td>{{$data->email}}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>:</td>
                                    <td>{{$data->phone}}</td>
                                </tr>
                                <tr>
                                    <th>Course Name</th>
                                    <td>:</td>
                                    <td>
                                        @if($data->course == 1)
                                        <span>Basic Computer</span>
                                        @endif
                                        @if($data->course == 2)
                                        <span>Professional Graphic Design</span>
                                        @endif

                                        @if($data->course == 3)
                                        <span>Web Design</span>
                                        @endif

                                        @if($data->course == 4)
                                        <span>Web Development</span>
                                        @endif

                                        @if($data->course == 5)
                                        <span>Android App Development</span>
                                        @endif
                                        
                                        @if($data->course == 6)
                                        <span>Search Engine Optimization (SEO)</span>
                                        @endif

                                    </td>
                                </tr>
                                <tr>
                                    <th>Course Type</th>
                                    <td>:</td>
                                    <td>
                                        @if($data->course_type == 1)
                                        <span>Industrial<span>
                                        @endif

                                        @if($data->course_type == 2)
                                        <span>Regular</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection