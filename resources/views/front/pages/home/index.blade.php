@extends('front.app')

@section('styles')
    <!-- SPECIFIC CSS -->
    <link href="{{ asset('front/css/home_1.css') }}" rel="stylesheet">
@endsection

@section('content')
    <main>
        <div id="carousel-home">
            <div class="owl-carousel owl-theme">
                <div class="owl-slide cover" style="background-image: url( {{ asset('ext_img/banner/banner_new_1.jpg') }});">
                    <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <div class="container">
                            <div class="row justify-content-center justify-content-md-start">
                                <div class="col-lg-6 static">
                                    <div class="slide-text white">
                                        <h2 class="owl-slide-animated owl-slide-title">Belanja Apa pun<br>dan dimana pun
                                        </h2>
                                        <p class="owl-slide-animated owl-slide-subtitle">
                                            Semua bisa anda dapatkan disini
                                        </p>
                                        <div class="owl-slide-animated owl-slide-cta"><a class="btn_1"
                                                href="{{ route('produk') }}" role="button">Belanja Sekarang</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/owl-slide-->
                <div class="owl-slide cover" style="background-image: url({{ asset('ext_img/banner/banner_new_2.jpg') }});">
                    <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <div class="container">
                            <div class="row justify-content-center justify-content-md-end">
                                <div class="col-lg-6 static">
                                    <div class="slide-text text-end white">
                                        <h2 class="owl-slide-animated owl-slide-title">Kami Menyediakan</h2>
                                        <p class="owl-slide-animated owl-slide-subtitle">
                                            Apa pun yang anda butuhkan ada disini
                                        </p>
                                        <div class="owl-slide-animated owl-slide-cta"><a class="btn_1"
                                                href="{{ route('produk') }}" role="button">Belanja Sekarang</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/owl-slide-->

                <div class="owl-slide cover" style="background-image: url({{ asset('ext_img/banner/banner_new_3.jpg') }});">
                    <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(255, 255, 255, 0.5)">
                        <div class="container">
                            <div class="row justify-content-center justify-content-md-start">
                                <div class="col-lg-12 static">
                                    <div class="slide-text text-center black">
                                        <h2 class="owl-slide-animated owl-slide-title">Tunggu apa lagi?</h2>
                                        <p class="owl-slide-animated owl-slide-subtitle">
                                            Ayo belanja sekarang juga
                                        </p>
                                        <div class="owl-slide-animated owl-slide-cta"><a class="btn_1"
                                                href="{{ route('produk') }}" role="button">Belanja Sekarang</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/owl-slide-->
                </div>
            </div>
            <div id="icon_drag_mobile"></div>
        </div>
        <!--/carousel-->

        <ul id="banners_grid" class="clearfix">
            <li>
                <a href="#0" class="img_container">
                    <img src="{{ asset('ext_img/banner/banner_new_4.jpg') }}" data-src="{{ asset('ext_img/banner/banner_new_4.jpg') }}"
                        alt="" class="lazy">
                    <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <h3>Aneka Makanan Ringan</h3>
                        <div><span class="btn_1">Belanja Sekarang</span></div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#0" class="img_container">
                    <img src="{{ asset('ext_img/banner/2.png') }}" data-src="{{ asset('ext_img/banner/2.png') }}"
                        alt="" class="lazy">
                    <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <h3>Aneka Minuman</h3>
                        <div><span class="btn_1">Belanja Sekarang</span></div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#0" class="img_container">
                    <img src="{{ asset('ext_img/banner/banner_new_7.jpg') }}" data-src="{{ asset('ext_img/banner/banner_new_7.jpg') }}"
                        alt="" class="lazy">
                    <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <h3>Kebutuhan Sehari-hari</h3>
                        <div><span class="btn_1">Belanja Sekarang</span></div>
                    </div>
                </a>
            </li>
        </ul>
        <!--/banners_grid -->

        <div class="container margin_60_35">
            <div class="main_title">
                <h2>Top Penjualan</h2>
                <span>Produk</span>
                <p>
                    Produk terlaris di minimarket kami
                </p>
            </div>
            <div class="row small-gutters">
                @foreach ($top_products as $top)
                    <div class="col-6 col-md-4 col-xl-3">
                        <div class="grid_item">
                            @if ($top->created_at->diffInDays(now()) < 7)
                                <span class="ribbon new">New</span>
                            @endif
                            <figure>
                                <a href="{{ route('produk-detail', $top->id_produk) }}">
                                    <img class="img-fluid lazy"
                                        src="{{ asset('front/img/products/product_placeholder_square_medium.jpg') }}"
                                        data-src="{{ $top->getGambar() }}" alt=""
                                        style="height: 250px; width: 100%; object-fit: cover;">
                                </a>
                            </figure>
                            <a href="{{ route('produk-detail', $top->id_produk) }}">
                                <h3>{{ $top->nama }}</h3>
                            </a>
                            <div class="price_box">
                                <span class="new_price">@money($top->harga)</span>
                            </div>
                            <ul>
                                <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a>
                                </li>
                                <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Tambah ke Keranjang" id="addCart"
                                        onclick="addCart({{ $top->id_produk }})"><i
                                            class="ti-shopping-cart"></i><span>Tambah ke Keranjang</span></a>
                                </li>
                            </ul>
                        </div>
                        <!-- /grid_item -->
                    </div>
                @endforeach
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->

        <div class="featured lazy" data-bg="url({{ asset('ext_img/banner/4.png') }})">
            <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                <div class="container margin_60">
                    <div class="row justify-content-center justify-content-md-start">
                        <div class="col-lg-6 wow" data-wow-offset="150">
                            <h3>SULTAN SWALAYAN 1 ACEH BARAT</h3>
                            <p>
                                Minimarket kami menyediakan berbagai macam kebutuhan sehari-hari anda, siap melayani anda
                            </p>
                            <div class="feat_text_block">
                                <a class="btn_1" href="listing-grid-1-full.html" role="button">Belanja Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /featured -->

        <div class="container margin_60_35">
            <div class="main_title">
                <h2>Produk Terbaru</h2>
                <span>Produk</span>
                <p>
                    Produk terbaru di minimarket kami
                </p>
            </div>
            <div class="owl-carousel owl-theme products_carousel">
                @foreach ($latest_products as $latest)
                    <div class="item">
                        <div class="grid_item">
                            @if ($latest->created_at->diffInDays(now()) < 7)
                                <span class="ribbon new">New</span>
                            @endif
                            <figure>
                                <a href="{{ route('produk-detail', $latest->id_produk) }}">
                                    <img class="owl-lazy"
                                        src="{{ asset('front/img/products/product_placeholder_square_medium.jpg') }}"
                                        data-src="{{ $latest->getGambar() }}" alt="">
                                </a>
                            </figure>
                            <a href="{{ route('produk-detail', $latest->id_produk) }}">
                                <h3>{{ $latest->nama }}</h3>
                            </a>
                            <div class="price_box">
                                <span class="new_price">@money($latest->harga)</span>
                            </div>
                            <ul>
                                <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip"
                                        data-bs-placement="left" title="Add to favorites"><i
                                            class="ti-heart"></i><span>Add to favorites</span></a>
                                </li>
                                <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip"
                                        data-bs-placement="left" title="Add to cart" id="addCart"
                                        onclick="addCart({{ $latest->id_produk }})"><i
                                            class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                            </ul>
                        </div>
                        <!-- /grid_item -->
                    </div>
                @endforeach

            </div>
            <!-- /products_carousel -->
        </div>
        <!-- /container -->

        <div class="bg_gray">
            <div class="container margin_30">
                <div id="brands" class="owl-carousel owl-theme">
                    <div class="item">
                        <a href="#0"><img src="img/brands/placeholder_brands.png"
                                data-src="{{ asset('front/img/brands/logo_1.png') }}" alt=""
                                class="owl-lazy"></a>
                    </div><!-- /item -->
                    <div class="item">
                        <a href="#0"><img src="img/brands/placeholder_brands.png"
                                data-src="{{ asset('front/img/brands/logo_2.png') }}" alt=""
                                class="owl-lazy"></a>
                    </div><!-- /item -->
                    <div class="item">
                        <a href="#0"><img src="img/brands/placeholder_brands.png"
                                data-src="{{ asset('front/img/brands/logo_3.png') }}" alt=""
                                class="owl-lazy"></a>
                    </div><!-- /item -->
                    <div class="item">
                        <a href="#0"><img src="img/brands/placeholder_brands.png"
                                data-src="{{ asset('front/img/brands/logo_4.png') }}" alt=""
                                class="owl-lazy"></a>
                    </div><!-- /item -->
                    <div class="item">
                        <a href="#0"><img src="img/brands/placeholder_brands.png"
                                data-src="{{ asset('front/img/brands/logo_5.png') }}" alt=""
                                class="owl-lazy"></a>
                    </div><!-- /item -->
                    <div class="item">
                        <a href="#0"><img src="img/brands/placeholder_brands.png"
                                data-src="{{ asset('front/img/brands/logo_6.png') }}" alt=""
                                class="owl-lazy"></a>
                    </div><!-- /item -->
                </div><!-- /carousel -->
            </div><!-- /container -->
        </div>
        <!-- /bg_gray -->

        <div class="container margin_60_35">
            <div class="main_title">
                <h2>Lokasi Kami</h2>
                <span>Lokasi</span>
                <p>
                    Kami memiliki Lokasi fisik yang bisa anda kunjungi
                </p>
            </div>
            <div class="row">

                <div class="col-lg-6">
                    <div class="d-flex align-items-center" style="height: 100px;">
                        <div class="flex-shrink-0">
                            <img src="{{ asset('ext_img/icon/location.png') }}" class="mr-3" alt="...">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5>Alamat</h5>
                            <p>
                                Jl. Nasional, Rundeng, Kec. Johan Pahlawan, Kabupaten Aceh Barat, Aceh 23681
                            </p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center" style="height: 100px;">
                        <div class="flex-shrink-0">
                            <img src="{{ asset('ext_img/icon/phone-call.png') }}" class="mr-3" alt="...">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5>Nomor Telp</h5>
                            <p>
                                0812-1234-5678
                            </p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center" style="height: 100px;">
                        <div class="flex-shrink-0">
                            <img src="{{ asset('ext_img/icon/mail.png') }}" class="mr-3" alt="...">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5>Email</h5>
                            <p>
                                test@test.com
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d994.8387644199145!2d96.13122625349096!3d4.150396525100313!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x303ec39573b8203b%3A0x3c7fc142b4b4ea2f!2sSultan%20Swalayan!5e0!3m2!1sid!2sid!4v1731805684393!5m2!1sid!2sid"
                        style="border:0; width: 100%; height: 400px;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>

                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </main>
@endsection

@section('scripts')
    <!-- SPECIFIC SCRIPTS -->
    <script src="{{ asset('front/js/carousel-home.min.js') }}"></script>

    @auth
        <script>
            function addCart(produk_id) {
                console.log(produk_id);

                $.ajax({
                    url: "{{ route('cart-add') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        produk_id: produk_id,
                        jumlah: 1
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            $('.top_panel').addClass('show');
                            $('.top_panel label').text(response.message);
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr);
                    }
                });

            }
        </script>
    @else
        <script>
            $('#addCart').click(function() {
                Swal.fire({
                    title: 'Anda belum login',
                    text: 'Silahkan login terlebih dahulu untuk menambahkan produk ke keranjang',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Login',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('login') }}";
                    }
                });
            });
        </script>
    @endauth
@endsection
