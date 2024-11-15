@php
    $kategori_produk = \App\Models\KategoriProduk::all();

@endphp
<header class="version_1">
    <div class="layer"></div><!-- Mobile menu overlay mask -->
    <div class="main_header">
        <div class="container">
            <div class="row small-gutters">
                <div class="col-xl-3 col-lg-3 d-lg-flex align-items-center">
                    <div id="logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('ext_img/logo.png') }}" alt=""
                                height="55"></a>
                    </div>
                </div>
                <nav class="col-xl-6 col-lg-7">
                    <a class="open_close" href="javascript:void(0);">
                        <div class="hamburger hamburger--spin">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </a>
                    <!-- Mobile menu button -->
                    <div class="main-menu">
                        <div id="header_menu">
                            <a href="index.html"><img src="img/logo_black.svg" alt="" width="100"
                                    height="35"></a>
                            <a href="#" class="open_close" id="close_in"><i class="ti-close"></i></a>
                        </div>
                        <div id="header_menu">
                            <a href="index.html"><img src="img/logo_black.svg" alt="" width="100"
                                    height="35"></a>
                            <a href="#" class="open_close" id="close_in"><i class="ti-close"></i></a>
                        </div>
                        <ul>
                            <li>
                                <a href="{{ route('home') }}">Home</a>
                            </li>
                            <li>
                                <a href="{{ route('produk') }}">Produk</a>
                            </li>
                            <li class="megamenu submenu">
                                <a href="" class="show-submenu-mega">Kategori</a>
                                <div class="menu-wrapper">
                                    <div class="row small-gutters">
                                        @php
                                            $kategori_produk = \App\Models\KategoriProduk::all();

                                            // Hitung jumlah data
                                            $count = $kategori_produk->count();
                                            // Hitung jumlah data per kolom
                                            $per_column = ceil($count / 3);
                                            // Bagi data menjadi 3 bagian
                                            $chunks = $kategori_produk->chunk($per_column);

                                        @endphp
                                        <div class="col-lg-3">
                                            <h3>Kategori Produk</h3>
                                            <ul>
                                                @foreach ($chunks[0] as $kategori1)
                                                    <li><a
                                                            href="{{ route('produk-category', ['cat' => $kategori1->id_kategori_produk]) }}">{{ $kategori1->nama }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-lg-3">
                                            <h3>&nbsp;</h3>
                                            <ul>
                                                @foreach ($chunks[1] as $kategori2)
                                                    <li><a
                                                            href="{{ route('produk-category', ['cat' => $kategori1->id_kategori_produk]) }}">{{ $kategori2->nama }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-lg-3">
                                            <h3>&nbsp;</h3>
                                            <ul>
                                                @foreach ($chunks[2] as $kategori3)
                                                    <li><a
                                                            href="{{ route('produk-category', ['cat' => $kategori1->id_kategori_produk]) }}">{{ $kategori3->nama }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-lg-3 d-xl-block d-lg-block d-md-none d-sm-none d-none">
                                            <div class="banner_menu">
                                                <a href="#0">
                                                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                                        data-src="{{ asset('ext_img/logo.png') }}" width="400"
                                                        height="550" alt="" class="img-fluid lazy">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /row -->
                                </div>
                                <!-- /menu-wrapper -->
                            </li>
                            <li>
                                <a href="{{ route('about') }}">Tentang Kami</a>
                            </li>
                            @role('pembeli')
                                <li>
                                    <a href="{{ route('pesanan-saya') }}">Pesanan Saya</a>
                                </li>
                            @endrole
                        </ul>
                    </div>
                    <!--/main-menu -->
                </nav>
                <div class="col-xl-3 col-lg-2 d-lg-flex align-items-center justify-content-end text-end">
                    <a class="phone_top"
                        href="https://wa.me/6285319156748?text=Halo%20Admin%20Saya%20Mau%20Tanya%20Tentang%20Produk%20Anda"
                        target="_blank"><strong><span>Butuh Bantuan?</span>
                            +62 853-1915-6748
                        </strong></a>
                </div>
            </div>
            <!-- /row -->
        </div>
    </div>
    <!-- /main_header -->

    <div class="main_nav Sticky">
        <div class="container">
            <div class="row small-gutters">
                <div class="col-xl-3 col-lg-3 col-md-3">
                    <nav class="categories">
                        {{-- <ul class="clearfix">
                            <li><span>
                                    <a href="#">
                                        <span class="hamburger hamburger--spin">
                                            <span class="hamburger-box">
                                                <span class="hamburger-inner"></span>
                                            </span>
                                        </span>
                                        Kategori
                                    </a>
                                </span>
                                <div id="menu">
                                    @foreach ($kategori_produk as $kategori1)
                                        <ul>
                                            <li><span><a href="#0">{{ $kategori1->nama }}</a></span></li>
                                        </ul>
                                    @endforeach
                                </div>
                            </li>
                        </ul> --}}
                    </nav>
                </div>
                <div class="col-xl-6 col-lg-7 col-md-6 d-none d-md-block">
                    <div class="custom-search-input">
                        <form action="{{ route('produk') }}" method="get">

                            <input type="text" placeholder="Cari yang anda butuhkan disini" name="q"
                                value="{{ request()->q ?? '' }}">
                            <button type="submit"><i class="header-icon_search_custom"></i></button>
                        </form>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-2 col-md-3">
                    <ul class="top_tools">
                        <li>
                            <div class="dropdown dropdown-cart">
                                <a href="{{ route('cart') }}" id="cartCount" class="cart_bt"></a>
                                <div class="dropdown-menu">
                                    <ul id="listCart">

                                    </ul>
                                    <div class="total_drop">
                                        <div class="clearfix"><strong>Total</strong><span id="totalCart">Rp. 0</span>
                                        </div>
                                        <a href="{{ route('cart') }}" class="btn_1 outline">Lihat Keranjang</a><a
                                            href="{{ route('checkout') }}" class="btn_1">Checkout</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /dropdown-cart-->
                        </li>
                        <li>
                        </li>
                        <li>
                            <div class="dropdown dropdown-access">
                                <a href="#" class="access_link"><span>Account</span></a>
                                <div class="dropdown-menu">
                                    @guest
                                        <a href="{{ route('login') }}" class="btn_1">Sign In or Sign Up</a>
                                    @endguest
                                    <ul>
                                        @auth
                                            @role('pembeli')
                                                <li>
                                                    <a href="#"><i class="ti-user"></i>
                                                        {{ Auth::user()->pembeli?->nama }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('pesanan-saya') }}"><i class="ti-package"></i>Pesanan
                                                        Saya</a>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="#"><i class="ti-user"></i>
                                                        {{ Auth::user()->pegawai?->nama }}
                                                    </a>
                                                </li>
                                            @endrole
                                            <li>
                                                <a href="{{ route('logout') }}"><i
                                                        class="fa-solid fa-right-from-bracket"></i>Logout</a>
                                            </li>
                                        @endauth

                                    </ul>
                                </div>
                            </div>
                            <!-- /dropdown-access-->
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="btn_search_mob"><span>Search</span></a>
                        </li>
                        <li>
                            <a href="#menu" class="btn_cat_mob">
                                <div class="hamburger hamburger--spin" id="hamburger">
                                    <div class="hamburger-box">
                                        <div class="hamburger-inner"></div>
                                    </div>
                                </div>
                                Kategori
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <div class="search_mob_wp">
            <form action="{{ route('produk') }}" method="get">
                <input type="text" class="form-control" placeholder="Cari yang anda butuhkan disini"
                    name="q" value="{{ request()->q ?? '' }}">
                <input type="submit" class="btn_1 full-width" value="Search">
            </form>
        </div>
        <!-- /search_mobile -->
    </div>
    <!-- /main_nav -->
</header>
