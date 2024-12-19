@extends('front.app')


@section('seo')
    <title>Minimarket | Keranjang Belanja</title>
    <meta name="description" content="test">
    <meta name="keywords" content="minimarket">
    <meta name="author" content="Fajri Rinaldi Chan">
@endsection

@section('styles')
    <!-- SPECIFIC CSS -->
    <link href="{{ asset('front/css/checkout.css') }}" rel="stylesheet">
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@section('content')
    <main class="bg_gray">

        <div class="container margin_30">
            <div class="page_header">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Category</a></li>
                        <li>Page active</li>
                    </ul>
                </div>
                <h1>Checkout Belanjaan</h1>

            </div>
            <!-- /page_header -->
            <div class="row">
                <form action="{{ route('checkout-process') }}" method="post" style="display: contents;">
                    @csrf
                    <div class="col-lg-4 col-md-6 px-3">
                        <div class="step first">
                            <h3>1. Alamat dan Pengiriman</h3>
                            <div class="tab-content checkout">
                                <div class="tab-pane fade show active" id="tab_1" role="tabpanel"
                                    aria-labelledby="tab_1">

                                    <div class="form-group">
                                        <textarea class="form-control" style="height: 100px;" id="pengiriman_alamat" name="pengiriman_alamat"
                                            placeholder="Alamat lengkap*" required></textarea>
                                    </div>
                                    <div class="row no-gutters">
                                        <div class="form-group">
                                            <div class="custom-select-form">
                                                <select class="wide add_bottom_15" id="pengiriman_kecamatan"
                                                    name="pengiriman_kecamatan" required>
                                                    <option value="" selected disabled>Kecamatan*</option>
                                                    <option value="Johan Pahlawan">Kec. Johan Pahlawan</option>
                                                    <option value="sama tiga">Kec. Sama Tiga</option>
                                                    <option value="Bubon">Kec. Bubon</option>
                                                    <option value="Arongan Lambalek">Kec. Arongan Lambalek</option>
                                                    <option value="Woyla">Kec. Woyla</option>
                                                    <option value="Woyla Barat">Kec. Woyla Barat</option>
                                                    <option value="Woyla Timur">Kec. Woyla Timur</option>
                                                    <option value="Kaway XVI">Kec. Kaway XVI</option>
                                                    <option value="Meureubo">Kec. Meureubo</option>
                                                    <option value="Pante Ceureumen">Kec. Pante Ceureumen</option>
                                                    <option value="Sungai mas">Kec. Sungai mas</option>
                                                    <option value="Panton Reu">Kec. Panton Reu</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /row -->
                                    <hr>
                                    <div class="row no-gutters">
                                        <div class="col-md-12 form-group">
                                            <div class="custom-select-form">
                                                <select class="wide add_bottom_15" id="kurir" name="pengiriman_kurir" required>
                                                    <option value="" selected disabled>Metode Pengiriman*</option>
                                                    <option value="Pengiriman Toko">Pengiriman Toko</option>
                                                    <option value="Go Send">Go Send</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /step -->
                    </div>
                    <div class="col-lg-4 col-md-6 px-3">
                        <div class="step middle payments">
                            <h3>2. Metode Pembayaran</h3>
                            <ul>
                                @foreach ($list_metode_pembayaran as $metode_pembayaran)
                                    <li>
                                        <label class="container_radio">Transfer Bank - {{ $metode_pembayaran->bank }}
                                            <input type="radio" name="metode_pembayaran_id" required
                                                value="{{ $metode_pembayaran->id }}">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                            <div id="payment_info"></div>
                        </div>
                        <!-- /step -->

                    </div>
                    <div class="col-lg-4 col-md-6 px-3">
                        <div class="step last">
                            <h3>3. Ringkasan Pembelian</h3>
                            <div class="box_general summary">
                                <ul>
                                    @foreach ($list_keranjang as $keranjang)
                                        <li class="clearfix"><em>{{ $keranjang->jumlah }} x
                                                {{ $keranjang->produk->nama }}</em>
                                            <span>@money($keranjang->produk->harga)</span>
                                        </li>
                                    @endforeach
                                </ul>

                                <ul>
                                    <li class="clearfix"><em><strong>Subtotal</strong></em> <span>@money($subtotal)</span>
                                    </li>
                                    <li class="clearfix"><em><strong>Ongkos Kirim</strong></em> <span id="ongkir">Rp.
                                            0</span></li>

                                </ul>
                                <div class="total clearfix">TOTAL <span id="total">@money($subtotal)</span></div>
                                <div class="form-group">
                                    <label class="container_check">Beri tahu saya melalui email
                                        <input type="checkbox" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <input type="hidden" name="total_harga_produk" id="total_harga_produk"
                                    value="{{ $subtotal }}">
                                <input type="hidden" name="pengiriman_ongkir" id="pengiriman_ongkir" value="0">
                                <input type="hidden" name="total_harga" id="total_harga" value="{{ $subtotal }}">
                                <button type="submit" class="btn_1 full-width">Konfirmasi dan Bayar</button>
                            </div>
                            <!-- /box_general -->
                        </div>
                        <!-- /step -->
                    </div>
                </form>

            </div>
            <!-- /row -->
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        var subtotal = @json($subtotal);
        var berat_total = @json($berat_total);
        var kurir = "";

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(angka);
        }

        $(document).ready(function() {

            $('#pengiriman_kecamatan').change(function() {
                console.log($(this).val());
                var ongkos_kirim = 0;
                switch ($(this).val()) {
                    case 'Johan Pahlawan':
                        ongkos_kirim = 5000;
                        break;
                    case 'sama tiga':
                        ongkos_kirim = 10000;
                        break;
                    case 'Bubon':
                        ongkos_kirim = 10000;
                        break;
                    case 'Arongan Lambalek':
                        ongkos_kirim = 15000;
                        break;
                    case 'Woyla':
                        ongkos_kirim = 15000;
                        break;
                    case 'Woyla Barat':
                        ongkos_kirim = 15000;
                        break;
                    case 'Woyla Timur':
                        ongkos_kirim = 15000;
                        break;
                    case 'Kaway XVI':
                        ongkos_kirim = 13000;
                        break;
                    case 'Meureubo':
                        ongkos_kirim = 8000;
                        break;
                    case 'Pante Ceureumen':
                        ongkos_kirim = 15000;
                        break;
                    case 'Sungai mas':
                        ongkos_kirim = 20000;
                        break;
                    case 'Panton Reu':
                        ongkos_kirim = 15000;
                        break;
                    default:
                        ongkos_kirim = 0;
                }

                $('#ongkir').html(formatRupiah(ongkos_kirim));
                $('#pengiriman_ongkir').val(ongkos_kirim);
                $('#total').html(formatRupiah(subtotal + ongkos_kirim));
                $('#total_harga').val(subtotal + ongkos_kirim);

            });

            // $('#kurir').change(function() {
            //     console.log($(this).val());
            //     kurir = $(this).val();

            //     $.ajax({
            //         url: "{{ route('api.rajaongkir.cost') }}",
            //         type: 'POST',
            //         data: {
            //             origin: 1,
            //             destination: 1,
            //             weight: berat_total,
            //             courier: $(this).val()
            //         },
            //         success: function(response) {
            //             console.log(response);
            //             $('#pengiriman_kurir').html(
            //                 '<option value="" selected disabled>Jenis pengiriman</option>');
            //             response.rajaongkir.results[0].costs.forEach(element => {
            //                 $('#pengiriman_kurir').append(
            //                     `<option ongkir="${element.cost[0].value}" value="${ kurir } - ${element.service}">${element.service} - ${element.cost[0].etd} hari - Rp.${element.cost[0].value}</option>`
            //                 );
            //                 $('#pengiriman_kurir').niceSelect('update');

            //             });
            //         }
            //     });
            // });

            // $('#pengiriman_kurir').change(function() {
            //     var ongkos_kirim = parseInt($(this).find(':selected').attr('ongkir'));
            //     $('#ongkir').html(formatRupiah(ongkos_kirim));
            //     $('#pengiriman_ongkir').val(ongkos_kirim);
            //     $('#total').html(formatRupiah(subtotal + ongkos_kirim));
            //     $('#total_harga').val(subtotal + ongkos_kirim);

            // });

            $('input[type=radio][name=metode_pembayaran_id]').change(function() {
                $.ajax({
                    url: "{{ route('api.payment.info') }}",
                    type: 'GET',
                    data: {
                        id: $(this).val()
                    },
                    success: function(response) {
                        console.log(response.data);
                        $('#payment_info').html(`
                            <h6 class="pb-2">Informasi Pembayaran</h6>
                            <div class="payment_info d-none d-sm-block">
                                <p>
                                <div>Bank: ${response.data.bank}</div>
                                <div>No. Rekening: ${response.data.no_rek}</div>
                                <div>Atas Nama: ${response.data.nama_rek}</div>
                                </p>
                            </div>
                        `);

                    }
                });
            });
        });
    </script>
@endsection
