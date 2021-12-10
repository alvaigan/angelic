<section class="pb-3 bg-cover bg-center d-flex align-items-center">
    <div id="theCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#theCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#theCarousel" data-slide-to="1"></li>
            <li data-target="#theCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{asset('public/banner')}}/Artboard 1.png" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{asset('public/banner')}}/Artboard 4.png" alt="Third slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{asset('public/banner')}}/Artboard 5.png" alt="Third slide">
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
