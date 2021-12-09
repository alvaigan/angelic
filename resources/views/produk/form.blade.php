<!-- FORM BARANG -->

@extends('layouts.admin.app')
@section('content')

<?php
if (isset($data)) {
    $page  = "Edit";
    $data = $data;
} else {
    $page = "Tambah";
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
                        action="{{ isset($data) ? route('produk.update', $data['id']) : route('produk.store')}}"
                        method="POST" enctype="multipart/form-data" novalidate>
                        @csrf

                        <!-- KODE PRODUK -->
                        <div class="form-group row">
                            <label for="kode_produk" class="col-sm-4 col-lg-2 col-form-label">Kode Produk</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kode_produk" name="kode_produk"
                                    value="{{ isset($data) ? $data['kode_produk'] : '' }}" required />
                                <div class="invalid-feedback">
                                    Kode Produk tidak boleh kosong!
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

                        <!-- KATEGORI -->
                        <div class="form-group row">
                            <label for="kategori" class="col-sm-4 col-lg-2 col-form-label">Kategori</label>
                            <div class="col-sm-10">
                                <select name="kategori" class="custom-select" required>
                                    <option value="">Pilih</option>
                                    @foreach ( $kategori as $key => $item)
                                    <option value="{{ $item['id'] }}"
                                        {{ isset($data) && $data['id_kategori'] == $item['id'] ? "selected" : "" }}>
                                        {{$item['kategori']}}</option>

                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Kategori tidak boleh kosong!
                                </div>
                            </div>
                        </div>

                        <!-- TAGS -->
                        <div class="form-group row">
                            <label for="tags" class="col-sm-4 col-lg-2 col-form-label">Tags</label>
                            <div class="col-sm-10">
                                <div class="dropdown">
                                    <input class="form-control dropdown-toggle" type="text" id="tags" name="tags"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        value="<?php if (isset($data)) echo implode(",", json_decode($data['tags'])) ?>">
                                    <div id="item-dd" class="dropdown-menu animated--fade-in" aria-labelledby="tags">
                                        <div id="tags-1" class="dropdown-item">Top Seller</div>
                                        <div id="tags-2" class="dropdown-item">Stylist</div>
                                        <div id="tags-3" class="dropdown-item">New Product</div>
                                    </div>
                                </div>

                                <div class="invalid-feedback">
                                    Tags tidak boleh kosong!
                                </div>
                            </div>
                        </div>

                        <!-- HARGA -->
                        <!-- <div class="form-group row">
                            <label for="harga" class="col-sm-4 col-lg-2 col-form-label">Harga</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="harga" name="harga" value="" required />
                                <div class="invalid-feedback">
                                    Harga tidak boleh kosong!
                                </div>
                            </div>
                        </div> -->

                        <!-- STOK -->
                        <!-- <div class="form-group row">
                            <label for="stok" class="col-sm-4 col-lg-2 col-form-label">Stok</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="stok" name="stok" value="" required />
                                <div class="invalid-feedback">
                                    Stok tidak boleh kosong!
                                </div>
                            </div>
                        </div> -->

                        <!-- SHORT DESC -->
                        <div class="form-group row">
                            <label for="short_desc" class="col-sm-4 col-lg-2 col-form-label">Deskripsi Singkat</label>
                            <div class="col-sm-10">
                                <textarea name="short_desc" id="short_desc"
                                    class="form-control"> {{isset($data) ? $data['short_desc'] : ""}} </textarea>

                                <div class="invalid-feedback">
                                    Deskripsi Singkat tidak boleh kosong!
                                </div>
                            </div>
                        </div>

                        <!-- DESKRIPSI -->
                        <div class="form-group row">
                            <label for="deskripsi" class="col-sm-4 col-lg-2 col-form-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea name="deskripsi" id="deskripsi"
                                    class="form-control">{{isset($data) ? $data['deskripsi'] : ""}}</textarea>

                                <div class="invalid-feedback">
                                    Deskripsi tidak boleh kosong!
                                </div>
                            </div>
                        </div>

                        <!-- URL SHOPEE -->
                        <div class="form-group row">
                            <label for="url_shopeee" class="col-sm-4 col-lg-2 col-form-label">URL Shopee</label>
                            <div class="col-sm-10">
                                <input type="url" class="form-control" id="url_shopee" name="url_shopee"
                                    value="{{isset($data) ? $data['url_shopee'] : ""}}" required />
                                <div class="invalid-feedback">
                                    URL Shopee tidak boleh kosong!
                                </div>
                            </div>
                        </div>

                        <!-- URL TOKOPEDIA -->
                        <div class="form-group row">
                            <label for="url_shopeee" class="col-sm-4 col-lg-2 col-form-label">URL Tokopedia</label>
                            <div class="col-sm-10">
                                <input type="url" class="form-control" id="url_tokped" name="url_tokped"
                                    value="{{isset($data) ? $data['url_shopee'] : ""}}" required />
                                <div class="invalid-feedback">
                                    URL Tokopedia tidak boleh kosong!
                                </div>
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
                                        <input type="file" id="img{{$key+1}}" name="img{{$key+1}}"
                                            {{isset($data) ? "" : "required"}} />
                                        <div class="invalid-feedback">
                                            Gambar tidak boleh kosong!
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" value="{{$row->url}}"
                                                aria-label="Recipient's username" aria-describedby="basic-addon2" readonly>
                                            <div class="input-group-append">
                                                <button class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                @endforeach
                                @else
                                <div class="row mb-3 to-rm-file">
                                    <div class="col-3">
                                        <input type="file" id="img1" name="img1" {{isset($data) ? "" : "required"}} />
                                        <div class="invalid-feedback">
                                            Gambar tidak boleh kosong!
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if (isset($data))
                                <div id="picture" class="row">
                                    @foreach ($data['gambar'] as $row)
                                    <img src="{{ url($row->url) }}" class="col-sm-3 img-fluid rounded" alt="...">
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-10 offset-sm-2">

                                <button class="btn {{ isset($data) ? 'btn-warning' : 'btn-primary' }}"
                                    type="submit">{{isset($data) ? 'Edit' : 'Submit'}}</button>

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
    (function () {

        //  ADD INPUT GAMBAR
        $('#add-img').click(() => {
            let row = $('#input-gambar > .to-rm-file').length + 1;
            const appendImg = `<div class="row mb-3 to-rm-file">
                        <div class="col-3">
                            <input type="file" id="img${row}" name="img${row}" {{isset($data) ? "" : "required"}} />
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

        var childs = document.getElementById('item-dd').children;
        for (var i = 0; i < childs.length; i++) { // iterate over it
            childs[i].onclick = function () { // attach event listener individually
                tags = document.getElementById('tags')
                if (tags.value == "") {
                    tags.value = this.innerHTML
                } else {
                    tags.value = tags.value + "," + this.innerHTML
                }
            }
        }

        // Validation
        'use strict';
        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
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
