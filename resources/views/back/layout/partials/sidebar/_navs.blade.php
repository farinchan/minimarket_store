<!--begin::Navs-->
<div class="app-sidebar-navs flex-column-fluid py-6" id="kt_app_sidebar_navs">
    <div id="kt_app_sidebar_navs_wrappers" class="app-sidebar-wrapper hover-scroll-y my-2" data-kt-scroll="true"
        data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_header"
        data-kt-scroll-wrappers="#kt_app_sidebar_navs" data-kt-scroll-offset="5px">
        @include('back/layout/partials/sidebar/_navs/_dashboard')
        {{-- @include('back/layout/partials/sidebar/_navs/_manajemen_toko') --}}
        @include('back/layout/partials/sidebar/_navs/_point_of_sale')
        @include('back/layout/partials/sidebar/_navs/_manajemen_produk')
        @include('back/layout/partials/sidebar/_navs/_pemesanan_pembayaran')
        @include('back/layout/partials/sidebar/_navs/_manajemen_pengguna')
    </div>
</div>
<!--end::Navs-->
