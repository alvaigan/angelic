@extends('layouts.store.app')
@section('content')
    <!--  Modal -->
    @include('templates.store.modal')
    <!-- HERO SECTION-->
    <div class="container">
        @include('home.banner')
        <!-- CATEGORIES SECTION-->
        <section class="pt-5">
            <header class="text-center">
                <p class="small text-muted small text-uppercase mb-1">Carefully created collections</p>
                <h2 class="h5 text-uppercase mb-4">Browse our categories</h2>
            </header>

            <div class="row mt-5">
                @if (isset($kategori))
                    @foreach ($kategori as $key => $item)
                        <?php
                        if ($key > 2) {
                            continue;
                        } else { ?>
                        <div class="col-md-3 col-6 mb-4 mb-md-0">
                            <div class="card border-second mb-3 text-center" style="height: 250px">
                                <div class="card-body text-primary">
                                    <h4 class="card-title mt-5 mb-5">{{ $item->kategori }}</h4>
                                    <a href="{{ route('catalogue') }}?kategori={{ $item->id }}"
                                        class="col-12 btn btn-dark mt-4">View</a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    @endforeach
                @endif
                <div class="col-md-3 col-6 mb-4 mb-md-0">
                    <div class="card border-second mb-3 text-center" style="height: 250px">
                        <div class="card-body text-secondary">
                            <h4 class="card-title mt-5 mb-5">Check Products</h4>
                            <a href="{{ route('catalogue') }}" class="col-12 btn btn-secondary mt-4">More <i
                                    class="fa fa-arrow-right text-small"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- TRENDING PRODUCTS-->
        <section class="py-5">
            <header>
                <p class="small text-muted small text-uppercase mb-1">Made the hard way</p>
                <h2 class="h5 text-uppercase mb-4">Top trending products</h2>
            </header>
            <div class="row">
                @foreach ($data as $item)
                    <!-- PRODUCT-->
                    <div class="col-sm-2 col-6 col-md-3">
                        <div class="product text-center">
                            <div class="position-relative mb-3">
                                <div class="badge text-white badge-"></div><a class="d-block" href="#"><img
                                        class="img-fluid w-100" src="{{ asset('') }}/{{ $item->gambar[0]->url }}"
                                        alt="..."></a>
                                <div class="product-overlay">
                                    <ul class="mb-0 list-inline">
                                        <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark track-me-detail"
                                                href="{{ route('detail', $item->id) }}"
                                                data-produk="{{ $item->nama_produk }}"
                                                data-kategori="{{ $item->kategori->kategori }}">More Details</a></li>

                                        {{-- <li class="list-inline-item mr-0"><a
                                                class="btn btn-sm btn-outline-dark btn-product-tochart" href="#"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Add to chart"
                                                data-productname="{{ $item->id }}"><i class="fas fa-plus"></i></a>
                                        </li> --}}
                                    </ul>
                                </div>
                            </div>
                            <h6> <a class="reset-anchor track-me-detail" href="{{ route('detail', $item->id) }}"
                                    data-produk="{{ $item->nama_produk }}"
                                    data-kategori="{{ $item->kategori->kategori }}">{{ $item->nama_produk }}</a></h6>
                            <p class="small text-muted"></p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <!-- SERVICES-->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row text-center">
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <div class="d-inline-block">
                            <div class="media align-items-end">
                                <svg class="svg-icon svg-icon-big svg-icon-light">
                                    <use xlink:href="#delivery-time-1"> </use>
                                </svg>
                                <div class="media-body text-left ml-3">
                                    <h6 class="text-uppercase mb-1">On Time Delivery</h6>
                                    <p class="text-small mb-0 text-muted">With Good Packaging</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <div class="d-inline-block">
                            <div class="media align-items-end">
                                <svg class="svg-icon svg-icon-big svg-icon-light">
                                    <use xlink:href="#helpline-24h-1"> </use>
                                </svg>
                                <div class="media-body text-left ml-3">
                                    <h6 class="text-uppercase mb-1">24 x 7 service</h6>
                                    <p class="text-small mb-0 text-muted">Responsible for service</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <div class="d-inline-block">
                            <div class="media align-items-end">
                                <svg class="svg-icon svg-icon-big svg-icon-light">
                                    <use xlink:href="#label-tag-1"> </use>
                                </svg>
                                <div class="media-body text-left ml-3">
                                    <h6 class="text-uppercase mb-1">Discount Up To 70%</h6>
                                    <p class="text-small mb-0 text-muted">Great Offers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- NEWSLETTER-->
        <section class="py-5">
            <div class="container p-0">
                <div class="row">
                    <div class="col-lg-6 mb-3 mb-lg-0">
                        <h5 class="text-uppercase">Let's be friends!</h5>
                        <p class="text-small text-muted mb-0">Our store is available in Shopee and Tokopedia. Click the logo
                            for visiting our store</p>
                    </div>
                    <div class="col-lg-6 pull-right">
                        <a href="https://shopee.co.id/angelic_official?smtt=0.0.9" target="blank"><img
                                src="{{ asset('public/assets') }}/img/shopee.png" alt="shopee"
                                class="col-lg-4 col-4"></a>
                        <a href="https://www.tokopedia.com/angelicofficial?source=universe&st=product" target="blank"><img
                                src="{{ asset('public/assets') }}/img/tokopedia.png" alt="tokped"
                                class="col-lg-4 col-4"></a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script type="text/javascript">
        // track facebook pixel
        $('.track-me-detail').on('click', () => {
            const produk = $('.track-me-detail').attr('data-produk')
            const kategori = $('.track-me-detail').attr('data-kategori')

            fbq('track', 'Detail', {
                content_name: produk,
                content_category: kategori,
                content_type: "product"
            })
        })


        $('#productView').modal('show')


        //add product to chart
        $('.btn-product-tochart').on('click', function(e) {
            e.preventDefault()
            const produk = $(this).attr('data-productname')
            let tochart = []

            function search(nameKey, myArray) {
                for (var i = 0; i < myArray.length; i++) {
                    if (myArray[i].id == nameKey) {
                        return myArray[i]
                    }
                }
            }

            if (localStorage.getItem('product') != null) {
                let product = JSON.parse(localStorage.getItem('product'))
                let found = search(produk, product)

                console.log(found)
                if (found != null) {
                    alert('Barang sudah ditambahkan! Silakan edit di keranjang ya')
                    return false
                } else {
                    product.push({
                        id: produk
                    })
                    localStorage.setItem('product', JSON.stringify(product))
                }

            } else {
                let idProduct = {
                    id: produk
                }

                tochart.push(idProduct)
                localStorage.setItem('product', JSON.stringify(tochart))
            }

            console.log(localStorage.getItem('product'))

            let currentproduct = JSON.parse(localStorage.getItem('product'))
            let inCart = 0,
                cartWording = ""
            if (currentproduct != null) {
                inCart = currentproduct.length
            }

            if (inCart == 0) {
                cartWording = " (" + inCart + ")"
            } else {
                cartWording = " (" + inCart + ") <i class='fa fa-dot-circle text-danger'></i>"
            }

            $('.cart-length').html(cartWording)
            toastr.success('Barang ditambahkan ke Cart!', 'Success')

            if (currentproduct == null) encoded = ""
            let encoded = encodeURIComponent(localStorage.getItem('product'))
            $('.tocart').attr('href', '{{ url('') }}/cart?data=' + encoded)
        })
    </script>
@endpush
