@extends('front.app')

@section('styles')
    <!-- SPECIFIC CSS -->
    <link href="{{ asset('front/css/listing.css') }}" rel="stylesheet">
@endsection

@section('content')
    <main>
        <div class="top_banner">
            <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
                <div class="container">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{ route("home") }}">Home</a></li>
                            <li><a href="{{ route("produk") }}">Produk</a></li>
                            <li>{{ $kategori->nama }}</li>
                        </ul>
                    </div>
                    <h1>Kategori - {{ $kategori->nama }}

                    </h1>
                </div>
            </div>
            <img src="img/bg_cat_shoes.jpg" class="img-fluid" alt="">
        </div>
        <!-- /top_banner -->
        <div id="stick_here"></div>
        <div class="toolbox elemento_stick">
            <div class="container">
                <ul class="clearfix">
                    <li>
                        <div class="sort_select">
                            <select name="sort" id="sort">
                                <option value="popularity" selected="selected">Sort by popularity</option>
                                <option value="rating">Sort by average rating</option>
                                <option value="date">Sort by newness</option>
                                <option value="price">Sort by price: low to high</option>
                                <option value="price-desc">Sort by price: high to
                            </select>
                        </div>
                    </li>
                    <li>
                        <a href="#0"><i class="ti-view-grid"></i></a>
                        <a href="listing-row-1-sidebar-left.html"><i class="ti-view-list"></i></a>
                    </li>
                    <li>
                        <a href="#0" class="open_filters">
                            <i class="ti-filter"></i><span>Filters</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /toolbox -->

        <div class="container margin_30">

            <div class="row">
                <aside class="col-lg-3" id="sidebar_fixed">
                    <div class="filter_col">
                        <div class="inner_bt"><a href="#" class="open_filters"><i class="ti-close"></i></a></div>
                        <form action="{{ route('produk-category', $kategori->id_kategori_produk) }}" method="GET">
                            <div class="filter_type version_2">
                                <h4><a href="#filter_1" data-bs-toggle="collapse" class="opened">Categories</a></h4>
                                <div class="collapse show" id="filter_1">
                                    <ul>
                                        @foreach ($list_kategori as $kategori_list)
                                            <li>
                                                <label class="container_check">{{ $kategori_list->nama }}
                                                    <small>{{ $kategori_list->produk->count() }}</small>
                                                    <input type="radio" name="cat"
                                                        value="{{ $kategori_list->id_kategori_produk }}"
                                                        @if ($kategori->id_kategori_produk == $kategori_list->id_kategori_produk) checked @endif>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- /filter_type -->
                            </div>
                            <!-- /filter_type -->
                            <div class="buttons">
                                <button type="submit" class="btn_1">Filter</button>
                                <a href="" class="btn_1 gray">Reset</a>
                            </div>
                        </form>
                    </div>
                </aside>
                <!-- /col -->
                <div class="col-lg-9">
                    <div class="row small-gutters">
                        @foreach ($list_produk as $produk)
                            <div class="col-6 col-md-4 col-xl-4">
                                <div class="grid_item">
                                    @if ($produk->created_at->diffInDays(now()) < 7)
                                        <span class="ribbon new">New</span>
                                    @endif
                                    <figure>
                                        <a href="{{ route("produk-detail", $produk->id_produk) }}">
                                            <img class="img-fluid lazy"
                                                src="{{ asset('front/img/products/product_placeholder_square_medium.jpg') }}"
                                                data-src="{{ $produk->getGambar() }}" alt="">
                                        </a>
                                    </figure>
                                    <a href="{{ route("produk-detail", $produk->id_produk) }}">
                                        <h3>{{ $produk->nama }}</h3>
                                    </a>
                                    <div class="price_box">
                                        <span class="new_price">@money($produk->harga)</span>
                                    </div>
                                    <ul>
                                        <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="Add to favorites"><i
                                                    class="ti-heart"></i><span>Add to favorites</span></a>
                                        </li>
                                        <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="Tambah ke Keranjang" id="addCart" onclick="addCart({{ $produk->id_produk }})"><i
                                                    class="ti-shopping-cart"></i><span>Tambah ke Keranjang</span></a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /grid_item -->
                            </div>
                        @endforeach
                    </div>
                    <!-- /row -->
                    <div class="pagination__wrapper">
                        <ul class="pagination">
                            @if ($list_produk->onFirstPage())
                                <li class="page-item previous">
                                    <a href="#" class="page-link"><i class="previous"></i></a>
                                </li>
                            @else
                                <li class="page-item previous">
                                    <a href="{{ route('produk-category', ['cat' => $kategori->id_kategori_produk, 'page' => $list_produk->currentPage() - 1]) }}"
                                        class="page-link bg-light"><i class="previous"></i></a>
                                </li>
                            @endif


                            @php
                                // Menghitung halaman pertama dan terakhir yang akan ditampilkan
                                $start = max($list_produk->currentPage() - 2, 1);
                                $end = min($start + 4, $list_produk->lastPage());
                            @endphp

                            @if ($start > 1)
                                <!-- Menampilkan tanda elipsis jika halaman pertama tidak termasuk dalam tampilan -->
                                <li>
                                    <a>...</a>
                                </li>
                            @endif

                            @foreach ($list_produk->getUrlRange($start, $end) as $page => $url)
                                @if ($page == $list_produk->currentPage())
                                    <li>
                                        <a href="{{ $url }}"
                                            class="{{ $page == $list_produk->currentPage() ? ' active' : '' }}">{{ $page }}</a>
                                    </li>
                                @else
                                    <li>
                                        <a
                                            href="{{ route('produk-category', ['cat' => $kategori->id_kategori_produk, 'page' => $page]) }}">
                                            {{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            @if ($end < $list_produk->lastPage())
                                <!-- Menampilkan tanda elipsis jika halaman terakhir tidak termasuk dalam tampilan -->
                                <li>
                                    <a>...</a>
                                </li>
                            @endif

                            @if ($list_produk->hasMorePages())
                                <li><a href="{{ route('produk-category', ['cat' => $kategori->id_kategori_produk, 'page' => $list_produk->currentPage() + 1]) }}"
                                        class="next" title="next page">&#10095;</a>
                                </li>
                            @else
                                <li><a href="#" class="next" title="next page">&#10095;</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->

        </div>
        <!-- /container -->
    </main>
@endsection

@section('scripts')
    <!-- SPECIFIC SCRIPTS -->
    <script src="{{ asset('front/js/sticky_sidebar.min.js') }}"></script>
    <script src="{{ asset('front/js/specific_listing.js') }}"></script>

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
