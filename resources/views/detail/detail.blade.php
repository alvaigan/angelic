@extends('layouts.store.app')
@section('content')
    @include('templates.store.modal')
    <section class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-6">
                    <!-- PRODUCT SLIDER-->
                    <div class="row m-sm-0">
                        <div class="col-sm-2 p-sm-0 order-2 order-sm-1 mt-2 mt-sm-0">
                            <div class="owl-thumbs d-flex flex-row flex-sm-column" data-slider-id="1">
                                @foreach ($data['gambar'] as $img)
                                    <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0"><img class="w-100"
                                            src="{{ asset('') }}{{ $img->url }}" alt="..."></div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-sm-10 order-1 order-sm-2">
                            <div class="owl-carousel product-slider" data-slider-id="1">
                                @foreach ($data['gambar'] as $img)
                                    <a class="d-block" href="{{ asset('') }}{{ $img->url }}"
                                        data-lightbox="product" title="Product item 1">
                                        <img class="img-fluid" src="{{ asset('') }}{{ $img->url }}" alt="...">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PRODUCT DETAILS-->
                <div class="col-lg-6">
                    <h1>{{ $data->nama_produk }}</h1>
                    <!-- <p class="text-muted lead">$250</p> -->
                    <p class="text-muted lead">Rp {{ $data->harga_asli }} <sup>Rp <s>{{ $data->harga_coret }}</s></sup>
                    </p>
                    <br>

                    <p class="text-sm mb-4">{{ $data->short_desc }}</p>

                    <ul class="list-unstyled small d-inline-block">
                        <li class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">Product
                                Code:</strong><a class="reset-anchor ml-2" href="#">{{ $data->kode_produk }}</a></li>
                        <li class="px-3 py-2 mb-1 bg-white text-muted"><strong
                                class="text-uppercase text-dark">Category:</strong><a class="reset-anchor ml-2"
                                href="#">{{ $data->kategori->kategori }}</a></li>

                        <li class="px-3 py-2 mb-1 bg-white text-muted"><strong
                                class="text-uppercase text-dark">Tags:</strong>
                            @foreach ($data->tag as $tag)
                                <a class="reset-anchor ml-2" href="#">{{ $tag->tag }}</a>
                            @endforeach
                        </li>

                        <li class="px-3 py-2 mb-1 bg-white text-muted"><strong
                                class="text-uppercase text-dark">Stock:</strong>
                            @foreach ($data->stok as $stok)
                                <a class="reset-anchor ml-2" href="#">{{ $stok->size }} ({{ $stok->stok }})</a>
                            @endforeach
                        </li>

                        <li class="px-3 py-2 mb-1 bg-white text-muted"><strong
                                class="text-uppercase text-dark">Size:</strong>
                        </li>

                        <li class="px-3 py-2 mb-1 bg-white text-muted">
                            @foreach (isset($size) ? $size : [] as $s)
                                <a class="btn btn-light reset-anchor mb-2 ukuran" href="#">{{ $s->ukuran }}</a>
                            @endforeach
                        </li>
                    </ul>

                    <div class="row align-items-stretch mb-4 gx-0">
                        {{-- <div class="col-sm-7">
                            <div class="border d-flex align-items-center justify-content-between py-1 px-3"><span
                                    class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                                <div class="quantity">
                                    <button class="dec-btn p-0"><i class="fas fa-caret-left"></i></button>
                                    <input class="form-control border-0 shadow-0 p-0" type="text" value="1">
                                    <button class="inc-btn p-0"><i class="fas fa-caret-right"></i></button>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-sm-5"><a
                                class="btn-product-tocart btn btn-dark btn-sm w-100 h-100 d-flex align-items-center justify-content-center px-0"
                                href="#" data-productname="{{ $data->id }}">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- DETAILS TABS-->
            <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="description-tab" data-toggle="tab"
                        href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a></li>
            </ul>
            <div class="tab-content mb-5" id="myTabContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                    <div class="p-4 p-lg-5 bg-white">
                        <h6 class="text-uppercase">Product description </h6>
                        <p id="thisDesc" class="text-muted text-small mb-0">
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
            <!-- RELATED PRODUCTS-->
            <h2 class="h5 text-uppercase mb-4 {{ count($related) == 0 ? 'd-none' : '' }}">Related products</h2>
            <div class="row">
                @foreach ($related as $item)
                    <!-- PRODUCT-->
                    <div class="col-sm-2 col-6 col-md-3">
                        <div class="product text-center">
                            <div class="position-relative mb-3">
                                <div class="badge text-white badge-"></div><a class="d-block" href="#"><img
                                        class="img-fluid w-100" src="{{ asset('') }}/{{ $item->gambar[0]->url }}"
                                        alt="..."></a>
                                <div class="product-overlay">
                                    <ul class="mb-0 list-inline">
                                        <!-- <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#"><i class="far fa-heart"></i></a></li> -->
                                        <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark track-me-detail"
                                                data-produk="{{ $item->nama_produk }}"
                                                data-kategori="{{ $item->kategori->kategori }}"
                                                href="{{ route('detail', $item->id) }}">More Details</a></li>
                                        <!-- <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#productView" data-toggle="modal"><i class="fas fa-expand"></i></a></li> -->
                                    </ul>
                                </div>
                            </div>
                            <h6> <a class="reset-anchor track-me-detail" data-produk="{{ $item->nama_produk }}"
                                    data-kategori="{{ $item->kategori->kategori }}"
                                    href="{{ route('detail', $item->id) }}">{{ $item->nama_produk }}</a></h6>
                            <p class="small text-muted"></p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script type="text/javascript">
        var size = ""
        $('.ukuran').on('click', function(e) {
            size = $(this).text()
        })

        function searchSize(nameKey, myArray) {
            for (var i = 0; i < myArray.length; i++) {
                if (myArray[i].size == nameKey) {
                    return true;
                } else {
                    console.log(myArray[i])
                    return false
                }
            }
        }

        //add product to cart
        $('.btn-product-tocart').on('click', function(e) {

            if (size == "") {
                toastr.error('Size belum dipilih')
                return false
            }

            e.preventDefault()
            const produk = $(this).attr('data-productname')
            let tochart = []

            if (localStorage.getItem('product') != null) {
                let product = JSON.parse(localStorage.getItem('product'))
                let found = false
                for (var item of product) {
                    if (item.size == size) {
                        found = true
                    }
                }

                if (found == true) {
                    toastr.error('Size sudah ada di Cart')

                    return false
                } else {
                    product.push({
                        id: produk,
                        size: size,
                        qty: 1
                    })
                    localStorage.setItem('product', JSON.stringify(product))
                }

            } else {
                let idProduct = {
                    id: produk,
                    size: size,
                    qty: 1
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
