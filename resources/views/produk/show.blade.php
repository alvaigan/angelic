<!-- FORM BARANG -->

@extends('layouts.admin.app')
@section('content')
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
        {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"> Detail Barang</h1>
        </div> --}}

        @include('templates.alerts')

        <!-- Content Row -->
        <div class="row">

            <!-- Area Table -->
            <div class="col-xl-12 col-lg-11">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <!-- <a href="" class="btn btn-primary"> <i class="fa fa-plus"></i> Tambah User</a> -->
                        <h1 class="h3 mb-0 text-gray-800"> Detail Barang</h1>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body row">
                        <div class="col-sm-8 col-12 mb-4">
                            <div class="row">
                                <div class="col-4 col-sm-4 text-right font-weight-bold">Kode Produk</div>
                                <div class="col-8 col-sm-8">{{ $data->kode_produk }}</div>
                            </div>
                            <div class="row">
                                <div class="col-4 col-sm-4 text-right font-weight-bold">Nama Produk</div>
                                <div class="col-8 col-sm-8">{{ $data->nama_produk }}</div>
                            </div>
                            <div class="row">
                                <div class="col-4 col-sm-4 text-right font-weight-bold">Harga Asli</div>
                                <div class="col-8 col-sm-8">{{ $data->harga_asli }}</div>
                            </div>
                            <div class="row">
                                <div class="col-4 col-sm-4 text-right font-weight-bold">Harga Coret</div>
                                <div class="col-8 col-sm-8">{{ $data->harga_coret }}</div>
                            </div>
                            <div class="row">
                                <div class="col-4 col-sm-4 text-right font-weight-bold">Tags</div>
                                <div class="col-8 col-sm-8">Goodbye</div>
                            </div>
                            <div class="row">
                                <div class="col-4 col-sm-4 text-right font-weight-bold">Kategori</div>
                                <div class="col-8 col-sm-8">{{ $data->kategori->kategori }}</div>
                            </div>
                            <div class="row">
                                <div class="col-4 col-sm-4 text-right font-weight-bold">Deskripsi Singkat</div>
                                <div class="col-8 col-sm-8">{{ $data->short_desc }}</div>
                            </div>
                            <div class="row">
                                <div class="col-4 col-sm-4 text-right font-weight-bold">Deskripsi</div>
                                <div class="col-8 col-sm-8">
                                    <p id="thisDesc">
                                        <script>
                                            var el = document.getElementById("thisDesc")
                                            var doc = new DOMParser().parseFromString("{{ $data->deskripsi }}", "text/html");

                                            console.log(typeof doc.firstChild.innerText)

                                            el.innerHTML = doc.firstChild.innerText
                                        </script>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="row">
                                @foreach ($data['gambar'] as $row)
                                    <img src="{{ asset('') }}/{{ $row->url }}" class="img-thumbnail col-3 m-1"
                                        alt="...">
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-11">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        Stok Produk
                    </div>

                    <div class="card-body row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Ukuran</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['stok'] as $row)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $row->size }}</td>
                                        <td>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-outline-secondary btn-min" type="button"
                                                        id="button-addon1"><i class="fa fa-minus"></i></button>
                                                </div>
                                                <input type="number" class="form-control col-sm-2 stokinput" placeholder=""
                                                    aria-label="example text with button addon"
                                                    aria-describedby="button-addon1" value="{{ $row->stok }}">

                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary btn-plus" type="button"
                                                        id="button-addon1"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('produk.editstok', $row->id) }}"
                                                class="btn btn-info btn-save">Simpan
                                                Perubahan</a>
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
    <!-- /.container-fluid -->
@endsection

@push('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(".btn-min").click(function() {
            var input = $(this).parent().parent().find('.stokinput');
            var value = parseInt(input.val());
            if (value > 0) {
                value--;
                input.val(value);
            }
        });

        $(".btn-plus").click(function() {
            var input = $(this).parent().parent().find('.stokinput');
            var value = parseInt(input.val());
            value++;
            input.val(value);
        });

        $('.btn-save').on('click', function(e) {
            e.preventDefault()
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Stok akan diubah!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, saya yakin!',
                cancelButtonText: 'Batalkan!'
            }).then((result) => {
                if (result.value) {
                    url = $(this).attr('href')
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            stok: $(this).parent().parent().find('.stokinput').val()
                        }
                    }).then(function(res) {
                        if (res.error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terjadi kesalahan pada server!'
                            })
                        } else {
                            Swal.fire(
                                'Berhasil!',
                                'Stok berhasil diubah.',
                                'success'
                            ).then(result => {
                                if (result.value) {
                                    location.reload()
                                }
                            })
                        }
                    })
                }
            })
        })
    </script>
@endpush
