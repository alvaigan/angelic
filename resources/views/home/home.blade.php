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
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0"><a class="category-item"
                    href="{{route('catalogue', ['kategori'=> $kategori[0]['id']])}}"><img class="img-fluid"
                        src="{{asset('public/assets/store')}}/img/boardshort.jpg" alt=""><strong
                        class="category-item-title text-center">{{$kategori[0]['kategori']}}</strong></a></div>
            <div class="col-md-4 mb-4 mb-md-0"><a class="category-item mb-4"
                    href="{{route('catalogue', ['kategori'=> $kategori[1]['id']])}}"><img class="img-fluid"
                        src="{{asset('public/assets/store')}}/img/bodyarmy.jpg" alt=""><strong
                        class="category-item-title text-center">{{$kategori[1]['kategori']}}</strong></a><a
                    class="category-item" href="{{route('catalogue', ['kategori'=> $kategori[2]['id']])}}"><img
                        class="img-fluid" src="{{asset('public/assets/store')}}/img/tshirt.png" alt=""><strong
                        class="category-item-title text-center">{{$kategori[2]['kategori']}}</strong></a></div>
            <div class="col-md-4"><a class="category-item"
                    href="{{route('catalogue', ['kategori'=> $kategori[3]['id']])}}"><img class="img-fluid"
                        src="{{asset('public/assets/store')}}/img/hoodie.jpg" alt=""><strong
                        class="category-item-title text-center">{{$kategori[3]['kategori']}}</strong></a></div>
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
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="product text-center">
                    <div class="position-relative mb-3">
                        <div class="badge text-white badge-"></div><a class="d-block" href="#"><img
                                class="img-fluid w-100" src="{{asset('')}}/{{$item->gambar[0]->url}}" alt="..."></a>
                        <div class="product-overlay">
                            <ul class="mb-0 list-inline">
                                <!-- <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#"><i class="far fa-heart"></i></a></li> -->
                                <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark track-me-detail"
                                        href="{{ route('detail', $item->id) }}" data-produk="{{$item->nama_produk}}" data-kategori="{{$item->kategori->kategori}}">More Details</a></li>
                                <!-- <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#productView" data-toggle="modal"><i class="fas fa-expand"></i></a></li> -->
                            </ul>
                        </div>
                    </div>
                    <h6> <a class="reset-anchor track-me-detail"
                            href="{{ route('detail', $item->id) }}" data-produk="{{$item->nama_produk}}" data-kategori="{{$item->kategori->kategori}}">{{$item->nama_produk}}</a></h6>
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
                <div class="col-lg-4 mb-3 mb-lg-0">
                    <div class="d-inline-block">
                        <div class="media align-items-end">
                            <svg class="svg-icon svg-icon-big svg-icon-light">
                                <use xlink:href="#delivery-time-1"> </use>
                            </svg>
                            <div class="media-body text-left ml-3">
                                <h6 class="text-uppercase mb-1">On Time Delivery</h6>
                                <p class="text-small mb-0 text-muted">Good Packaging</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-3 mb-lg-0">
                    <div class="d-inline-block">
                        <div class="media align-items-end">
                            <svg class="svg-icon svg-icon-big svg-icon-light">
                                <use xlink:href="#helpline-24h-1"> </use>
                            </svg>
                            <div class="media-body text-left ml-3">
                                <h6 class="text-uppercase mb-1">24 x 7 service</h6>
                                <p class="text-small mb-0 text-muted">Responsive Everyday</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
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
                            src="{{asset('public/assets')}}/img/shopee.png" alt="shopee" class="col-lg-4"></a>
                    <a href="https://www.tokopedia.com/angelicofficial?source=universe&st=product" target="blank"><img
                            src="{{asset('public/assets')}}/img/tokopedia.png" alt="tokped" class="col-lg-4"></a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('js')
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

</script>
@endpush
