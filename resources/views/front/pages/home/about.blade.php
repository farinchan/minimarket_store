@extends('front.app')

@section('styles')
    <!-- SPECIFIC CSS -->
    <link href="{{ asset('front/css/about.css') }}" rel="stylesheet">
@endsection

@section('content')
<main class="bg_gray">
    <div class="top_banner general">
        <div class="opacity-mask d-flex align-items-md-center" data-opacity-mask="rgba(0, 0, 0, 0.1)">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-lg-8 col-md-6 text-end">
                        <h1>Tentang Kami<br>Sultan Swalayan 1</h1>
                    </div>
                </div>
            </div>
        </div>
        <img src="{{ asset("ext_img/banner/banner_new_6.jpg") }}" class="img-fluid" alt="" style="opacity: 0.6;">
    </div>
    <!--/top_banner-->

    <div class="bg_white">
    <div class="container margin_90_0">
        <div class="row justify-content-between align-items-center flex-lg-row-reverse content_general_row">
            <div class="col-lg-12 text-center">
                <h2>Tentang Kami</h2>
                <p>
                    Sultan Swalayan adalah toko swalayan modern yang menyediakan berbagai kebutuhan sehari-hari dengan harga terjangkau. Menawarkan produk berkualitas, mulai dari bahan makanan segar, kebutuhan rumah tangga, hingga produk kecantikan, Sultan Swalayan hadir dengan suasana yang bersih dan pelayanan yang ramah. Toko ini juga dikenal sebagai tempat belanja favorit keluarga karena memberikan promosi menarik dan program loyalitas pelanggan, menjadikannya solusi praktis untuk memenuhi kebutuhan harian dengan mudah dan nyaman.
                </p>
            </div>
        </div>
        <div class="row justify-content-between align-items-center flex-lg-row-reverse content_general_row">
            <div class="col-lg-5 text-center">
                <figure><img src="{{ asset("front/img/about_placeholder.jpg") }}" data-src="{{ asset("front/img/about_1.svg") }}" alt="" class="img-fluid lazy" width="350" height="268"></figure>
            </div>
            <div class="col-lg-6">
                <h2>Belanja Kapanpun dan Dimanapun</h2>
                <p>Kami menyediakan berbagai macam kebutuhan anda, mulai dari kebutuhan sehari-hari hingga kebutuhan rumah tangga. Kami juga menyediakan berbagai macam produk yang berkualitas dan harga yang terjangkau.</p>
            </div>
        </div>
        <!--/row-->
        <div class="row justify-content-between align-items-center content_general_row">
            <div class="col-lg-5 text-start">
                <figure><img src="{{ asset("front/img/about_placeholder.jpg") }}" data-src="{{ asset("front/img/about_2.svg") }}" alt="" class="img-fluid lazy" width="350" height="268"></figure>
            </div>
            <div class="col-lg-6">
                <h2>Pilihan Produk yang Beragam</h2>
                <p>Apa pun yang anda butuhkan, kami menyediakannya. Kami memiliki berbagai macam produk yang berkualitas dan harga yang terjangkau.</p>
            </div>
        </div>
        <!--/row-->
        <!--/row-->
    </div>
    <!--/container-->

    </div>
</main>
@endsection

@section('scripts')
    <!-- SPECIFIC SCRIPTS -->
    <script src="{{ asset('front/js/carousel-home.js') }}"></script>

@endsection
