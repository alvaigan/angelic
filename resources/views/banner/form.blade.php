<!-- FORM BANNER -->

@extends('layouts.admin.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Form {{ isset($data) ? 'Edit' : 'Tambah' }} Banner</h1>
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
                            action="{{ isset($data) ? route('banner.update', $data['id']) : route('banner.store') }}"
                            method="POST" enctype="multipart/form-data" novalidate>
                            @csrf

                            <!-- Gambar banner -->
                            <div class="form-group row">
                                <label for="tag" class="col-sm-2 col-form-label">Gambar Banner</label>
                                <div class="col-sm-10">
                                    <div class="row mb-3 to-rm-file">
                                        <div class="col-4">
                                            <input type="file" name="url_banner" accept="image/*" />
                                            <div class="invalid-feedback">
                                                Gambar Banner tidak boleh kosong!
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="input-group mb-3">
                                                <?php
                                                $url_banner = '';
                                                if (isset($data)) {
                                                    $url_banner = explode('/', $data['url_banner']);
                                                    $url_banner = end($url_banner);
                                                }
                                                ?>
                                                <input type="text" class="form-control" value="{{ $url_banner }}"
                                                    aria-label="Recipient's username" aria-describedby="basic-addon2"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- URUTAN -->
                            <div class="form-group row">
                                <label for="kode_produk" class="col-sm-4 col-lg-2 col-form-label">Urutan</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" id="urutan" name="urutan"
                                        value="{{ isset($data) ? $data['urutan'] : '' }}" required />
                                    <div class="invalid-feedback"> Urutan tidak boleh kosong!
                                    </div>
                                </div>
                            </div>

                            <!-- TAMPILKAN -->
                            <div class="form-group row">
                                <label for="kode_produk" class="col-sm-4 col-lg-2 col-form-label">Tampilkan?</label>
                                <div class="col-sm-4">
                                    <select name="show" class="custom-select" required>
                                        <option value="">Pilih</option>
                                        <option value="true" {{ isset($data) && $data->show == 1 ? 'selected' : '' }}>Ya
                                        </option>
                                        <option value="false" {{ isset($data) && $data->show == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                    </select>
                                    <div class="invalid-feedback"> Tampilkan tidak boleh kosong!
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
