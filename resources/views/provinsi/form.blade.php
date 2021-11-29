<!-- FORM PROVINSI -->

@extends('layouts.admin.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $data['title'] }} Kecamatan</h1>
    </div>

    @include('templates.alerts')

    <!-- Content Row -->

    <div class="row">

        <!-- Area Table -->
        <div class="col-xl-12 col-lg-11">
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <!-- <a href="" class="btn btn-primary"> <i class="fa fa-plus"></i> Tambah User</a> -->
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form class="needs-validation" action="{{ $data['page'] == 'tambah' ? route('user.add_process') : route('user.edit_process') }}" method="POST" novalidate>
                        @csrf
                        <!-- ID USER READ ONLY -->
                        <div class="form-group row {{ $data['page'] == 'tambah' ? 'd-none':'' }}">
                            <label for="id_user" class="col-sm-2 col-form-label">ID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-plaintext" id="id_user" name="id_user" value="{{ $data['page'] == 'edit' ? $data['datas']->id : ''}}" />
                            </div>
                        </div>

                        <!-- USERNAME -->
                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" name="username" value="{{ $data['page'] == 'edit' ? $data['datas']->username : ''}}" required />
                                <div class="invalid-feedback">
                                    Username tidak boleh kosong!
                                </div>
                            </div>
                        </div>

                        <!-- PASSWORD -->
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="{{ $data['page'] == 'edit' ? $data['datas']->password : ''}}" required />
                                <div class="invalid-feedback">
                                    Password tidak boleh kosong!
                                </div>
                            </div>
                        </div>

                        <!-- ROLE -->
                        <div class="form-group row">
                            <label for="role" class="col-sm-2 col-form-label">Role</label>
                            <div class="col-sm-10">
                                <select name="role" class="custom-select" required>
                                    <option value="">Pilih</option>
                                    <option value="superadmin" {{ array_key_exists('datas', $data) && $data['datas']->role == 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                                    <option value="admin" {{ array_key_exists('datas', $data) && $data['datas']->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                <div class="invalid-feedback">
                                    Role tidak boleh kosong!
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-10 offset-sm-2">
                                @if ($data['page'] == 'tambah')
                                <button class="btn btn-primary" type="submit">Submit</button>
                                @elseif ($data['page'] == 'edit')
                                <button class="btn btn-warning" type="submit">Edit</button>
                                @endif
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection

@push('js')

<script type="text/javascript">
    // Validation
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
@endpush