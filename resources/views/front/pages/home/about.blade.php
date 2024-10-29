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
                        <h1>Minimarket<br>Nama Minimarket kamu</h1>
                    </div>
                </div>
            </div>
        </div>
        <img src="{{ asset("front/img/top_about.jpg") }}" class="img-fluid" alt="">
    </div>
    <!--/top_banner-->

    <div class="bg_white">
    <div class="container margin_90_0">
        <div class="row justify-content-between align-items-center flex-lg-row-reverse content_general_row">
            <div class="col-lg-5 text-center">
                <figure><img src="{{ asset("front/img/about_placeholder.jpg") }}" data-src="{{ asset("front/img/about_1.svg") }}" alt="" class="img-fluid lazy" width="350" height="268"></figure>
            </div>
            <div class="col-lg-6">
                <h2>Per quot choro cetero eu</h2>
                <p class="lead">Eu qui mundi lucilius petentium, mea amet libris prodesset in.</p>
                <p>His dolor docendi fuisset ad, movet mucius diceret et qui. Esse ferri integre sit id. Nec iusto eleifend definitionem ne, persius argumentum sed ut. Ut mel dicta latine. Ut dicta tempor omittantur pro, ne mea magna idque. Nulla ancillae et his, ei vim lorem accusam.</p>
            </div>
        </div>
        <!--/row-->
        <div class="row justify-content-between align-items-center content_general_row">
            <div class="col-lg-5 text-start">
                <figure><img src="{{ asset("front/img/about_placeholder.jpg") }}" data-src="{{ asset("front/img/about_3.svg") }}" alt="" class="img-fluid lazy" width="350" height="268"></figure>
            </div>
            <div class="col-lg-6">
                <h2>Per quot choro cetero eu</h2>
                <p class="lead">Eu qui mundi lucilius petentium, mea amet libris prodesset in.</p>
                <p>His dolor docendi fuisset ad, movet mucius diceret et qui. Esse ferri integre sit id. Nec iusto eleifend definitionem ne, persius argumentum sed ut. Ut mel dicta latine. Ut dicta tempor omittantur pro, ne mea magna idque. Nulla ancillae et his, ei vim lorem accusam.</p>
            </div>
        </div>
        <!--/row-->
        <div class="row justify-content-between align-items-center flex-lg-row-reverse content_general_row">
            <div class="col-lg-5 text-center">
                <figure><img src="{{ asset("front/img/about_placeholder.jpg") }}" data-src="{{ asset("front/img/about_2.svg") }}" alt="" class="img-fluid lazy" width="350" height="316"></figure>
            </div>
            <div class="col-lg-6">
                <h2>Per quot choro cetero eu</h2>
                <p class="lead">Eu qui mundi lucilius petentium, mea amet libris prodesset in.</p>
                <p>His dolor docendi fuisset ad, movet mucius diceret et qui. Esse ferri integre sit id. Nec iusto eleifend definitionem ne, persius argumentum sed ut. Ut mel dicta latine.</p>
                <ul class="list_ok">
                    <li>At pro tale omnes iuvaret</li>
                    <li>Persius argumentum sed ut tempor omittantur pro</li>
                    <li>His dolor docendi fuisset ad, movet mucius</li>
                </ul>
            </div>
        </div>
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
