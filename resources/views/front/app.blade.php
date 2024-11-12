<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="Minimarket ini adalah website penjualan produk-produk kebutuhan sehari-hari, seperti makanan, minuman, dan kebutuhan rumah tangga lainnya. silahkan belanja produk-produk kebutuhan sehari-hari anda disini.">
    <meta name="author" content="Fajri">
    <title>Minimarket</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="{{ asset('ext_img/logo.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" href="{{ asset('ext_img/logo.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{ asset('ext_img/logo.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{{ asset('ext_img/logo.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{{ asset('ext_img/logo.png') }}">

    <!-- GOOGLE WEB FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5/5hb7ie6X2eOz8tEGU0rPw0uJaeHx2+Kbczl1d" crossorigin="anonymous">

    <!-- BASE CSS -->
    <link href="{{ asset('front/css/bootstrap.custom.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}

    <link href="{{ asset('front/css/style.css') }}" rel="stylesheet">

    @yield('styles')


    <!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('front/css/custom.css') }}" rel="stylesheet">

</head>

<body>

    <div id="page">

        @include('front.partials.header')
        <!-- /header -->

        @yield('content')
        <!-- /main -->

        @include('front.partials.footer')
        <!--/footer-->
    </div>
    <!-- page -->

    <div id="toTop"></div><!-- Back to top button -->

    @if (request()->routeIs('produk-detail'))
        @auth
            <div class="top_panel">
                <div class="container header_panel">
                    <a href="#0" class="btn_close_top_panel"><i class="ti-close"></i></a>
                    <label>1 produk Sudah Ditambah ke Keranjang</label>
                </div>
                <!-- /header_panel -->
                <div class="item">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="item_panel">
                                    <figure>
                                        <img src="img/products/product_placeholder_square_small.jpg"
                                            data-src="{{ $produk->getGambar() }}" class="lazy" alt="">
                                    </figure>
                                    <h4>{{ $produk->nama }}</h4>
                                    <div class="price_panel"><span class="new_price">@money($produk->harga)</span>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 btn_panel">
                                <a href="{{ route('cart') }}" class="btn_1 outline">Lihat Keranjang</a> <a
                                    href="{{ route('cart') }}" class="btn_1">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /item -->
            </div>
        @endauth
    @endif

    @if (request()->routeIs('pesanan-saya'))
        @include('front.partials.modal_batalkan_pesanan')
        @include('front.partials.modal_pembayaran')
    @endif

    <!-- COMMON SCRIPTS -->
    <script src="{{ asset('front/js/common_scripts.min.js') }}"></script>
    <script src="{{ asset('front/js/main.js') }}"></script>



    @yield('scripts')

    @include('sweetalert::alert')

    @auth
        <script>
            function cart() {
                $.ajax({
                    url: "{{ route('cart-api') }}",
                    type: 'GET',
                    success: function(response) {
                        // console.log(response);
                        $('#cartCount').html(`<strong>${response.userCartCount}</strong>`);
                        $('#listCart').html('');
                        response.userCart.forEach(element => {
                            $('#listCart').append(
                                `
                                    <li>
                                        <a href="{{ url('/') }}/product/${element.produk.id_produk}">
                                            <figure>
                                                <img src="${element.produk.image}"
                                                    data-src="img/products/shoes/thumb/1.jpg" alt=""
                                                    width="50" height="50" class="lazy">
                                            </figure>
                                            <strong>
                                                <span>${element.produk.nama}</span>${element.jumlah} x Rp.${element.produk.harga}
                                            </strong>
                                        </a>
                                        <a href="#" onClick="deleteCart(${element.id_keranjang});" class="action"><i class="ti-trash"></i></a>
                                    </li>
                                `
                            );
                        });
                        $('#totalCart').html(`Rp.${response.userCartTotalPrice}`);
                    },
                    error: function(xhr) {
                        console.log(xhr);
                    },
                    complete: function() {
                        console.log('complete');
                    }
                });
            }
            $(document).ready(function() {
                setInterval(() => {
                    cart();
                }, 1000);


            });

            function deleteCart(id) {
                console.log(id);

                $.ajax({
                    url: `{{ url('/') }}/cart/${id}/remove`,
                    type: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log(response);
                        cart();
                    },
                    error: function(xhr) {
                        console.log(xhr);
                    },
                });
            }
        </script>
    @endauth




</body>

</html>
