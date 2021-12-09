<!-- <section class="hero pb-3 bg-cover bg-center d-flex align-items-center"
    style="background: url({{-- asset('assets/store') --}}/img/hero-banner-alt.jpg)">
    <div class="container py-5">
        <div class="row px-4 px-lg-5">
            <div class="col-lg-6">
                <p class="text-muted small text-uppercase mb-2">New Inspiration 2020</p>
                <h1 class="h2 text-uppercase mb-3">20% off on new season</h1><a class="btn btn-dark"
                    href="shop.html">Browse collections</a>
            </div>
        </div>
    </div>
</section> -->

<section class="pb-3 bg-cover bg-center d-flex align-items-center">
    <div id="theCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#theCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#theCarousel" data-slide-to="1"></li>
            <li data-target="#theCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{asset('banner')}}/Artboard 1.png" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{asset('banner')}}/Artboard 4.png" alt="Third slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{asset('banner')}}/Artboard 5.png" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#theCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#theCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>
