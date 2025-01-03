@role('admin super|admin jual beli')
    <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false"
        class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary mb-6">
        <div class="menu-item mb-2">
            <div class="menu-heading text-uppercase fs-7 fw-bold">
                Pemesanan & Pembayaran
            </div>
            <div class="app-sidebar-separator separator"></div>
        </div>
        <div class="menu-item">
            <a class="menu-link @if (request()->routeIs('back.metode-pembayaran.index')) active @endif"
                href="{{ route('back.metode-pembayaran.index') }}">
                <span class="menu-icon">

                    <i class="ki-outline ki-credit-cart fs-2">
                    </i>

                </span>
                <span class="menu-title">Metode Pembayaran </span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link @if (request()->routeIs('back.pesanan.konfirmasi-pembayaran')) active @endif"
                href="{{ route('back.pesanan.konfirmasi-pembayaran') }}">
                <span class="menu-icon">
                    <i class="ki-outline ki-cheque fs-2">
                    </i>
                </span>
                <span class="menu-title">Pembayaran</span>
            </a>
        </div>
        <div data-kt-menu-trigger="click"
            class="menu-item menu-accordion @if (request()->routeIs('back.pesanan.*')) show here @endif">
            <span class="menu-link">
                <span class="menu-icon">
                    <i class="ki-outline ki-handcart fs-2">
                    </i>
                </span>
                <span class="menu-title">Pemesanan</span><span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion">
                <div class="menu-item">
                    <a class="menu-link @if (request()->routeIs('back.pesanan.diproses')) active @endif"
                        href="{{ route('back.pesanan.diproses') }}"><span class="menu-bullet">
                            <span class="bullet bullet-dot"></span></span>
                        <span class="menu-title">Diproses</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link @if (request()->routeIs('back.pesanan.dikirim')) active @endif"
                        href="{{ route('back.pesanan.dikirim') }}"><span class="menu-bullet">
                            <span class="bullet bullet-dot"></span></span>
                        <span class="menu-title">Sedang Dikirim</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link @if (request()->routeIs('back.pesanan.selesai')) active @endif"
                        href="{{ route('back.pesanan.selesai') }}"><span class="menu-bullet">
                            <span class="bullet bullet-dot"></span></span>
                        <span class="menu-title">Selesai</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link @if (request()->routeIs('back.pesanan.dibatalkan')) active @endif"
                        href="{{ route('back.pesanan.dibatalkan') }}"><span class="menu-bullet">
                            <span class="bullet bullet-dot"></span></span>
                        <span class="menu-title">Dibatalkan</span>
                    </a>
                </div>
            </div>
        </div>


    </div>
@endrole
