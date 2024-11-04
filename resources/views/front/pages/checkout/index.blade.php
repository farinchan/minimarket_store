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
                <div class="col-lg-4 col-md-6">
                    <div class="step first">
                        <h3>1. Alamat dan Pengiriman</h3>
                        <div class="tab-content checkout">
                            <div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="tab_1">

                                <div class="form-group">
                                    <textarea class="form-control" style="height: 100px;" id="pengiriman_alamat" name="pengiriman_alamat"
                                        placeholder="Alamat lengkap"></textarea>
                                </div>

                                <div class="row no-gutters">
                                    <div class="col-md-12 form-group">
                                        <div class="custom-select-form" style="margin-bottom: 0;">
                                            <select class="wide add_bottom_15" name="pengiriman_provinsi"
                                                id="pengiriman_provinsi">
                                                <option value="" selected disabled>Provinsi</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row no-gutters">
                                    <div class="col-8 form-group pr-1">
                                        <div class="custom-select-form">
                                            <select class="wide add_bottom_15" name="pengiriman_kota" id="pengiriman_kota">
                                                <option value="" selected disabled>Kota</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4 form-group pl-1">
                                        <input type="text" class="form-control" placeholder="Kode POS">
                                    </div>
                                </div>
                                <!-- /row -->
                                <hr>
                                <div class="row no-gutters">
                                    <div class="col-md-12 form-group">
                                        <div class="custom-select-form">
                                            <select class="wide add_bottom_15" name="kurir" id="kurir">
                                                <option value="" selected disabled>Metode Pengiriman</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-select-form">
                                        <select class="wide add_bottom_15" name="pengiriman_kurir" id="pengiriman_kurir">
                                            <option value="" selected disabled>Jenis pengiriman</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /step -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="step middle payments">
                        <h3>2. Metode Pembayaran</h3>
                        <ul>
                            @foreach ($list_metode_pembayaran as $metode_pembayaran)
                                <li>
                                    <label class="container_radio">Transfer Bank - {{ $metode_pembayaran->bank }}
                                        <input type="radio" name="metode_pembayaran_id" value="{{ $metode_pembayaran->id }}">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                        <div id="payment_info"></div>
                    </div>
                    <!-- /step -->

                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="step last">
                        <h3>3. Ringkasan Pembelian</h3>
                        <div class="box_general summary">
                            <ul>
                                @foreach ($list_keranjang as $keranjang)
                                    <li class="clearfix"><em>{{ $keranjang->jumlah }} x {{ $keranjang->produk->nama }}</em>
                                        <span>@money($keranjang->produk->harga)</span>
                                    </li>
                                @endforeach
                            </ul>
                            <ul>
                                <li class="clearfix"><em><strong>Subtotal</strong></em> <span>@money($subtotal)</span></li>
                                <li class="clearfix"><em><strong>Ongkos Kirim</strong></em> <span id="ongkir">Rp. 0</span></li>

                            </ul>
                            <div class="total clearfix">TOTAL <span id="total">@money($subtotal)</span></div>
                            <div class="form-group">
                                <label class="container_check">Beri tahu saya melalui email
                                    <input type="checkbox" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                            <a href="confirm.html" class="btn_1 full-width">Konfirmasi dan Bayar</a>
                        </div>
                        <!-- /box_general -->
                    </div>
                    <!-- /step -->
                </div>
            </div>
            <!-- /row -->
        </div>
    </main>
@endsection

@section('scripts')

    <script>

        var subtotal = @json($subtotal);
        var berat_total = @json($berat_total);

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(angka);
        }

        $(document).ready(function() {
            $.ajax({
                url: "{{ route('api.rajaongkir.province') }}",
                type: 'GET',
                success: function(response) {
                    console.log(response);

                    response.rajaongkir.results.forEach(element => {

                        $('#pengiriman_provinsi').append(
                            `<option value="${element.province_id}">${element.province}</option>`
                        );
                        $('#pengiriman_provinsi').niceSelect('update');
                    });
                }
            });

            $('#pengiriman_provinsi').change(function() {
                $.ajax({
                    url: "{{ route('api.rajaongkir.city') }}",
                    type: 'GET',
                    data: {
                        province: $(this).val()
                    },
                    success: function(response) {
                        console.log(response);
                        $('#pengiriman_kota').html('');
                        response.rajaongkir.results.forEach(element => {
                            $('#pengiriman_kota').append(
                                `<option value="${element.city_id}">${element.city_name}</option>`
                            );
                            $('#pengiriman_kota').niceSelect('update');
                        });
                    }
                });
            });

            $('#pengiriman_kota').change(function() {
                $('#kurir').append(
                    `<option value="jne">JNE</option>
                    <option value="pos">POS</option>
                    <option value="tiki">TIKI</option>`
                );
                $('#kurir').niceSelect('update');
            });

            $('#kurir').change(function() {
                console.log($(this).val());

                $.ajax({
                    url: "{{ route('api.rajaongkir.cost') }}",
                    type: 'POST',
                    data: {
                        origin: 501,
                        destination: $('#pengiriman_kota').val(),
                        weight: 1000,
                        courier: $(this).val()
                    },
                    success: function(response) {
                        console.log(response);
                        $('#pengiriman_kurir').html('<option value="" selected disabled>Jenis pengiriman</option>');
                        response.rajaongkir.results[0].costs.forEach(element => {
                            $('#pengiriman_kurir').append(
                                `<option value="${element.cost[0].value}">${element.service} - ${element.cost[0].etd} hari - Rp.${element.cost[0].value}</option>`
                            );
                            $('#pengiriman_kurir').niceSelect('update');
                        });
                    }
                });
            });

            $('#pengiriman_kurir').change(function() {
                var ongkos_kirim = parseInt($(this).val());
                $('#ongkir').html(formatRupiah(ongkos_kirim));
                $('#total').html(formatRupiah(subtotal + ongkos_kirim));

            });

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
