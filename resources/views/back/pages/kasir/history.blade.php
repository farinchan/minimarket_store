@extends('back/app')
@section('styles')
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="row gx-6 gx-xl-9">
                <div class="col-lg-12 mb-5">
                    <div class="row">
                        <div class="col-lg-9"></div>
                        <div class="col-lg-3">
                            <form method="GET" class="card-title">
                                <input type="hidden" name="page" value="{{ request('page', 1) }}">
                                <div class="input-group d-flex align-items-center position-relative my-1">
                                    <input type="text" class="form-control form-control-solid  ps-5 rounded-0"
                                        name="q" value="{{ request('q') }}" placeholder="Cari pengguna" />
                                    <button class="btn btn-primary btn-icon" type="submit" id="button-addon2">
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path
                                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0">
                                                </path>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <!--end::Search-->
                            </form>
                        </div>
                    </div>
                </div>
                @forelse ($list_kasir_transaksi as $kasir)
                    <div class="col-lg-12 mb-5">
                        <div class="card card-flush h-lg-100">
                            <div class="card-body pt-9 pb-0">
                                <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex flex-wrap fw-semibold mb-4 fs-5 text-gray-500">
                                                    <table>
                                                        <tr style="vertical-align:top" class="mb-3">
                                                            <td>Tanggal Transaksi</td>
                                                            <td>:</td>
                                                            <td>{{ Carbon\Carbon::parse($kasir->created_at)->format('d F Y H:i') }}</td>
                                                        </tr>
                                                        <tr style="vertical-align:top" class="mb-3">
                                                            <td>Total Harga</td>
                                                            <td>:</td>
                                                            <td>@money($kasir->total_harga)</td>
                                                        </tr>
                                                        <tr style="vertical-align:top" class="mb-3">
                                                            <td>Bayar</td>
                                                            <td>:</td>
                                                            <td>@money($kasir->bayar)</td>
                                                        </tr>
                                                        <tr style="vertical-align:top" class="mb-3">
                                                            <td>Kembalian</td>
                                                            <td>:</td>
                                                            <td>@money($kasir->kembalian)</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="separator"></div>
                                <div class="align-items-center pe-5 ps-5">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr class="fw-bold fs-5 text-gray-800">
                                                    <th>#</th>
                                                    <th>Produk</th>
                                                    <th>Harga</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- @dd($kasir->kasirTransaksiItem) --}}
                                                @forelse ($kasir->kasirTransaksiItem as $item)
                                                    <tr class="fs-5">
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <!--begin::Thumbnail-->
                                                                <a href="#" class="symbol symbol-50px">
                                                                    <span class="symbol-label"
                                                                        style="background-image:url({{ $item->produk?->getGambar() }});"></span>
                                                                </a>
                                                                <!--end::Thumbnail-->
                                                                <div class="ms-5">
                                                                    <!--begin::Title-->
                                                                    <a target="_blank" href="#"
                                                                        class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                        data-kt-ecommerce-product-filter="product_name">{{ $item->produk?->nama }}</a>
                                                                    {{-- <a class="text-muted text-hover-primary fs-7 fw-bold" href="{{ route("shop-detail", $item->product?->shop?->slug) }}">

                                                                        <div>
                                                                            Toko: {{ $item->product?->shop?->name?? "-" }}
                                                                        </div>
                                                                    </a> --}}
                                                                    <!--end::Title-->
                                                                </div>
                                                            </div>


                                                        <td>{{ $item->jumlah }} x @money($item->harga)</td>
                                                        <td>
                                                            @money($item->jumlah * $item->harga)
                                                        </td>

                                                    </tr>
                                                @empty
                                                    <tr class="fs-5">
                                                        <td colspan="4" class="text-center">Belum ada Item Barang</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-lg-12">
                        <div class="card card-flush h-lg-100">
                            <div class="card-body pt-9 pb-0">
                                <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex align-items-center mb-1">
                                                    <a href="#"
                                                        class="text-gray-800 text-hover-primary fs-2 fw-bold me-3">
                                                        Tidak ada data
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse

                <div class="col-lg-12">
                    <div class="d-flex flex-stack flex-wrap my-3">
                        <div class="fs-6 fw-semibold text-gray-700">
                            Showing {{ $list_kasir_transaksi->firstItem() }} to {{ $list_kasir_transaksi->lastItem() }} of
                            {{ $list_kasir_transaksi->total() }}
                            records
                        </div>
                        <ul class="pagination">
                            @if ($list_kasir_transaksi->onFirstPage())
                                <li class="page-item previous">
                                    <a href="#" class="page-link"><i class="previous"></i></a>
                                </li>
                            @else
                                <li class="page-item previous">
                                    <a href="{{ $list_kasir_transaksi->previousPageUrl() }}" class="page-link bg-light"><i
                                            class="previous"></i></a>
                                </li>
                            @endif

                            @php
                                // Menghitung halaman pertama dan terakhir yang akan ditampilkan
                                $start = max($list_kasir_transaksi->currentPage() - 2, 1);
                                $end = min($start + 4, $list_kasir_transaksi->lastPage());
                            @endphp

                            @if ($start > 1)
                                <!-- Menampilkan tanda elipsis jika halaman pertama tidak termasuk dalam tampilan -->
                                <li class="page-item disabled">
                                    <span class="page-link">...</span>
                                </li>
                            @endif

                            @foreach ($list_kasir_transaksi->getUrlRange($start, $end) as $page => $url)
                                <li class="page-item{{ $page == $list_kasir_transaksi->currentPage() ? ' active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            @if ($end < $list_kasir_transaksi->lastPage())
                                <!-- Menampilkan tanda elipsis jika halaman terakhir tidak termasuk dalam tampilan -->
                                <li class="page-item disabled">
                                    <span class="page-link">...</span>
                                </li>
                            @endif

                            @if ($list_kasir_transaksi->hasMorePages())
                                <li class="page-item next">
                                    <a href="{{ $list_kasir_transaksi->nextPageUrl() }}" class="page-link bg-light"><i
                                            class="next"></i></a>
                                </li>
                            @else
                                <li class="page-item next">
                                    <a href="#" class="page-link"><i class="next"></i></a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection
