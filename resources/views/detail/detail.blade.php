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
                                    src="{{ asset('') }}{{$img->url}}" alt="..."></div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-10 order-1 order-sm-2">
                        <div class="owl-carousel product-slider" data-slider-id="1">
                            @foreach ($data['gambar'] as $img)
                            <a class="d-block" href="{{ asset('') }}{{$img->url}}" data-lightbox="product"
                                title="Product item 1">
                                <img class="img-fluid" src="{{ asset('') }}{{$img->url}}" alt="...">
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- PRODUCT DETAILS-->
            <div class="col-lg-6">
                <!-- <ul class="list-inline mb-2">
                    <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                    <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                    <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                    <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                    <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                </ul> -->
                <h1>{{$data->nama_produk}}</h1>
                <!-- <p class="text-muted lead">$250</p> -->

                <br>
                <p class="text-small mb-4">{{ $data->short_desc }}</p>

                <ul class="list-unstyled small d-inline-block">
                    <li class="px-3 py-2 mb-1 bg-white text-muted"><strong
                            class="text-uppercase text-dark">Category:</strong><a class="reset-anchor ml-2"
                            href="#">{{$data->kategori->kategori}}</a></li>

                    <li class="px-3 py-2 mb-1 bg-white text-muted"><strong
                            class="text-uppercase text-dark">Tags:</strong><a class="reset-anchor ml-2"
                            href="#">{{implode(", ", json_decode($data->tags))}}</a></li>
                    <li class="px-3 py-2 mb-1 bg-white text-muted"><strong
                            class="text-uppercase text-dark">Checkout Our Products At:</strong>
                            <div class="row  mt-3">
                                <div class="col-12">
                                        <a href="{{$data->url_shopee}}" class="track-located-shopee" data-produk="{{$data->nama_produk}}" data-kategori="{{$data->kategori->kategori}}" target="_blank" rel="noopener noreferrer"><img class="col-sm-4" src="{{asset('public/assets')}}/img/shopee.png" alt=""></a>
                                        <a href="{{$data->url_tokped}}" class="track-located-tokopedia" data-produk="{{$data->nama_produk}}" data-kategori="{{$data->kategori->kategori}}" target="_blank" rel="noopener noreferrer"><img class="col-sm-4" src="{{asset('public/assets')}}/img/tokopedia.png" alt=""></a>
                                </div>
                            </div>
                    
                </ul>
            </div>
        </div>
        <!-- DETAILS TABS-->
        <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
            <li class="nav-item"><a class="nav-link active" id="description-tab" data-toggle="tab" href="#description"
                    role="tab" aria-controls="description" aria-selected="true">Description</a></li>
        </ul>
        <div class="tab-content mb-5" id="myTabContent">
            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                <div class="p-4 p-lg-5 bg-white">
                    <h6 class="text-uppercase">Product description </h6>
                    <p class="text-muted text-small mb-0">{{$data->deskripsi}}</p>
                </div>
            </div>
        </div>
        <!-- RELATED PRODUCTS-->
        <h2 class="h5 text-uppercase mb-4 {{ count($related) == 0 ? 'd-none' : '' }}">Related products</h2>
        <div class="row">
        @foreach ($related as $item)
              <!-- PRODUCT-->
            <div class="col-xl-3 col-lg-4 col-sm-6">
              <div class="product text-center">
                <div class="position-relative mb-3">
                  <div class="badge text-white badge-"></div><a class="d-block" href="#"><img class="img-fluid w-100" src="{{asset('public')}}/{{$item->gambar[0]->url}}" alt="..."></a>
                  <div class="product-overlay">
                    <ul class="mb-0 list-inline">
                      <!-- <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#"><i class="far fa-heart"></i></a></li> -->
                      <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark track-me-detail" data-produk="{{$item->nama_produk}}" data-kategori="{{$item->kategori->kategori}}" href="{{ route('detail', $item->id) }}">More Details</a></li>
                      <!-- <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#productView" data-toggle="modal"><i class="fas fa-expand"></i></a></li> -->
                    </ul>
                  </div>
                </div>
                <h6> <a class="reset-anchor track-me-detail" data-produk="{{$item->nama_produk}}" data-kategori="{{$item->kategori->kategori}}" href="{{ route('detail', $item->id) }}">{{$item->nama_produk}}</a></h6>
                <p class="small text-muted"></p>
              </div>
            </div>  
            @endforeach
        </div>
    </div>
</section>

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

        $('.track-located-shopee').on('click', () => {
          const produk = $('.track-located-shopee').attr('data-produk')
          const kategori = $('.track-located-shopee').attr('data-kategori')
          const url = $('.track-located-shopee').attr('href')

          fbq('track', 'RedirectToShopee', {
            content_name: produk,
            content_category: kategori,
            content_type: "product",
            delivery_category:"in_store",
            url: url
          })
        })

        $('.track-located-tokopedia').on('click', () => {
          const produk = $('.track-located-tokopedia').attr('data-produk')
          const kategori = $('.track-located-tokopedia').attr('data-kategori')
          const url = $('.track-located-tokopedia').attr('href')

          fbq('track', 'RedirectToTokopedia', {
            content_name: produk,
            content_category: kategori,
            content_type: "product",
            delivery_category:"in_store",
            url: url
          })
        })
</script>
@endpush
