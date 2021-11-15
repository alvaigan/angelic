@extends('layouts.admin.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List User</h1>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Table -->
        <div class="col-xl-12 col-lg-11">
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <a href="" class="btn btn-primary"> <i class="fa fa-plus"></i> Tambah User</a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($get_user as $key=>$data)
                                <tr>
                                    <td>{{$key+1 }}</td>
                                    <td>{{$data->username}}</td>
                                    <td>{{$data->password}}</td>
                                    <td>{{$data->role}}</td>
                                    <td>
                                        <div class="btn-group mr-2">
                                            <a href="{{url('/administrator/user/detail')}}/{{$data->id}}" class="btn btn-warning"><i class="fa fa-pen"></i></a>
                                            <a href="{{url('/administrator/user/destroy')}}/{{$data->id}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection