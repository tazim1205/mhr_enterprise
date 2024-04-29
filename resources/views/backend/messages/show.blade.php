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
                                    <th>Name</th>
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
                                    <th>Message</th>
                                    <td>:</td>
                                    <td>{{$data->message}}</td>
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


