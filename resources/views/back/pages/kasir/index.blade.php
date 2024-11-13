@extends('back/app')
@section('styles')
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="d-flex flex-column flex-xl-row">
                <div class="d-flex flex-row-fluid me-xl-9 mb-10 mb-xl-0">
                    <div class="card card-flush card-p-0 bg-transparent border-0">
                        <div class="card-body">
                            <ul class="nav nav-pills d-flex nav-pills-custom gap-3 mb-6">
                                @foreach ($list_kategori_produk as $kategori_produk)
                                    <li class="nav-item mb-3 me-0">
                                        <a class="nav-link nav-link-border-solid btn btn-outline btn-flex btn-active-color-primary flex-column flex-stack pt-9 pb-3 page-bg @if ($loop->first) show active @endif"
                                            data-bs-toggle="pill"
                                            href="#kt_pos_food_content_{{ $kategori_produk->id_kategori_produk }}"
                                            style="width: 138px;height: 180px">
                                            {{-- <div class="nav-icon mb-3">
                                                <img src="{{ asset('storage/' . $kategori_produk->icon) }}" class="w-50px"
                                                    alt="" />
                                            </div> --}}
                                            <div class="">
                                                <span
                                                    class="text-gray-800 fw-bold fs-2 d-block">{{ $kategori_produk->nama }}</span>
                                                <span
                                                    class="text-gray-500 fw-semibold fs-7">{{ $kategori_produk->produk->count() }}
                                                    Options</span>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                @foreach ($list_kategori_produk as $kategori_produk)
                                    <div class="tab-pane fade show @if ($loop->first) active @endif"
                                        id="kt_pos_food_content_{{ $kategori_produk->id_kategori_produk }}">
                                        <div class="d-flex flex-wrap d-grid gap-5 gap-xxl-9">
                                            @foreach ($kategori_produk->produk as $produk)
                                                <a href="#" onclick="addProduk({{ $produk->id_produk }})">
                                                    <div class="card card-flush flex-row-fluid p-6 pb-5 mw-100">
                                                        <div class="card-body text-center">
                                                            <img src="{{ $produk->getGambar() }}"
                                                                class="rounded-3 mb-4 w-150px h-150px w-xxl-200px h-xxl-200px"
                                                                alt="" />
                                                            <div class="mb-2">
                                                                <div class="text-center">
                                                                    <span
                                                                        class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-3 fs-xl-1">
                                                                        {{ $produk->nama }}
                                                                    </span>
                                                                    <span
                                                                        class="text-gray-500 fw-semibold d-block fs-6 mt-n1">16
                                                                        mins
                                                                        to cook</span>
                                                                </div>
                                                            </div>
                                                            <span class="text-success text-end fw-bold fs-1">
                                                                @money($produk->harga)
                                                            </span>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-row-auto w-xl-450px">
                    <div class="card card-flush bg-body" id="kt_pos_form">
                        <div class="card-header pt-5">
                            <h3 class="card-title fw-bold text-gray-800 fs-2qx">Keranjang Belanja</h3>
                            <div class="card-toolbar">
                                <button class="btn btn-light-primary fs-4 fw-bold py-4" id="clear">Bersihkan</button>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive mb-8">
                                <table class="table align-middle gs-0 gy-4 my-0">
                                    <thead>
                                        <tr>
                                            <th class="min-w-175px"></th>
                                            <th class="w-125px"></th>
                                            <th class="w-60px"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="kt_pos_table">
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex flex-stack bg-success rounded-3 p-6 mb-11">
                                <div class="fs-6 fw-bold text-white">
                                    <span class="d-block lh-1 mb-2">Subtotal</span>
                                    <span class="d-block mb-2">Diskon</span>
                                    <span class="d-block mb-9">PPN(12%)</span>
                                    <span class="d-block fs-2qx lh-1">Total</span>
                                </div>
                                <div class="fs-6 fw-bold text-white text-end">
                                    <span class="d-block lh-1 mb-2" id="total">Rp.0</span>
                                    <span class="d-block mb-2" id="discount">Rp.0</span>
                                    <span class="d-block mb-9" id="tax">Rp.0</span>
                                    <span class="d-block fs-2qx lh-1" id="grant-total">Rp.0</span>
                                </div>
                            </div>
                            <div class="m-0">
                                {{-- <h1 class="fw-bold text-gray-800 mb-5">Payment Method</h1>
                                <div class="d-flex flex-equal gap-5 gap-xxl-9 px-0 mb-12" data-kt-buttons="true"
                                    data-kt-buttons-target="[data-kt-button]">
                                    <label
                                        class="btn bg-light btn-color-gray-600 btn-active-text-gray-800 border border-3 border-gray-100 border-active-primary btn-active-light-primary w-100 px-4"
                                        data-kt-button="true">
                                        <input class="btn-check" type="radio" name="method" value="0" />
                                        <i class="ki-outline ki-dollar fs-2hx mb-2 pe-0"></i>
                                        <span class="fs-7 fw-bold d-block">Cash</span>
                                    </label>
                                    <label
                                        class="btn bg-light btn-color-gray-600 btn-active-text-gray-800 border border-3 border-gray-100 border-active-primary btn-active-light-primary w-100 px-4 active"
                                        data-kt-button="true">
                                        <input class="btn-check" type="radio" name="method" value="1" />
                                        <i class="ki-outline ki-credit-cart fs-2hx mb-2 pe-0"></i>
                                        <span class="fs-7 fw-bold d-block">Card</span>
                                    </label>
                                    <label
                                        class="btn bg-light btn-color-gray-600 btn-active-text-gray-800 border border-3 border-gray-100 border-active-primary btn-active-light-primary w-100 px-4"
                                        data-kt-button="true">
                                        <input class="btn-check" type="radio" name="method" value="2" />
                                        <i class="ki-outline ki-paypal fs-2hx mb-2 pe-0"></i>
                                        <span class="fs-7 fw-bold d-block">E-Wallet</span>
                                    </label>
                                </div> --}}
                                <button class="btn btn-secondary fs-1 w-100 py-4 mb-3" onclick="addDiscount()">Tambahkan
                                    Diskon</button>
                                <button class="btn btn-primary fs-1 w-100 py-4" onclick="selesai()">Selesai dan
                                    Bayar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var pos_produk = {
            data: [],
            total: 0,
            bayar: 0,
            kembalian: 0
        }

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(angka);
        }

        function addProduk(id_produk) {
            $.ajax({
                url: "{{ route('api.product') }}",
                type: "GET",
                data: {
                    id: id_produk
                },
                success: function(produk) {
                    console.log("success ambil data", produk);

                    if (pos_produk.data.find(p => p.id_produk == produk.data.id_produk)) {
                        pos_produk.data.forEach(p => {
                            if (p.id_produk == produk.data.id_produk) {
                                p.jumlah++;
                                p.harga = p.harga;
                                p.total_harga = p.harga * p.jumlah;
                            }
                        });
                    } else {
                        pos_produk.data.push({
                            id_produk: produk.data.id_produk,
                            nama: produk.data.nama,
                            harga: produk.data.harga,
                            jumlah: 1,
                            total_harga: produk.data.harga
                        });
                    }

                    pos_produk.total += produk.data.harga;

                    refreshCart();
                }
            });
        }

        function increaseProduk(id_produk) {
            var produk = pos_produk.data.find(p => p.id_produk == id_produk);
            produk.jumlah++;
            produk.total_harga += produk.harga;
            pos_produk.total += produk.harga

            refreshCart();
        }

        function decreaseProduk(id_produk) {
            var produk = pos_produk.data.find(p => p.id_produk == id_produk);
            produk.jumlah--;
            produk.total_harga -= produk.harga;
            pos_produk.total -= produk.harga;

            if (produk.jumlah == 0) {
                pos_produk.data.splice(pos_produk.data.findIndex(p => p.id_produk == id_produk), 1);
            }


            refreshCart();
        }

        function addDiscount() {

            Swal.fire({
                title: 'Tambahkan Diskon',
                input: 'text',
                inputLabel: 'Masukkan jumlah diskon',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Tambahkan',
                showLoaderOnConfirm: true,
                preConfirm: (discount) => {
                    if (!discount) {
                        Swal.showValidationMessage(
                            `Diskon tidak boleh kosong`
                        )
                    }
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log("success add discount", result.value);
                    pos_produk.total -= result.value;
                    $('#discount').text(formatRupiah(result.value));
                    refreshCart();
                }
            });

        }


        function refreshCart() {
            console.log("refresh cart", pos_produk);

            var table = $('#kt_pos_table');
            table.empty();

            pos_produk.data.forEach(produk => {
                table.append(`
                    <tr>
                        <td class="pe-0">
                            <div class="d-flex align-items-center">
                                <span
                                    class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-6 me-1">
                                    ${produk.nama}
                                    </span>
                            </div>
                        </td>
                        <td class="pe-0">
                            <div class="position-relative d-flex align-items-center">
                                <button type="button" onclick="decreaseProduk(${produk.id_produk})"
                                    class="btn btn-icon btn-sm btn-light btn-icon-gray-500">
                                    <i class="ki-outline ki-minus fs-3x"></i>
                                </button>
                                <input type="text"
                                    class="form-control border-0 text-center px-0 fs-3 fw-bold text-gray-800 w-30px"
                                     readonly="readonly" value="${produk.jumlah}" />
                                <button type="button" onclick="increaseProduk(${produk.id_produk})"
                                    class="btn btn-icon btn-sm btn-light btn-icon-gray-500">
                                    <i class="ki-outline ki-plus fs-3x"></i>
                                </button>
                            </div>
                        </td>
                        <td class="text-end">
                            <span class="fw-bold text-primary fs-2">
                               ${formatRupiah(produk.total_harga)}
                            </span>
                        </td>
                    </tr>
                `);
            });

            $('#total').text(formatRupiah(pos_produk.total));
            $('#tax').text(formatRupiah(pos_produk.total * 0.12));
            $('#grant-total').text(formatRupiah(pos_produk.total + (pos_produk.total * 0.12)));

        }

        function selesai() {
            Swal.fire({
                title: 'Selesai dan Bayar',
                input: 'text',
                inputLabel: 'Masukkan jumlah uang yang dibayarkan',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Bayar',
                showLoaderOnConfirm: true,
                preConfirm: (bayar) => {
                    if (!bayar) {
                        Swal.showValidationMessage(
                            `Jumlah uang yang dibayarkan tidak boleh kosong`
                        )
                    }
                },
            }).then((result) => {
                if (result.isConfirmed) {

                    // Tampilkan loading sementara proses AJAX berlangsung
                    Swal.fire({
                        title: 'Sedang Memproses...',
                        text: 'Harap tunggu beberapa saat.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading(); // Memunculkan animasi loading
                        }
                    });

                    $.ajax({
                        url: "{{ route('back.kasir.transaksi-process-ajax') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            data: pos_produk
                        },
                        success: function(response) {
                            console.log("success bayar", result.value);
                            pos_produk.bayar = result.value;
                            pos_produk.kembalian = pos_produk.bayar - (pos_produk.total + (pos_produk
                                .total * 0.12));

                            Swal.fire({
                                title: 'Transaksi Berhasil',
                                html: `
                                    <div class="text-center">
                                        <div class="text-gray-800 fs-2 mt-3">Total</div>
                                        <div class="text-primary fs-3 fw-bold">${formatRupiah(pos_produk.total + (pos_produk.total * 0.12))}</div>
                                        <div class="text-gray-800 fs-2 mt-3">Bayar</div>
                                        <div class="text-primary fs-3 fw-bold">${formatRupiah(pos_produk.bayar)}</div>
                                        <div class="text-gray-800 fs-2 mt-3">Kembalian</div>
                                        <div class="text-primary fs-3 fw-bold">${formatRupiah(pos_produk.kembalian)}</div>
                                    </div>
                                `,
                                showConfirmButton: false,
                                showCancelButton: true,
                                cancelButtonText: 'Tutup',
                                cancelButtonColor: '#d33',
                            });

                            clear();
                        },
                        error: function(error) {
                            console.log("error bayar", error);

                            Swal.fire({
                                title: 'Transaksi Gagal',
                                text: 'Terjadi kesalahan saat melakukan transaksi pembayaran',
                                icon: 'error',
                                confirmButtonText: 'Tutup'
                            });
                        },



                    });


                }
            });
        }

        $('#clear').click(function() {
            clear();
        });

        function clear() {
            pos_produk.data = [];
            pos_produk.total = 0;
            pos_produk.bayar = 0;
            pos_produk.kembalian = 0;
            refreshCart();
        }
    </script>
@endsection
