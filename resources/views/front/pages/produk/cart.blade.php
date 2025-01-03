@extends('front.app')


@section('seo')
<title>Minimarket | Keranjang Belanja</title>
    <meta name="description" content="test">
    <meta name="keywords"
        content="minimarket">
    <meta name="author" content="Fajri Rinaldi Chan">
@endsection

@section('styles')
    <!-- SPECIFIC CSS -->
    <link href="{{ asset('front/css/cart.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@section('content')
    <div class="container margin_30">
        <div class="page_header">
            <div class="breadcrumbs">
                {{-- <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Category</a></li>
                <li>Page active</li>
            </ul> --}}
            </div>
            <h1>Keranjang Belanja</h1>
        </div>
        <!-- /page_header -->
        <table class="table table-striped cart-list">
            <thead>
                <tr>
                    <th>
                        Product
                    </th>
                    <th>
                        Price
                    </th>
                    <th>
                        Quantity
                    </th>
                    <th>
                        Subtotal
                    </th>
                    <th>

                    </th>
                </tr>
            </thead>
            <tbody id="cart">

            </tbody>
        </table>

        <div class="row add_top_30 flex-sm-row-reverse cart_actions">
            {{-- <div class="col-sm-4 text-end">
                <button type="button" onClick="cartSome();" class="btn_1 gray">Update Cart</button>
            </div> --}}
            <div class="col-sm-8">
                {{-- <div class="apply-coupon">
                    <div class="form-group">
                        <div class="row g-2">
                            <div class="col-md-6"><input type="text" name="coupon-code" value=""
                                    placeholder="Promo code" class="form-control"></div>
                            <div class="col-md-4"><button type="button" class="btn_1 outline">Apply
                                    Coupon</button></div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
        <!-- /cart_actions -->

    </div>
    <!-- /container -->

    <div class="box_cart">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <ul>
                        <li>
                            <span>Subtotal</span> <div id="subTotalPrice">Rp.0</div>
                        </li>
                        <li>
                            <span>Biaya Admin</span> Rp.0
                        </li>
                        <li>
                            <span>Total</span> <div id="userCartTotalPrice">Rp.0</div>
                        </li>
                    </ul>
                    <a href="{{ route("checkout") }}" class="btn_1 full-width cart">Checkout Sekarang</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /box_cart -->
@endsection

@section('scripts')
    <script>
        console.log('call script');

        function cartSome() {
            console.log('call cart');
            $.ajax({
                url: "{{ route('cart-api') }}",
                type: 'GET',
                success: function(response) {
                    // console.log(response);
                    $('#cartCount').html(`<strong>${response.userCartCount}</strong>`);
                    $('#cart').html('');
                    response.userCart.forEach(element => {
                        $('#cart').append(
                            `
                               <tr>
                                    <td>
                                        <div class="thumb_cart">
                                            <img src="${element.produk.image}"
                                                data-src="img/products/shoes/1.jpg" class="lazy" alt="Image">
                                        </div>
                                        <span class="item_cart">${element.produk.nama}</span>
                                    </td>
                                    <td>
                                        <strong>Rp.${element.produk.harga}</strong>
                                    </td>
                                    <td>
                                        <strong>${element.jumlah}</strong>
                                    </td>
                                    <td>
                                        <strong>Rp.${element.total_price}</strong>
                                    </td>
                                    <td class="options">
                                        <a onClick="deleteCartSome(${element.id_keranjang});" href="#"><i class="ti-trash"></i></a>
                                    </td>
                                </tr>
                            `
                        );
                    });
                    $('#subTotalPrice').html(`Rp.${response.userCartTotalPrice}`);
                    $('#userCartTotalPrice').html(`Rp.${response.userCartTotalPrice}`);
                },
                error: function(xhr) {
                    console.log(xhr);
                },
                complete: function() {
                    console.log('call complete');
                }
            });
        }

        function deleteCartSome(id) {
            $.ajax({
                url: `{{ url('/') }}/cart/${id}/remove`,
                type: 'DELETE',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    cartSome();
                    console.log(response);
                },
                error: function(xhr) {
                    console.log(xhr);
                },
            });

        }
        cartSome();
    </script>
@endsection
