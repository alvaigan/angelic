<!-- FORM USER -->

@extends('layouts.admin.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Form Tambah Kupon</h1>
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
                        <form class="needs-validation"
                            action="{{ isset($data) ? route('kupon.update', $data['id']) : route('kupon.store') }}"
                            method="POST" novalidate>
                            @csrf

                            <!-- KODE KUPON -->
                            <div class="form-group row">
                                <label for="kupon" class="col-sm-2 col-form-label">Kode Kupon</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kode_kupon" name="kode_kupon"
                                        value="{{ isset($data) ? $data['kode_kupon'] : '' }}" required />
                                    <div class="invalid-feedback">
                                        Kode Kupon tidak boleh kosong!
                                    </div>
                                </div>
                            </div>

                            <!-- POTONGAN KUPON -->
                            <div class="form-group row">
                                <label for="kupon" class="col-sm-2 col-form-label">Potongan</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="potongan" name="potongan"
                                        value="{{ isset($data) ? $data['potongan'] : '' }}" required />
                                    <div class="invalid-feedback">
                                        Potongan tidak boleh kosong!
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-10 offset-sm-2">
                                    @if (isset($data))
                                        <button class="btn btn-warning" type="submit">Edit</button>
                                    @else
                                        <button class="btn btn-primary" type="submit">Submit</button>
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
