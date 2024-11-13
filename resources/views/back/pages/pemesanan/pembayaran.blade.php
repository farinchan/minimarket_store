@extends('back/app')

@section('styles')
@endsection

@section('content')
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="row gx-6 gx-xl-9">
                <div class="col-lg-12 mb-5">
                    <div class="row">
                        <div class="col-lg-9"></div>
                        <div class="col-lg-3">
                            <form method="GET" class="card-title">
                                <input type="hidden" name="page" value="{{ request('page', 1) }}">
                                <div class="input-group d-flex align-items-center position-relative my-1">
                                    <input type="text" class="form-control form-control-solid  ps-5 rounded-0" name="q"
                                        value="{{ request('q') }}" placeholder="Cari Pembeli" />
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
                @forelse ($list_transaksi as $pesanan)
                    <div class="col-lg-12 mb-5">
                        <div class="card card-flush h-lg-100">
                            <div class="card-body pt-9 pb-0">
                                <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                                    <div
                                        class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-7 mb-4">
                                        <img class="mw-100px mw-lg-150px"
                                            src="{{ $pesanan->pembeli?->getFoto() }}"
                                            alt="image">
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex align-items-center mb-1">
                                                    <a href="#"
                                                        class="text-gray-800 text-hover-primary fs-2 fw-bold me-3">
                                                        {{ $pesanan->pembeli?->nama }}
                                                    </a>
                                                    <span class="badge badge-light-warning me-auto">
                                                        {{ $pesanan->status }}
                                                    </span>
                                                </div>
                                                <div class="d-flex flex-wrap fw-semibold mb-4 fs-5 text-gray-500">
                                                    <table>
                                                        <tr>
                                                            <td width="180px">Jumlah Produk</td>
                                                            <td>:</td>
                                                            <td>{{ $pesanan->pemesananItem->count() }} Produk</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="180px">Total Harga Produk </td>
                                                            <td>:</td>
                                                            <td>@money($pesanan->total_harga_produk)</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Layanan Pengiriman & Ongkir</td>
                                                            <td>:</td>
                                                            <td>{{ $pesanan->pengiriman_kurir }} - @money($pesanan->pengiriman_ongkir)
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Total</td>
                                                            <td>:</td>
                                                            <td>@money($pesanan->total_harga)</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="d-flex mb-4">
                                                <form action="{{ route('back.pesanan.cancelPembayaran', $pesanan->id_pemesanan) }}"
                                                    method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger me-3">Batalkan
                                                        Pesanan</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="separator"></div>
                                <div class="align-items-center pe-5 ps-5">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr class="fw-bold fs-6 text-gray-800">
                                                    <th>ID Pembayaran</th>
                                                    <th>Tanggal Transfer</th>
                                                    <th>bukti Pembayaran</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($pesanan->pembayaran as $konfirmasi)
                                                    <tr>
                                                        <td>#{{ $konfirmasi->id }}</td>
                                                        <td>{{ Carbon\Carbon::parse($konfirmasi->created_at)->format('d M Y') }}
                                                        </td>
                                                        <td>
                                                            <div style="width: 100px; ">

                                                                <a class=" overlay" data-fslightbox="lightbox-basic"
                                                                    href="{{ $konfirmasi->getBuktiTransfer() }}">
                                                                    <!--begin::Image-->
                                                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-50px"
                                                                        style="background-image:url('{{ $konfirmasi->getBuktiTransfer() }}')">
                                                                    </div>
                                                                    <!--end::Image-->

                                                                    <!--begin::Action-->
                                                                    <div
                                                                        class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                                                        <i class="bi bi-eye-fill text-white fs-3x"></i>
                                                                    </div>
                                                                    <!--end::Action-->
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if ($konfirmasi->status == 'Menunggu Konfirmasi')
                                                                <form style="display: inline"
                                                                    action="{{ route('back.transaksi.konfirmasi-pembayaran.approve', $konfirmasi->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="status" value="1">
                                                                    <button type="submit"
                                                                        class="btn btn-icon btn-success me-2 mb-2">
                                                                        <i class="ki-duotone ki-check fs-3x">
                                                                        </i>
                                                                    </button>
                                                                </form>
                                                                <form style="display: inline"
                                                                    action="{{ route('back.transaksi.konfirmasi-pembayaran.reject', $konfirmasi->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="status" value="2">
                                                                    <button type="submit"
                                                                        class="btn btn-icon btn-danger me-2 mb-2">
                                                                        <i class="ki-duotone ki-cross fs-3x">
                                                                            <span class="path1"></span>
                                                                            <span class="path2"></span>
                                                                        </i>
                                                                    </button>
                                                                </form>
                                                            @elseif ($konfirmasi->status == 'Diterima')
                                                                <span class="badge badge-light-success">Diterima</span>
                                                            @else
                                                                <span class="badge badge-light-danger">Ditolak</span>
                                                            @endif
                                                        </td>
                                                    @empty
                                                        <td colspan="4" class="text-center">Belum ada pembayaran</td>
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
                            Showing {{ $list_transaksi->firstItem() }} to {{ $list_transaksi->lastItem() }} of
                            {{ $list_transaksi->total() }}
                            records
                        </div>
                        <ul class="pagination">
                            @if ($list_transaksi->onFirstPage())
                                <li class="page-item previous">
                                    <a href="#" class="page-link"><i class="previous"></i></a>
                                </li>
                            @else
                                <li class="page-item previous">
                                    <a href="{{ $list_transaksi->previousPageUrl() }}" class="page-link bg-light"><i
                                            class="previous"></i></a>
                                </li>
                            @endif

                            @php
                                // Menghitung halaman pertama dan terakhir yang akan ditampilkan
                                $start = max($list_transaksi->currentPage() - 2, 1);
                                $end = min($start + 4, $list_transaksi->lastPage());
                            @endphp

                            @if ($start > 1)
                                <!-- Menampilkan tanda elipsis jika halaman pertama tidak termasuk dalam tampilan -->
                                <li class="page-item disabled">
                                    <span class="page-link">...</span>
                                </li>
                            @endif

                            @foreach ($list_transaksi->getUrlRange($start, $end) as $page => $url)
                                <li class="page-item{{ $page == $list_transaksi->currentPage() ? ' active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            @if ($end < $list_transaksi->lastPage())
                                <!-- Menampilkan tanda elipsis jika halaman terakhir tidak termasuk dalam tampilan -->
                                <li class="page-item disabled">
                                    <span class="page-link">...</span>
                                </li>
                            @endif

                            @if ($list_transaksi->hasMorePages())
                                <li class="page-item next">
                                    <a href="{{ $list_transaksi->nextPageUrl() }}" class="page-link bg-light"><i
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
        <!--end::Content container-->
    </div>

@endsection
@section('scripts')
@endsection
