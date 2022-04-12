@extends('layouts.store.app')

@section('content')
    <section class="py-5 bg-light">
        <div class="container">
            <div class="jumbotron">

                <h1 class="display-5">Checkout Anda Berhasil!</h1>
                <p class="lead">Halo {{ isset($data) ? $data->nama_lengkap : '' }} Anda telah berhasil melakukan
                    pemesanan! </p>
                <p class="lead">Selanjutnya lakukan pembayaran melalui nomor rekening berikut : </p>
                <div class="mb-4 row col-12">
                    <img class="col-md-1" src="{{ asset('public/assets') }}/img/credit-card.png">
                    <h4 class="mr-auto mt-auto mb-auto">0012 345 678 910 | BCA | a/n Anwar Sanusi</h4>
                </div>

                <hr class="my-4">
                <p>
                    Untuk verifikasi kode pemesanan dan informasi lainnya, hubungi kami melalui Whatsapp.
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
