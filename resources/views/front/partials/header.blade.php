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
                                width="100" height="35"></a>
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
                                <a href="javascript:void(0);" class="show-submenu-mega">Kategori</a>
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
                                                    <li><a href="#">{{ $kategori1->nama }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-lg-3">
                                            <h3>&nbsp;</h3>
                                            <ul>
                                                @foreach ($chunks[1] as $kategori2)
                                                    <li><a href="#">{{ $kategori2->nama }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-lg-3">
                                            <h3>&nbsp;</h3>
                                            <ul>
                                                @foreach ($chunks[2] as $kategori3)
                                                    <li><a href="#">{{ $kategori3->nama }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-lg-3 d-xl-block d-lg-block d-md-none d-sm-none d-none">
                                            <div class="banner_menu">
                                                <a href="#0">
                                                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                                        data-src="{{ asset("ext_img/logo.png") }}" width="400" height="550"
                                                        alt="" class="img-fluid lazy">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /row -->
                                </div>
                                <!-- /menu-wrapper -->
                            </li>
                            <li>
                                <a href="">Tentang Kami</a>
                            </li>
                            <li>
                                <a href="#0">Pesanan Saya</a>
                            </li>
                        </ul>
                    </div>
                    <!--/main-menu -->
                </nav>
                <div class="col-xl-3 col-lg-2 d-lg-flex align-items-center justify-content-end text-end">
                    <a class="phone_top" href="tel://9438843343"><strong><span>Need Help?</span>+94
                            423-23-221</strong></a>
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
                                <a href="{{ route("cart") }}" id="cartCount" class="cart_bt"></a>
                                <div class="dropdown-menu">
                                    <ul id="listCart">

                                    </ul>
                                    <div class="total_drop">
                                        <div class="clearfix"><strong>Total</strong><span id="totalCart">Rp. 0</span></div>
                                        <a href="#" class="btn_1 outline">View Cart</a><a
                                            href="#" class="btn_1">Checkout</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /dropdown-cart-->
                        </li>
                        <li>
                        </li>
                        <li>
                            <div class="dropdown dropdown-access">
                                <a href="account.html" class="access_link"><span>Account</span></a>
                                <div class="dropdown-menu">
                                    <a href="account.html" class="btn_1">Sign In or Sign Up</a>
                                    <ul>
                                        <li>
                                            <a href="track-order.html"><i class="ti-truck"></i>Track your
                                                Order</a>
                                        </li>
                                        <li>
                                            <a href="account.html"><i class="ti-package"></i>My Orders</a>
                                        </li>
                                        <li>
                                            <a href="account.html"><i class="ti-user"></i>My Profile</a>
                                        </li>
                                        <li>
                                            <a href="help.html"><i class="ti-help-alt"></i>Help and Faq</a>
                                        </li>
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
