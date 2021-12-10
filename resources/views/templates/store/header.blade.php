<!-- navbar-->
<header class="header bg-white">
    <div class="container px-0 px-lg-3">
        <!-- <nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0"><a class="navbar-brand" href="{{-- url('/') --}}"><span class="font-weight-bold text-uppercase text-dark">Angelic</span></a> -->
        <nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0">

            <a class="navbar-brand" href="{{url('/')}}">
                <div class="row">
                    <img src="{{asset('public/assets/img')}}/angelic.png" class="w-25 mx-auto" alt="ANGELIC HOLYNPURE">
                </div>
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <!-- Link--><a class="nav-link {{ $page == 'home'? 'active':''}}" href="{{route('home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <!-- Link--><a class="nav-link {{ $page == 'catalogue'? 'active':''}}" href="{{route('catalogue')}}">Catalogue</a>
                    </li>
                    <li class="nav-item">
                        <!-- Link--><a class="nav-link {{ $page == 'about'? 'active':''}}" href="{{-- route('about') --}}">About</a>
                    </li>
                    <li class="nav-item">
                        <!-- Link--><a class="nav-link {{ $page == 'contact'? 'active':''}}" href="{{-- route('contact') --}}">Contact</a>
                    </li>
                    <!-- <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" id="pagesDropdown" href="#"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
                        <div class="dropdown-menu mt-3" aria-labelledby="pagesDropdown"><a
                                class="dropdown-item border-0 transition-link" href="#">Homepage</a><a
                                class="dropdown-item border-0 transition-link" href="shop.html">Category</a><a
                                class="dropdown-item border-0 transition-link" href="detail.html">Product detail</a><a
                                class="dropdown-item border-0 transition-link" href="cart.html">Shopping cart</a><a
                                class="dropdown-item border-0 transition-link" href="checkout.html">Checkout</a></div>
                    </li> -->
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a target="_blank"
                            href="https://api1.linkr.bio/callbacks/go?url=https%3A%2F%2Fapi.whatsapp.com%2Fsend%3Fphone%3D6281395446682&hash=L8BybY7E&type=1&id=lRJ4bB1E">
                        <i class="fas fa-phone mr-2 text-gray"></i>Contact Us via Whatsapp</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
