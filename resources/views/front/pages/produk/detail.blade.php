@extends('front.app')

@section('styles')
    <!-- SPECIFIC CSS -->
    <link href="{{ asset('front/css/product_page.css') }}" rel="stylesheet">
@endsection

@section('content')
<main>
    <div class="container margin_30">

        <div class="row">
            <div class="col-md-6">
                <div class="all">
                    <img src="{{ $produk->getGambar() }}" data-src="{{ $produk->getGambar() }}" alt="" class="img-fluid lazy" style="width: 100%;">
                    {{-- <div class="slider">
                        <div class="owl-carousel owl-theme main">
                            <div style="background-image: url(img/products/shoes/1.jpg);" class="item-box"></div>
                            <div style="background-image: url(img/products/shoes/2.jpg);" class="item-box"></div>
                            <div style="background-image: url(img/products/shoes/3.jpg);" class="item-box"></div>
                            <div style="background-image: url(img/products/shoes/4.jpg);" class="item-box"></div>
                            <div style="background-image: url(img/products/shoes/5.jpg);" class="item-box"></div>
                            <div style="background-image: url(img/products/shoes/6.jpg);" class="item-box"></div>
                        </div>
                        <div class="left nonl"><i class="ti-angle-left"></i></div>
                        <div class="right"><i class="ti-angle-right"></i></div>
                    </div>
                    <div class="slider-two">
                        <div class="owl-carousel owl-theme thumbs">
                            <div style="background-image: url(img/products/shoes/1.jpg);" class="item active"></div>
                            <div style="background-image: url(img/products/shoes/2.jpg);" class="item"></div>
                            <div style="background-image: url(img/products/shoes/3.jpg);" class="item"></div>
                            <div style="background-image: url(img/products/shoes/4.jpg);" class="item"></div>
                            <div style="background-image: url(img/products/shoes/5.jpg);" class="item"></div>
                            <div style="background-image: url(img/products/shoes/6.jpg);" class="item"></div>
                        </div>
                        <div class="left-t nonl-t"></div>
                        <div class="right-t"></div>
                    </div> --}}
                </div>
            </div>
            <div class="col-md-6">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Produk</a></li>
                        <li>Detail</li>
                    </ul>
                </div>
                <!-- /page_header -->
                <div class="prod_info">
                    <h1>{{ $produk->nama }}</h1>
                    <span class="rating"><i class="fa-solid fa-cash-register"></i><em>
                        {{$produk->pemesananItem->sum('jumlah')}} Terjual
                        </em></span>
                    <p><small>Deskripsi singkat:</small><br>
                        {{ Str::limit(strip_tags($produk->deskripsi), 100) }}
                    </p>
                    <div class="prod_options">
                        <div class="row">
                            <label class="col-xl-5 col-lg-5 col-md-6 col-6"><strong>Kategori</strong></label>
                            <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                                <div class="custom-select-form">
                                    <input type="text" value="{{ $produk->kategori->nama }}"  style="height: 40px; width: 100%; border: 1px solid #ccc; padding: 0 10px; border-radius: 5px;" readonly disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-xl-5 col-lg-5  col-md-6 col-6"><strong>Jumlah</strong></label>
                            <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                                <div class="numbers-row">
                                    <input type="text" value="1" id="quantity_1" class="qty2" name="quantity_1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 col-md-6">
                            <div class="price_main"><span class="new_price">@money($produk->harga)</span></div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="btn_add_to_cart"><a href="#0" class="btn_1">Tambah ke Keranjang</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->

    <div class="tabs_product">
        <div class="container">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a id="tab-A" href="#pane-A" class="nav-link active" data-bs-toggle="tab" role="tab">Deskripsi</a>
                </li>
                <li class="nav-item">
                    <a id="tab-B" href="#pane-B" class="nav-link" data-bs-toggle="tab" role="tab">Reviews</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- /tabs_product -->
    <div class="tab_content_wrapper">
        <div class="container">
            <div class="tab-content" role="tablist">
                <div id="pane-A" class="card tab-pane fade active show" role="tabpanel" aria-labelledby="tab-A">
                    <div class="card-header" role="tab" id="heading-A">
                        <h5 class="mb-0">
                            <a class="collapsed" data-bs-toggle="collapse" href="#collapse-A" aria-expanded="false" aria-controls="collapse-A">
                                Description
                            </a>
                        </h5>
                    </div>
                    <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="col-lg-6">
                                    <h3>Details</h3>
                                    <p>
                                        {!! $produk->deskripsi !!}
                                    </p>
                                </div>
                                <div class="col-lg-5">
                                    <h3>Spesifikasi</h3>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-striped">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Kategori</strong></td>
                                                    <td>
                                                        <a href="{{ route('produk-category', ["cat" => $produk->kategori_produk_id]) }}">{{ $produk->kategori->nama }}</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Stok</strong></td>
                                                    <td>{{ $produk->stok }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Berat</strong></td>
                                                    <td>{{ $produk->berat }} gram</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /table-responsive -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /TAB A -->
                <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                    <div class="card-header" role="tab" id="heading-B">
                        <h5 class="mb-0">
                            <a class="collapsed" data-bs-toggle="collapse" href="#collapse-B" aria-expanded="false" aria-controls="collapse-B">
                                Ulasan
                            </a>
                        </h5>
                    </div>
                    <div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
                        <div class="card-body">
                            <p>
                                Tidak ada ulasan untuk produk ini.
                            </p>
                            {{-- <div class="row justify-content-between">
                                <div class="col-lg-6">
                                    <div class="review_content">
                                        <div class="clearfix add_bottom_10">
                                            <span class="rating"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><em>5.0/5.0</em></span>
                                            <em>Published 54 minutes ago</em>
                                        </div>
                                        <h4>"Commpletely satisfied"</h4>
                                        <p>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="review_content">
                                        <div class="clearfix add_bottom_10">
                                            <span class="rating"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star empty"></i><i class="icon-star empty"></i><em>4.0/5.0</em></span>
                                            <em>Published 1 day ago</em>
                                        </div>
                                        <h4>"Always the best"</h4>
                                        <p>Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                            <div class="row justify-content-between">
                                <div class="col-lg-6">
                                    <div class="review_content">
                                        <div class="clearfix add_bottom_10">
                                            <span class="rating"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star empty"></i><em>4.5/5.0</em></span>
                                            <em>Published 3 days ago</em>
                                        </div>
                                        <h4>"Outstanding"</h4>
                                        <p>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="review_content">
                                        <div class="clearfix add_bottom_10">
                                            <span class="rating"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><em>5.0/5.0</em></span>
                                            <em>Published 4 days ago</em>
                                        </div>
                                        <h4>"Excellent"</h4>
                                        <p>Sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his.</p>
                                    </div>
                                </div>
                            </div>
                            <p class="text-end"><a href="leave-review.html" class="btn_1">Leave a review</a></p> --}}
                        </div>
                        <!-- /card-body -->
                    </div>
                </div>
                <!-- /tab B -->
            </div>
            <!-- /tab-content -->
        </div>
        <!-- /container -->
    </div>
    <!-- /tab_content_wrapper -->

    <div class="container margin_60_35">
        <div class="main_title">
            <h2>Produk Terkait</h2>
            <span>Produk</span>
            <p>
                Produk terkait yang mungkin Anda suka
            </p>
        </div>
        <div class="owl-carousel owl-theme products_carousel">

            @foreach ($produk_terkait as $terkait)
                    <div class="item">
                        <div class="grid_item">
                            @if ($terkait->created_at->diffInDays(now()) < 7)
                                <span class="ribbon new">New</span>
                            @endif
                            <figure>
                                <a href="{{ route("produk-detail", $terkait->id_produk) }}">
                                    <img class="img-fluid lazy"
                                        src="{{ asset('front/img/products/product_placeholder_square_medium.jpg') }}"
                                        data-src="{{ $terkait->getGambar() }}" alt="">
                                </a>
                            </figure>
                            <a href="{{ route("produk-detail", $terkait->id_produk) }}">
                                <h3>{{ $terkait->nama }}</h3>
                            </a>
                            <div class="price_box">
                                <span class="new_price">@money($terkait->harga)</span>
                            </div>
                            <ul>
                                <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a>
                                </li>
                                <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Add to cart" id="addCart" onclick="addCart({{ $terkait->id_produk }})"
                                        ><i class="ti-shopping-cart"></i><span>Add to
                                            cart</span></a>
                                </li>
                            </ul>
                        </div>
                        <!-- /grid_item -->
                    </div>
                @endforeach
        </div>
        <!-- /products_carousel -->
    </div>
    <!-- /container -->

    <div class="feat">
        <div class="container">
            <ul>
                <li>
                    <div class="box">
                        <i class="ti-gift"></i>
                        <div class="justify-content-center">
                            <h3>
                                Pengiriman terpercaya
                            </h3>
                            <p>
                                Pengiriman cepat dan aman
                            </p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="box">
                        <i class="ti-wallet"></i>
                        <div class="justify-content-center">
                            <h3>
                                Pembayaran aman
                            </h3>
                            <p>
                                100% pembayaran aman
                            </p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="box">
                        <i class="ti-headphone-alt"></i>
                        <div class="justify-content-center">
                            <h3>24/7 Support</h3>
                            <p>
                                Layanan pelanggan 24/7
                            </p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!--/feat-->

</main>
@endsection

@section('scripts')
    <!-- SPECIFIC SCRIPTS -->
    <script src="{{ asset('front/js/carousel_with_thumbs.js') }}"></script>
@endsection
