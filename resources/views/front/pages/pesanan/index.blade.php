@extends('front.app')

@section('styles')
    <!-- SPECIFIC CSS -->
    <link href="{{ asset('front/css/blog.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/cart.css') }}" rel="stylesheet">
@endsection

@section('content')
    <main>
        <div class="top_banner">
            <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
                <div class="container">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('pesanan-saya') }}">Pesanan Saya</a></li>
                            {{-- <li>Page active</li> --}}
                        </ul>
                    </div>
                    <h1>Pesanan Saya
                    </h1>
                </div>
            </div>
            <img src="{{ asset('front/img/bg_cat_shoes.jpg') }}" class="img-fluid" alt="">
        </div>
        <!-- /top_banner -->

        <div id="stick_here"></div>
        <div class="toolbox elemento_stick">
            <div class="container">
            </div>
        </div>
        <!-- /toolbox -->

        <div class="container margin_30">
            <!-- Button trigger modal -->

            <div class="row">
                @forelse ($list_pesanan as $pesanan)
                    <div class="col-lg-12">
                        <div class="singlepost">
                            <h5>status :
                                @if ($pesanan->status == 'belum bayar')
                                    <span style="color: red">{{ $pesanan->status }}</span>
                                @elseif ($pesanan->status == 'sudah bayar')
                                    <span style="color: yellow">{{ $pesanan->status }}</span>
                                @elseif ($pesanan->status == 'sedang diproses')
                                    <span style="color: orange">{{ $pesanan->status }}</span>
                                @elseif ($pesanan->status == 'sedang dikirim')
                                    <span style="color: blue">{{ $pesanan->status }}</span>
                                @elseif ($pesanan->status == 'selesai')
                                    <span style="color: green">{{ $pesanan->status }}</span>
                                @elseif ($pesanan->status == 'dibatalkan')
                                    <span style="color: rgb(46, 10, 10)">{{ $pesanan->status }}</span>
                                @endif
                            </h5>
                            <div class="postmeta">
                                <table>

                                    <tr valign="top">
                                        <td style="width: 150px"><i class="fa-solid fa-map-pin"></i>&nbsp; Alamat Pengiriman
                                        </td>
                                        <td style="width: 15px">:</td>
                                        <td>{{ $pesanan->pengiriman_alamat }} <br>
                                            {{ $pesanan->pengiriman_kota }} - {{ $pesanan->pengiriman_provinsi }}
                                        </td>
                                    </tr>
                                    <tr valign="top">
                                        <td><i class="fa-solid fa-truck"></i>&nbsp; Kurir</td>
                                        <td> : </td>
                                        <td>{{ $pesanan->pengiriman_kurir }}</td>
                                    </tr>
                                    <tr valign="top">
                                        <td><i class="fa-solid fa-box"></i>&nbsp; No Resi</td>
                                        <td> : </td>
                                        <td>{{ $pesanan->resi_pengiriman ?? '-' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <!-- /post meta -->
                            <div class="post-content">
                                <table class="table table-striped cart-list">
                                    <thead>
                                        <tr>
                                            <th>
                                                produk
                                            </th>
                                            <th>
                                                harga
                                            </th>
                                            <th>
                                                Jumlah
                                            </th>
                                            <th>
                                                Subtotal
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pesanan->pemesananItem as $element)
                                            <tr>
                                                <td>
                                                    <div class="thumb_cart">
                                                        <img src="{{ $element->produk?->getGambar() }}"
                                                            data-src="{{ $element->produk?->getGambar() }}" class="lazy"
                                                            alt="Image">
                                                    </div>
                                                    <span class="item_cart"><a
                                                            href="{{ route('produk-detail', $element->produk_id) }}"
                                                            style="color: black">{{ $element->produk?->nama }}</a></span>
                                                </td>
                                                <td>
                                                    <strong>@money($element->produk?->harga)</strong>
                                                </td>
                                                <td>
                                                    <strong>{{ $element->jumlah }}</strong>
                                                </td>
                                                <td>
                                                    <strong>@money($element->total_harga)</strong>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="box_cart">
                                    <div class="container">
                                        <div class="row justify-content-end">
                                            <div class="col-xl-4 col-lg-4 col-md-6">
                                                <ul>
                                                    <li>
                                                        <span>Subtotal</span> @money($pesanan->total_harga_produk)
                                                    </li>
                                                    <li>
                                                        <span>Ongkos Kirim</span> @money($pesanan->pengiriman_ongkir)
                                                    </li>
                                                    <li>
                                                        <span>Total</span> @money($pesanan->total_harga)
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @if ($pesanan->status != 'dibatalkan')
                                    <div class="postmeta text-end mb-3">
                                        <ul>
                                            <li style="font-size: 20px">
                                                <a href="#"><i class="fa-solid fa-file-invoice-dollar"></i>
                                                    Cetak Invoice
                                                </a>
                                            </li>

                                            @if ($pesanan->status == 'belum bayar')
                                                <li style="font-size: 20px">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#batalkanpesanan-{{ $pesanan->id_pemesanan }}">
                                                        <i class="ti-trash"></i>
                                                        Batalkan Pesanan
                                                    </a>
                                                </li>
                                                <li style="font-size: 20px">
                                                    <a href="#"><i class="ti-credit-card"></i>
                                                        Bayar Sekarang
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                @endif

                            </div>
                            <!-- /post -->
                        </div>
                        <!-- /single-post -->

                    </div>

                @empty
                    <div class="col-lg-12">
                        <div class="singlepost text-center">
                            <h5>Belum ada pesanan</h5>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
        <!-- /container -->
    </main>


@endsection

@section('scripts')
    <!-- SPECIFIC SCRIPTS -->
    <script src="{{ asset('front/js/sticky_sidebar.min.js') }}"></script>
    <script src="{{ asset('front/js/specific_listing.js') }}"></script>
@endsection
