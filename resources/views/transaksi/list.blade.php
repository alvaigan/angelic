<!-- LIST USER -->

@extends('layouts.admin.app')

@push('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    </meta>
@endpush

@section('content')
    <?php
    if (isset($page) && $page == 'neworder') {
        $title = 'List Order Masuk';
        $urldata = route('transaksi.neworder_data');
    } elseif (isset($page) && $page == 'dibayar') {
        $title = 'List Order Sudah Dibayar';
        $urldata = route('transaksi.dibayar_data');
    } elseif (isset($page) && $page == 'dikemas') {
        $title = 'List Order Dikemas';
        $urldata = route('transaksi.dikemas_data');
    } elseif (isset($page) && $page == 'dikirim') {
        $title = 'List Order Dikirim';
        $urldata = route('transaksi.dikirim_data');
    } elseif (isset($page) && $page == 'selesai') {
        $title = 'List Order Selesai';
        $urldata = route('transaksi.selesai_data');
    }
    ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
        </div>

        @include('templates.alerts')

        <!-- Content Row -->

        <div class="row">

            <!-- Area Table -->
            <div class="col-xl-12 col-lg-11">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        {{-- <a href="{{ route('tag.create') }}" class="btn btn-primary"> <i class="fa fa-plus"></i>
                            Tambah Order Masuk</a> --}}
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>Kode Pemesanan</th>
                                        <th>Nama Customer</th>
                                        <th>Lokasi</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

@push('js')
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        // Call the dataTables jQuery plugin
        // $(document).ready(function() {
        //     $('#dataTable').DataTable();
        // });

        $(function() {
            let table = $('#dataTable').DataTable({
                ajax: '{{ $urldata }}'
            })

            $(document).on('click', '.btn-success', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(res) {
                        console.log(res)
                        var titleModal = $('#myModalLabel').text('Update Status Transaksi');
                        var bodyModal = '';

                        bodyModal += `<div class="col-12">`;
                        bodyModal +=
                            `<select class="form-control" id="selectStatus">`;
                        bodyModal += res.data.status == 'baru' ?
                            `<option value="baru" selected>baru</option>` :
                            `<option value="baru">baru</option>`;
                        bodyModal += res.data.status == 'dibayar' ?
                            `<option value="dibayar" selected>dibayar</option>` :
                            `<option value="dibayar">dibayar</option>`;
                        bodyModal += res.data.status == 'dikemas' ?
                            `<option value="dikemas" selected>dikemas</option>` :
                            `<option value="dikemas">dikemas</option>`;
                        bodyModal += res.data.status == 'dikirim' ?
                            `<option value="dikirim" selected>dikirim</option>` :
                            `<option value="dikirim">dikirim</option>`;
                        bodyModal += res.data.status == 'selesai' ?
                            `<option value="selesai" selected>selesai</option>` :
                            `<option value="selesai">selesai</option>`;
                        bodyModal += `</select>`;
                        bodyModal += `</div>`;
                        $('#myModal .modal-body').html(bodyModal);
                        $('#myModal .btn-primary').show();
                        $('#myModal .btn-primary').text('Simpan Perubahan');
                        $('#myModal').modal('show');

                        $('#myModal .btn-primary').on('click', function() {
                            var status = $('#selectStatus').val()
                            var thisid = res.data.id

                            $.ajax({
                                url: "{{ url('administrator/transaksi/update_status') }}/" +
                                    thisid,
                                method: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    status: status
                                }
                            }).then((res) => {
                                if (res.error) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Terjadi kesalahan pada server!'
                                    })
                                } else {
                                    Swal.fire(
                                        'Berhasil!',
                                        'Status transaksi berhasil diubah.',
                                        'success'
                                    ).then(result => {
                                        if (result.value) {
                                            table.ajax.reload();
                                        }
                                        $('#myModal').modal('hide');
                                        $('#myModal .modal-body')
                                            .empty();
                                    })
                                }
                            })
                        })
                    }
                })
            })

            $(document).on('click', '.btn-info', function(e) {
                var kode = $('.form-control').val();
                if (kode == '') {
                    alert('Kode pemesanan tidak boleh kosong!');
                    return false;
                }

                $.ajax({
                    url: $(this).attr('data-url'),
                    type: 'GET',
                }).then(function(res) {
                    console.log(res.data.detail_transaksi)
                    if (res.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: res.error
                        })
                    } else {
                        var titleModal = $('#myModalLabel').text('Detail Transaksi');
                        var appendToModal = '';
                        appendToModal += '<div class="row">';
                        appendToModal += '<div class="col-md-6">';
                        appendToModal += '<h5>Kode Pemesanan</h5>';
                        appendToModal += '<p>' + res.data.kode_pemesanan + '</p>';
                        appendToModal += '</div>';
                        appendToModal += '<div class="col-md-6">';
                        appendToModal += '<h5>Status Pemesanan</h5>';
                        appendToModal += '<h5><span class="badge badge-secondary">' + res.data
                            .status +
                            '</span></h5>';
                        appendToModal += '</div>';
                        appendToModal += '</div>';
                        appendToModal += '<hr class="my-4">';
                        appendToModal += '<div class="row">';
                        appendToModal += '<div class="col-md-12">';
                        appendToModal += '<h5>Detail Pemesanan</h5>';
                        appendToModal += '<div class="table-responsive">';
                        appendToModal += '<table class="table table-bordered">';
                        appendToModal += '<thead>';
                        appendToModal += '<tr>';
                        appendToModal += '<th>Nama Produk</th>';
                        appendToModal += '<th>Ukuran</th>';
                        appendToModal += '<th>Harga</th>';
                        appendToModal += '<th>Jumlah</th>';
                        appendToModal += '<th>Subtotal</th>';
                        appendToModal += '</tr>';
                        appendToModal += '</thead>';
                        appendToModal += '<tbody>';
                        $.each(res.data.detail_transaksi, function(index, value) {
                            appendToModal += '<tr>';
                            appendToModal += '<td>' + value.produk.nama_produk + '</td>';
                            appendToModal += '<td>' + value.ukuran.ukuran + '</td>';
                            appendToModal += '<td>' + value.produk.harga_asli + '</td>';
                            appendToModal += '<td>' + value.qty + '</td>';
                            appendToModal += '<td>' + value.subtotal_harga + '</td>';
                            appendToModal += '</tr>';
                        });
                        appendToModal += '</tbody>';
                        appendToModal += '</table>';
                        appendToModal += '</div>';
                        appendToModal += '</div>';
                        appendToModal += '</div>';
                        appendToModal += '<hr class="my-4">';
                        appendToModal += '<div class="row">';
                        appendToModal += '<div class="col-md-12">';
                        appendToModal += '<h5>Total Pembayaran</h5>';
                        appendToModal += '<p>Rp ' + res.data.total_harga + '</p>';
                        appendToModal += '</div>';
                        appendToModal += '</div>';
                        appendToModal += '<hr class="my-4">';
                        appendToModal += '<div class="row">';
                        appendToModal += '<div class="col-md-12">';
                        appendToModal += '<h5>Alamat Pengiriman</h5>';
                        appendToModal += '<p>' + res.data.alamat + ' ' + res.data.rtrw + '</p>';
                        appendToModal += '<p>' + res.data.kota + ', ' + res.data.provinsi + ' ' +
                            res.data
                            .kode_pos + '</p>';
                        appendToModal += '</div>';
                        appendToModal += '</div>';
                        appendToModal += '<hr class="my-4">';
                        appendToModal += '<div class="row">';
                        appendToModal += '<div class="col-md-12">';
                        appendToModal += '<h5>Nama Penerima</h5>';
                        appendToModal += '<p>' + res.data.nama_lengkap + '</p>';
                        appendToModal += '</div>';
                        appendToModal += '</div>';
                        appendToModal += '<hr class="my-4">';
                        appendToModal += '<div class="row">';
                        appendToModal += '<div class="col-md-12">';
                        appendToModal += '<h5>No. Telepon</h5>';
                        appendToModal += '<p>' + res.data.no_telp + '</p>';
                        appendToModal += '</div>';
                        appendToModal += '</div>';
                        appendToModal += '<hr class="my-4">';
                        appendToModal += '<div class="row">';
                        appendToModal += '<div class="col-md-12">';
                        appendToModal += '<h5>Tanggal Pemesanan</h5>';
                        var date = new Date(res.data.created_at);
                        var formattedDate = date.getDate() + '-' + (date.getMonth() + 1) + '-' +
                            date
                            .getFullYear();
                        var formattedTime = date.getHours() + ':' + date.getMinutes() + ':' + date
                            .getSeconds();
                        appendToModal += '<p>' + formattedDate + ' ' + formattedTime + '</p>';
                        appendToModal += '</div>';
                        appendToModal += '</div>';

                        $('#myModal .modal-dialog').addClass('modal-lg');
                        $('#myModal .modal-body').html(appendToModal);
                        $('#myModal .btn-primary').hide();
                        $('#myModal').modal('show')
                    }
                })
            })

            // Sweet Alert
            $(document).on('click', '.btn-danger', function(e) {
                e.preventDefault()
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Anda tidak dapat mengembalikan data yang akan dihapus!",
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
                                _token: '{{ csrf_token() }}'
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
                                    'Transaksi telah dihapus.',
                                    'success'
                                ).then(result => {
                                    if (result.value) {
                                        table.ajax.reload();
                                    }
                                    $('#myModal').modal('hide');
                                })
                            }
                        })
                    }
                })
            })

            // $.fn.dataTable.ext.errMode = 'throw';
        })
    </script>
@endpush
