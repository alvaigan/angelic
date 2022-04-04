@extends('layouts.store.app')

@section('content')
    <div id="contain-all" class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                    <div class="col-lg-6">
                        <h1 class="h2 text-uppercase mb-0">Cart</h1>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                                <li class="breadcrumb-item"><a class="text-dark" href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5">
            <h2 class="h5 text-uppercase mb-4">Shopping cart</h2>
            <div class="row">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <!-- CART TABLE-->
                    <div class="table-responsive mb-4">
                        <table class="table text-nowrap">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 p-3" scope="col"> <strong
                                            class="text-sm text-uppercase">Product</strong></th>
                                    <th class="border-0 p-3" scope="col"> <strong
                                            class="text-sm text-uppercase">Size</strong></th>
                                    <th class="border-0 p-3" scope="col"> <strong
                                            class="text-sm text-uppercase">Price</strong></th>
                                    <th class="border-0 p-3" scope="col"> <strong
                                            class="text-sm text-uppercase">Quantity</strong></th>
                                    <th class="border-0 p-3" scope="col"> <strong
                                            class="text-sm text-uppercase">Total</strong></th>
                                    <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase"></strong>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="table-of-cart border-0">
                                @if (isset($data) && !empty($data))
                                    @foreach ($data as $row)
                                        <tr class="product-{{ $loop->iteration }}" data-product="{{ $row->id }}">
                                            <th class="ps-0 py-3 border-light" scope="row">
                                                <div class="d-flex align-items-center"><a
                                                        class="reset-anchor d-block animsition-link" href="#"><img
                                                            src="{{ asset('') }}/{{ $row->gambar[0]->url }}" alt="..."
                                                            width="70"></a>
                                                    <div class="ms-3 ml-4"><strong class="h6"><a
                                                                class="reset-anchor animsition-link product-name" href="#">
                                                                {{ $row->nama_produk }}</a></strong>
                                                    </div>
                                                </div>
                                            </th>
                                            <td class="p-3 align-middle border-light">
                                                <p class="mb-0 small product-size">{{ $row->size }}</p>
                                            </td>
                                            <td class="p-3 align-middle border-light">
                                                <p class="mb-0 small product-price">Rp {{ $row->harga_asli }}</p>
                                            </td>
                                            <td class="p-3 align-middle border-light">
                                                <div class="border d-flex align-items-center justify-content-between px-3">
                                                    <span
                                                        class="small text-uppercase text-gray headings-font-family">Quantity</span>
                                                    <div class="quantity">
                                                        <button class="dec-btn p-0"><i
                                                                class="fas fa-caret-left"></i></button>
                                                        <input
                                                            class="product-qty form-control form-control-sm border-0 shadow-0 p-0"
                                                            type="text" value="{{ $row->qty }}">
                                                        <button class="inc-btn p-0"><i
                                                                class="fas fa-caret-right"></i></button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-3 align-middle border-light">
                                                <p class="mb-0 small single-total">
                                                    Rp {{ $row->harga_asli * $row->qty }}</p>
                                                </p>
                                            </td>
                                            <td class="p-3 align-middle border-light"><a class="reset-anchor" href="#!"><i
                                                        class="fas fa-trash-alt small text-muted"></i></a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <h5>No items in cart</h5>
                                        </td>
                                    </tr>

                                    <!--  Modal -->
                                    @include('templates.store.modal_alert')
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- CART NAV-->
                    <div class="bg-light px-4 py-3">
                        <div class="row align-items-center text-center">
                            <div class="col-md-6 mb-3 mb-md-0 text-md-start"><a class="btn btn-link p-0 text-dark btn-sm"
                                    href="{{ route('catalogue') }}"><i class="fas fa-long-arrow-alt-left me-2">
                                    </i>Continue
                                    shopping</a>
                            </div>
                            <div class="col-md-6 text-md-end"><button
                                    class="btn btn-outline-dark btn-sm proccess-btn">Procceed to
                                    checkout<i class="fas fa-long-arrow-alt-right ms-2"></i></button></div>
                        </div>
                    </div>
                </div>
                <!-- ORDER TOTAL-->
                <div class="col-lg-4">
                    <div class="card border-0 rounded-0 p-lg-4 bg-light">
                        <div class="card-body">
                            <h5 class="text-uppercase mb-4">Cart total</h5>
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex align-items-center justify-content-between"><strong
                                        class="text-uppercase small font-weight-bold">Subtotal</strong><span
                                        class="text-muted small sub-total">$250</span></li>
                                <li class="border-bottom my-2"></li>
                                <li class="d-flex align-items-center justify-content-between mb-4"><strong
                                        class="text-uppercase small font-weight-bold">Total</strong><span
                                        class="final-total">$250</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('.dec-btn').on('click', function() {
                var $price = $(this).parent().parent().parent().parent().find('.product-price');
                var $total = $(this).parent().parent().parent().parent().find('.single-total');
                var $qty = $(this).parent().find('.product-qty');
                $total = stringToInt($total.text())
                $price = stringToInt($price.text())
                $qty = $qty.val()

                // $total = $total.text()
                // $price = $price.text()

                let calculate = $price * $qty

                $(this).parent().parent().parent().parent().find('.single-total').text("Rp " + calculate)

                calculateFinalTotal()
            });

            $('.inc-btn').on('click', function() {
                var $price = $(this).parent().parent().parent().parent().find('.product-price');
                var $total = $(this).parent().parent().parent().parent().find('.single-total');
                var $qty = $(this).parent().find('.product-qty');
                $total = stringToInt($total.text())
                $price = stringToInt($price.text())
                $qty = $qty.val()

                // $total = $total.text()
                // $price = $price.text()

                let calculate = $price * $qty

                $(this).parent().parent().parent().parent().find('.single-total').text("Rp " + calculate)

                calculateFinalTotal()
            });


            function calculateFinalTotal() {
                var totArray = [];
                for (let row = 0; row < $('tbody tr .single-total').length; row++) {
                    let singleTotal = $('tbody tr .single-total')[row]
                    let parsedSingTot = stringToInt($(singleTotal).text())

                    totArray.push(parsedSingTot)
                }

                $('.sub-total').text("Rp " + totArray.reduce(function(a, b) {
                    return a + b;
                }));

                $('.final-total').text("Rp " + totArray.reduce(function(a, b) {
                    return a + b;
                }));
            }

            calculateFinalTotal()

            function stringToInt(string) {
                string = string.replace('Rp ', '');
                string = string.replace('.', '');
                string = string.replace(',', '');
                string = string.replace(' ', '');
                string = string.replace(' ', '');
                string = parseInt(string);

                return string;
            }

            $('.proccess-btn').on('click', function() {
                let mappedToCheckout = {}
                let final_total = stringToInt($('.final-total').text())
                mappedToCheckout.final_total = final_total

                mappedToCheckout.detail_order = []

                for (let row of $('tbody tr')) {
                    let id = $(row).data('product')
                    let price = stringToInt($(row).find('.product-price').text())
                    let size = $(row).find('.product-size').text()
                    let qty = $(row).find('.product-qty').val()
                    let sub_total = stringToInt($(row).find('.single-total').text())
                    let nama_produk = $(row).find('.product-name').text().trim()

                    mappedToCheckout.detail_order.push({
                        id: id,
                        nama_produk: nama_produk,
                        price: price,
                        size: size,
                        qty: qty,
                        sub_total: sub_total
                    })
                }
                localStorage.removeItem('product')
                localStorage.setItem('mappedToCheckout', JSON.stringify(mappedToCheckout))

                window.location.href = "{{ route('checkout') }}"
            })
        });

        $('#productView').modal('show')
    </script>
@endpush
