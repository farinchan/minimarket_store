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
            <img src="{{ asset("ext_img/banner/banner_new_5.jpg")}}" class="img-fluid" alt="">
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
                                @if ($pesanan->status == 'belum bayar' && $pesanan->pembayaran->isNotEmpty())
                                    <h5> Riwayat Pembayaran</h5>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Tanggal Pembayaran</th>
                                                <th scope="col">Bukti Pembayaran</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pesanan->pembayaran as $pembayaran)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ Carbon\Carbon::parse($pembayaran->created_at)->format('d-m-Y H:i:s') }}
                                                    <td>
                                                        <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" style="color: rgb(67, 74, 105)"
                                                            target="_blank"><i class="fa-solid fa-file-invoice-dollar"></i>&nbsp;Lihat Bukti Pembayaran</a>
                                                    </td>
                                                    <td>
                                                        @if ($pembayaran->status == 'pending')
                                                            <span style="color: orange">Menunggu konfirmasi</span>
                                                        @elseif ($pembayaran->status == 'success')
                                                            <span style="color: green">Sukses</span>
                                                        @elseif ($pembayaran->status == 'expired')
                                                            <span style="color: red">Pembayaran Ditolak</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>

                                    </table>
                                    <hr>
                                @endif

                                @if ($pesanan->status != 'dibatalkan')
                                    <div class="postmeta text-end mb-3">
                                        <ul>
                                            <li style="font-size: 20px">
                                                <a href="{{ route('pesanan-invoice', $pesanan->id_pemesanan) }}"><i
                                                        class="fa-solid fa-file-invoice-dollar"></i>
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
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#pembayaran-{{ $pesanan->id_pemesanan }}">
                                                        <i class="ti-credit-card"></i>
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
                    <div style="height: 500px" ></div>
                @endforelse
            </div>

            <div class="pagination__wrapper">
                <ul class="pagination">
                    @if ($list_pesanan->onFirstPage())
                        <li class="page-item previous">
                            <a href="#" class="page-link"><i class="previous"></i></a>
                        </li>
                        <li>
                            <a href="#" class="prev" title="previous page">&#10094;</a>
                        </li>
                    @else
                        <li class="page-item previous">
                            <a href="{{ $list_pesanan->previousPageUrl() }}" class="page-link bg-light"><i
                                    class="previous"></i></a>
                        </li>
                        <li>
                            <a href="#" class="prev" title="previous page">&#10094;</a>
                        </li>
                    @endif


                    @php
                        // Menghitung halaman pertama dan terakhir yang akan ditampilkan
                        $start = max($list_pesanan->currentPage() - 2, 1);
                        $end = min($start + 4, $list_pesanan->lastPage());
                    @endphp

                    @if ($start > 1)
                        <!-- Menampilkan tanda elipsis jika halaman pertama tidak termasuk dalam tampilan -->
                        <li>
                            <a>...</a>
                        </li>
                    @endif

                    @foreach ($list_pesanan->getUrlRange($start, $end) as $page => $url)
                        <li>
                            <a href="{{ $url }}"
                                class="{{ $page == $list_pesanan->currentPage() ? ' active' : '' }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    @if ($end < $list_pesanan->lastPage())
                        <!-- Menampilkan tanda elipsis jika halaman terakhir tidak termasuk dalam tampilan -->
                        <li>
                            <a>...</a>
                        </li>
                    @endif

                    @if ($list_pesanan->hasMorePages())
                        <li><a href="{{ $list_pesanan->nextPageUrl() }}" class="next" title="next page">&#10095;</a>
                        </li>
                    @else
                        <li><a href="#" class="next" title="next page">&#10095;</a></li>
                    @endif
                </ul>
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
