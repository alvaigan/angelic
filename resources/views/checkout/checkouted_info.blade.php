@extends('layouts.store.app')

@section('content')
    <section class="py-5 bg-light">
        <div class="container">
            <div class="jumbotron">

                <h1 class="display-5">Checkout Anda Berhasil!</h1>
                <p class="lead mb-0">Halo <b>{{ isset($data) ? $data->nama_lengkap : '' }} </b>, Anda telah berhasil melakukan
                    pemesanan! </p>
                <p class="lead">Selanjutnya dapat melakukan pembayaran melalui salah satu nomor rekening berikut : </p>
                <div class="mb-4 row col-12">
                    <img class="col-md-1 col-6" src="{{ asset('public/assets') }}/img/credit-card.png">
                    <h4 class="mr-auto mt-auto mb-auto">131 00 0648331 9 | Mandiri | a/n Dani Permana</h4>
                </div>

                <div class="mb-4 row col-12">
                    <img class="col-md-1 col-6" src="{{ asset('public/assets') }}/img/credit-card.png">
                    <h4 class="mr-auto mt-auto mb-auto">148 04 74658 | BCA | a/n Dani Permana</h4>
                </div>

                <div class="mb-4 row col-12">
                    <img class="col-md-1 col-6" src="{{ asset('public/assets') }}/img/credit-card.png">
                    <h4 class="mr-auto mt-auto mb-auto">0286 01 046541 50 1 | BRI | a/n Dani Permana</h4>
                </div>

                <div class="mb-4 row col-12">
                    <img class="col-md-1 col-6" src="{{ asset('public/assets') }}/img/credit-card.png">
                    <h4 class="mr-auto mt-auto mb-auto">081395446682 | OVO | a/n Dani Permana</h4>
                </div>

                <hr class="my-4">
                <p>
                    Untuk konfirmasi kode pemesanan dan informasi lainnya, hubungi kami melalui Whatsapp.
                </p>
                <a class="btn-direct btn btn-primary" href="{{ route('direct_whatsapp', isset($data) ? $data->id : '') }}"
                    role="button">Lanjut ke Whatsapp</a>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script type="text/javascript">
        $('.btn-direct').on('click', function(e) {
            localStorage.removeItem('mappedToCheckout')
        });
    </script>
@endpush
