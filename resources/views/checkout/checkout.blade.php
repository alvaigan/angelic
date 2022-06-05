@extends('layouts.store.app')

@section('content')
    <div class="container">

        @include('templates.alerts')
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                    <div class="col-lg-6">
                        <h1 class="h2 text-uppercase mb-0">Checkout</h1>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                                <li class="breadcrumb-item"><a class="text-dark" href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a class="text-dark" href="#">Cart</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5">
            <!-- BILLING ADDRESS-->
            <h2 class="h3 text-uppercase text-center mb-5">Billing Form</h2>
            <div class="row">
                <!-- ORDER SUMMARY-->
                <div class="col-lg-6 mb-5">

                    <div class="row mb-2">
                        <div class="col-12 card border-0 rounded-0 p-lg-4 bg-light">
                            <div class="card-body">
                                <h5 class="text-uppercase">Coupon</h5>
                                <small>Dapatkan potongan jika Anda memiliki kode kupon</small>
                                <div class="form-inline">
                                    <input class="input-kupon form-control form-control-sm mr-1 col-8" name="kode_kupon" type="text" placeholder="Coupon Code" id="nama_depan">
                                    <button class="btn btn-sm btn-primary col-3 btn-check-kupon">check</button>
                                </div>
                            </div>
                        </div>  
                    </div> 
 
                    <div class="row">
                        <div class="col-12 card border-0 rounded-0 p-lg-4 bg-light">
                            <div class="card-body">
                                <h5 class="text-uppercase mb-4">Detail Order</h5>
                                <ul class="list-unstyled mb-0 detail-order">
                                    <li class="d-flex align-items-center justify-content-between"><strong
                                            class="text-uppercase small fw-bold">Total</strong><span class="total">Rp
                                            0</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form class="needs-validation" action="{{ route('checkout_process') }}" method="post" novalidate>
                        @csrf
                        <div class="row gy-3">
                            <div class="col-lg-12">
                                <label class="form-label text-sm text-uppercase" for="nama_lengkap">Nama Lengkap </label>
                                <input class="form-control form-control-lg" name="nama_lengkap" type="text" id="nama_depan"
                                    required>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label text-sm text-uppercase" for="email">Email </label>
                                <input class="form-control form-control-lg" name="email" type="email" id="email"
                                    placeholder="e.g. Jason@example.com" required>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label text-sm text-uppercase" for="no_telp">No. HP / Whatsapp </label>
                                <input class="form-control form-control-lg" name="no_telp" type="tel" id="no_telp"
                                    placeholder="e.g. +02 245354745" required>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label text-sm text-uppercase" for="alamat">Alamat </label>
                                <textarea class="form-control form-control-lg" name="alamat" id="alamat" placeholder="Alamat lengkap"
                                    required></textarea>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label text-sm text-uppercase" for="provinsi">Provinsi </label>
                                <input class="form-control form-control-lg" name="provinsi" type="text" id="provinsi"
                                    required>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label text-sm text-uppercase" for="kota">Kota/Kabupaten </label>
                                <input class="form-control form-control-lg" name="kota" type="text" id="kota" required>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label text-sm text-uppercase" for="kecamatan">Kecamatan</label>
                                <input class="form-control form-control-lg" name="kecamatan" type="text" id="kecamatan"
                                    required>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label text-sm text-uppercase" for="kelurahan">Kelurahan </label>
                                <input class="form-control form-control-lg" name="kelurahan" type="text" id="kelurahan"
                                    required>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label text-sm text-uppercase" for="rtrw">RT / RW </label>
                                <input class="form-control form-control-lg" name="rtrw" type="text" id="rtrw" required>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label text-sm text-uppercase" for="kode_pos">Kode Pos </label>
                                <input class="form-control form-control-lg" name="kode_pos" type="text" id="kode_pos"
                                    required>
                            </div>

                            <input type="hidden" name="order" class="order" value="">

                            <div class="col-lg-12 form-group mt-3">
                                <button class="btn btn-dark" type="submit">Checkout</button>
                                <button class="btn btn-outline-dark cancel">Batalkan Order</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()

        $(".cancel").click(function(e) {
            e.preventDefault();
            let confirmation = confirm("Apakah order akan dibatalkan?");
            if (confirmation == true) {
                localStorage.removeItem('mappedToCheckout');
                window.location.href = "{{ route('home') }}";
            } else {
                return false;
            }
        });

        $(document).ready(function() {
            let mappedToCheckout = localStorage.getItem('mappedToCheckout');

            if (mappedToCheckout == null) {
                alert("Anda belum melakukan checkout");
                window.location.href = "{{ route('home') }}";
            }

            mappedToCheckout = JSON.parse(mappedToCheckout);

            let detail_order = mappedToCheckout.detail_order

            for (let row of detail_order) {
                let tagsToAppend = `<li class="d-flex align-items-center justify-content-between"><strong
                                        class="small fw-bold">${row.nama_produk} (${row.size}) x ${row.qty} </strong><span
                                        class="text-muted small">Rp ${row.sub_total}</span></li>
                                    <li class="border-bottom my-2"></li>`;
 
                $('.detail-order').prepend(tagsToAppend);
            }  
  
            $('.total').text("Rp " + mappedToCheckout.final_total);
   
            $('.order').val(JSON.stringify(mappedToCheckout));
        });
  
        $('.btn-check-kupon').click(function(e) {
            e.preventDefault(); 
            let kode_kupon = $('.input-kupon').val(); 

            $.ajax({
                url: "{{ url('/check_kupon/') }}/" + kode_kupon,
                type: "GET",
                success: function(response) {
                    if (response.status == false) {
                        toastr.warning("Kupon tidak tersedia!")
                    } else {
                        let isclaim_code = localStorage.getItem('isclaim_code');

                        if (isclaim_code == kode_kupon) {
                            toastr.warning("Kupon sudah digunakan!")
                            return false;
                        }

                        let total = parseInt($('.total').text().replace("Rp ", ""));
                        let potongan = parseInt(response.data.potongan);
                        let total_diskon = total - potongan;

                        $('.total').text("Rp " + total_diskon);

                        let mappedToCheckout = localStorage.getItem('mappedToCheckout');

                        mappedToCheckout = JSON.parse(mappedToCheckout);
                        mappedToCheckout.final_total = total_diskon;

                        localStorage.setItem('mappedToCheckout', JSON.stringify(mappedToCheckout));
                        localStorage.setItem('isclaim_code', kode_kupon);

                        $('.detail-order').append(`<li class="d-flex align-items-center justify-content-between"><strong
                                        class="small fw-bold">Potongan</strong><span
                                        class="text-muted small">- Rp ${potongan}</span></li>
                                    <li class="border-bottom my-2"></li>`);

                        toastr.success("Berhasil!", "Anda mendapatkan potongan harga sebesar Rp "+ response.data.potongan)
                    }
                }
            });
        });
    </script>
@endpush
