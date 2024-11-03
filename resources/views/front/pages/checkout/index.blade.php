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
                <h1>Sign In or Create an Account</h1>

            </div>
            <!-- /page_header -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="step first">
                        <h3>1. Alamat dan Pengiriman</h3>
                        <div class="tab-content checkout">
                            <div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="tab_1">

                                <div class="form-group">
                                    <textarea class="form-control" style="height: 100px;"
                                        placeholder="Alamat lengkap"></textarea>
                                </div>

                                <div class="row no-gutters">
                                    <div class="col-md-12 form-group">
                                        <div class="custom-select-form">
                                            <select class="wide add_bottom_15" name="country" id="country">
                                                <option value="" selected disabled>Provinsi</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row no-gutters">
                                    <div class="col-6 form-group pr-1">
                                        <div class="custom-select-form">
                                            <select class="wide add_bottom_15" name="country" id="country">
                                                <option value="" selected disabled>Kota</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 form-group pl-1">
                                        <input type="text" class="form-control" placeholder="Kode POS">
                                    </div>
                                </div>
                                <!-- /row -->
                                <hr>
                                <div class="form-group">
                                    <div class="custom-select-form">
                                        <select class="wide add_bottom_15" name="country" id="country">
                                            <option value="" selected disabled>Metode Pengiriman</option>
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
                            <li>
                                <label class="container_radio">Credit Card<a href="#0" class="info"
                                        data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                    <input type="radio" name="payment" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="container_radio">Paypal<a href="#0" class="info"
                                        data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                    <input type="radio" name="payment">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="container_radio">Cash on delivery<a href="#0" class="info"
                                        data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                    <input type="radio" name="payment">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="container_radio">Bank Transfer<a href="#0" class="info"
                                        data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                    <input type="radio" name="payment">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                        </ul>

                    </div>
                    <!-- /step -->

                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="step last">
                        <h3>3. Ringkasan Pembelian</h3>
                        <div class="box_general summary">
                            <ul>
                                @foreach ($list_keranjang as $keranjang)
                                    <li class="clearfix"><em>{{ $keranjang->jumlah }} {{ $keranjang->produk->nama }}</em> <span>@money($keranjang->produk->harga)</span></li>
                                @endforeach
                            </ul>
                            <ul>
                                <li class="clearfix"><em><strong>Subtotal</strong></em> <span>@money($subtotal)</span></li>
                                <li class="clearfix"><em><strong>Ongkos Kirim</strong></em> <span>$0</span></li>

                            </ul>
                            <div class="total clearfix">TOTAL <span>$450.00</span></div>
                            <div class="form-group">
                                <label class="container_check">Register to the Newsletter.
                                    <input type="checkbox" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                            <a href="confirm.html" class="btn_1 full-width">Confirm and Pay</a>
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
@endsection
