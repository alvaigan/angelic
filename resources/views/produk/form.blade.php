<!-- FORM BARANG -->

@extends('layouts.admin.app')
@section('content')

    @push('css')
        <script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
    @endpush

    <?php
    if (isset($data)) {
        $page = 'Edit';
        $data = $data;
    } else {
        $page = 'Tambah';
    }
    ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        @push('css')
            <style>
                /* Chrome, Safari, Edge, Opera */
                input::-webkit-outer-spin-button,
                input::-webkit-inner-spin-button {
                    -webkit-appearance: none;
                    margin: 0;
                }

                /* Firefox */
                input[type=number] {
                    -moz-appearance: textfield;
                }

            </style>
        @endpush

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"> Form {{ $page }} Barang</h1>
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
                            action="{{ isset($data) ? route('produk.update', $data['id']) : route('produk.store') }}"
                            method="POST" enctype="multipart/form-data" novalidate>
                            @csrf

                            <!-- KODE PRODUK -->
                            <div class="form-group row">
                                <label for="kode_produk" class="col-sm-4 col-lg-2 col-form-label">Kode Produk</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kode_produk" name="kode_produk"
                                        value="{{ isset($data) ? $data['kode_produk'] : '' }}" required />
                                    <div class="invalid-feedback"> Kode Produk tidak boleh kosong!
                                    </div>
                                </div>
                            </div>

                            <!-- NAMA PRODUK -->
                            <div class="form-group row">
                                <label for="nama_produk" class="col-sm-4 col-lg-2 col-form-label">Nama Produk</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                                        value="{{ isset($data) ? $data['nama_produk'] : '' }}" required />
                                    <div class="invalid-feedback">
                                        Nama Produk tidak boleh kosong!
                                    </div>
                                </div>
                            </div>

                            <!-- HARGA ASLI -->
                            <div class="form-group row">
                                <label for="harga_asli" class="col-sm-4 col-lg-2 col-form-label">Harga Asli</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="harga_asli" name="harga_asli"
                                        value="{{ isset($data) ? $data['harga_asli'] : '' }}" required />
                                    <div class="invalid-feedback">
                                        Harga asli tidak boleh kosong!
                                    </div>
                                </div>
                            </div>

                            <!-- HARGA CORET -->
                            <div class="form-group row">
                                <label for="harga_coret" class="col-sm-4 col-lg-2 col-form-label">Harga Coret</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="harga_coret" name="harga_coret"
                                        value="{{ isset($data) ? $data['harga_coret'] : '' }}" required />
                                    <div class="invalid-feedback">
                                        Harga coret tidak boleh kosong!
                                    </div>
                                </div>
                            </div>

                            <!-- TAGS -->
                            <div class="form-group row">
                                <label for="tags" class="col-sm-4 col-lg-2 col-form-label">Tags</label>
                                <div class="col-sm-10">
                                    @if (isset($tag))
                                        @foreach ($tag as $key => $item)
                                            <?php $checked = ''; ?>
                                            @if(isset($data))
                                            @foreach ($data->detail_tag as $key => $value)
                                                @if ($value->id_produk == $data->id)
                                                    <?php $checked = 'checked'; ?>
                                                @else
                                                    <?php $checked = ''; ?>
                                                @endif
                                                  @endforeach
                                                  @endif

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="tag[]"
                                                    value="{{ $item->id }}" id="flexCheckDefault" {{ $checked }}>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    {{ $item->tag }}
                                                </label>
                                            </div>
                                        @endforeach
                                    @endif

                                    <div class="invalid-feedback">
                                        Tags tidak boleh kosong!
                                    </div>
                                </div>
                            </div>

                            <!-- KATEGORI -->
                            <div class="form-group row">
                                <label for="kategori" class="col-sm-4 col-lg-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <select name="kategori" class="custom-select" required>
                                        <option value="">Pilih</option>
                                        @foreach ($kategori as $key => $item)
                                            <option value="{{ $item['id'] }}"
                                                {{ isset($data) && $data['id_kategori'] == $item['id'] ? 'selected' : '' }}>
                                                {{ $item['kategori'] }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Kategori tidak boleh kosong!
                                    </div>
                                </div>
                            </div>

                            <!-- SHORT DESC -->
                            <div class="form-group row">
                                <label for="short_desc" class="col-sm-4 col-lg-2 col-form-label">Deskripsi Singkat</label>
                                <div class="col-sm-10">
                                    <textarea name="short_desc" id="short_desc"
                                        class="form-control">{{ isset($data) ? $data['short_desc'] : '' }} </textarea>

                                    <div class="invalid-feedback">
                                        Deskripsi Singkat tidak boleh kosong!
                                    </div>
                                </div>
                            </div>

                            <!-- DESKRIPSI -->
                            <div class="form-group row">
                                <label for="deskripsi" class="col-sm-4 col-lg-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    <textarea name="deskripsi"
                                        id="editor">{{ isset($data) ? $data['deskripsi'] : '' }}</textarea>
                                </div>
                            </div>

                            <!-- Tombol Navigasi Tambah-Kurang Gambar -->
                            <div class="form-group row">
                                <label for="url_shopeee" class="col-sm-4 col-lg-4 offset-2 col-form-label text-right">Tambah
                                    Atau Kurangi Form Gambar </label>
                                <div class="col-sm-4 col-lg-2 align-self-center">
                                    :
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button id="add-img" type="button" class="btn btn-success"><i
                                                class="fa fa-plus"></i></button>
                                        <button id="rmv-img" type="button" class="btn btn-danger"><i
                                                class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                            </div>

                            <!-- FILE -->
                            <div class="form-group row">
                                <label for="stok" class="col-sm-4 col-lg-2 col-form-label">Gambar</label>
                                <div id="input-gambar" class="col-sm-10">
                                    @if (isset($data))
                                        @foreach ($data['gambar'] as $key => $row)
                                            <div class="row mb-3 to-rm-file">
                                                <div class="col-3">
                                                    <input type="file" id="img{{ $key + 1 }}"
                                                        name="img{{ $key + 1 }}"
                                                        {{ isset($data) ? '' : 'required' }} />
                                                    <div class="invalid-feedback">
                                                        Gambar tidak boleh kosong!
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control"
                                                            value="{{ $row->url }}" aria-label="Recipient's username"
                                                            aria-describedby="basic-addon2" readonly>
                                                        <div class="input-group-append">
                                                            <button id="delete-gambar" class="btn btn-danger" type="button"
                                                                data-gambar-id="{{ $row->id }}"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                    @else
                                        <div class="row mb-3 to-rm-file">
                                            <div class="col-3">
                                                <input type="file" id="img1" name="img1"
                                                    {{ isset($data) ? '' : 'required' }} />
                                                <div class="invalid-feedback">
                                                    Gambar tidak boleh kosong!
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if (isset($data))
                                        <div id="picture" class="row">
                                            @foreach ($data['gambar'] as $row)
                                                <img src="{{ asset('') }}/{{ $row->url }}"
                                                    class="col-sm-3 img-fluid rounded" alt="...">
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-10 offset-sm-2">

                                    <button class="btn {{ isset($data) ? 'btn-warning' : 'btn-primary' }}"
                                        type="submit">{{ isset($data) ? 'Edit' : 'Submit' }}</button>

                                    <!-- <button class="btn btn-warning" type="submit">Edit</button> -->

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
        (function() {

            //  ADD INPUT GAMBAR
            $('#add-img').click(() => {
                let row = $('#input-gambar > .to-rm-file').length + 1;
                const appendImg = `<div class="row mb-3 to-rm-file">
                        <div class="col-3">
                            <input type="file" id="img${row}" name="img${row}" {{ isset($data) ? '' : 'required' }} />
                            <div class="invalid-feedback">
                                Gambar tidak boleh kosong!
                            </div>
                        </div>
                    </div>`;

                @if (isset($data))
                    $('#picture').before(appendImg)
                @else
                    $('#input-gambar').append(appendImg)
                @endif
            })

            $('#rmv-img').click(() => {
                $('#input-gambar > .to-rm-file:last').remove()
            })

            // Validation
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

        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.log(error);
            });

        // DELETE FOTO
        $(document).on('click', '#delete-gambar', function() {
            let id = $(this).data('gambar-id');

            console.log(id);

            $.ajax({
                url: "{{ url('/administrator/img/delete') }}/" + id,
                type: "POST",
                data: {
                    '_token': "{{ csrf_token() }}",
                },
                success: function(data) {
                    $('#input-gambar').load(window.location.href + " #input-gambar");
                }
            });
        });
    </script>
@endpush
