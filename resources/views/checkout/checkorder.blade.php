@extends('layouts.store.app')

@section('content')
    <section class="py-5 bg-light">
        <div class="container">
            <div class="jumbotron">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12 offset-md-3 float-md-center">
                    <h3 class="display-5 mb-5">Cek Status Pemesanan Anda Disini</h3>

                    <div class="mb-4 row col-12">
                        <form class="col-12" action="#" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Kode Pemesanan"
                                    aria-label="Kode Pemesanan" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn-check btn btn-primary" type="button"><i
                                            class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <hr class="my-4">
                    <a class="btn-direct btn btn-primary" href="{{ redirect()->back()->getTargetUrl() }}" role="button">
                        Kembali</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Informasi Pemesanan Anda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $('.btn-direct').on('click', function(e) {
            localStorage.removeItem('mappedToCheckout')
        });

        $('.btn-check').on('click', function(e) {
            var kode = $('.form-control').val();
            if (kode == '') {
                alert('Kode pemesanan tidak boleh kosong!');
                return false;
            }

            $.ajax({
                url: '{{ route('checkorder_process') }}',
                type: 'POST',
                data: {
                    kode: kode,
                    _token: '{{ csrf_token() }}'
                }
            }).then(function(res) {
                console.log(res.data.detail_transaksi)
                if (res.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: res.error
                    })
                } else {
                    var appendToModal = '';
                    appendToModal += '<div class="row">';
                    appendToModal += '<div class="col-md-6">';
                    appendToModal += '<h5>Kode Pemesanan</h5>';
                    appendToModal += '<p>' + res.data.kode_pemesanan + '</p>';
                    appendToModal += '</div>';
                    appendToModal += '<div class="col-md-6">';
                    appendToModal += '<h5>Status Pemesanan</h5>';
                    appendToModal += '<p><span class="badge badge-primary">' + res.data.status +
                        '</span></p>';
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
                    appendToModal += '<p>' + res.data.kota + ', ' + res.data.provinsi + ' ' + res.data
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
                    var formattedDate = date.getDate() + '-' + (date.getMonth() + 1) + '-' + date
                        .getFullYear();
                    var formattedTime = date.getHours() + ':' + date.getMinutes() + ':' + date
                        .getSeconds();
                    appendToModal += '<p>' + formattedDate + ' ' + formattedTime + '</p>';
                    appendToModal += '</div>';
                    appendToModal += '</div>';

                    $('.modal-body').append(appendToModal);
                    $('#myModal').modal('show')
                }
            })
        });

        $('#myModal').on('hidden.bs.modal', function() {
            $('.modal-body').empty();
        });
    </script>
@endpush
