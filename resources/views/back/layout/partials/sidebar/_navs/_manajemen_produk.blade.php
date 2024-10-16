<div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false"
    class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary mb-6">
    <div class="menu-item mb-2">
        <div class="menu-heading text-uppercase fs-7 fw-bold">
            Manajemen Produk
        </div>
        <div class="app-sidebar-separator separator"></div>
    </div>
    <div class="menu-item">
        <a class="menu-link @if (request()->routeIs('back.kategori-produk.index')) active @endif" href="{{ route('back.kategori-produk.index') }}">
            <span class="menu-icon">
                <i class="ki-outline ki-lock-2 fs-2"></i> </span>
            <span class="menu-title">Kategori</span>
        </a>
    </div>
    <div data-kt-menu-trigger="click" class="menu-item menu-accordion @if (request()->routeIs('back.produk.*')) here show @endif">
        <span class="menu-link"><span class="menu-icon"><i class="ki-outline ki-briefcase fs-2"></i></span>
            <span class="menu-title">Produk</span><span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link @if (request()->routeIs('back.produk.create')) active @endif" href="{{route("back.produk.create")}}" title="Produk baru yang akan ditambahkan" data-bs-toggle="tooltip"
                    data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right"><span class="menu-bullet">
                        <span class="bullet bullet-dot"></span></span>
                    <span class="menu-title">Tambah Produk</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link @if (request()->routeIs('back.produk.index')) active @endif" href="{{route("back.produk.index")}}" title="Daftar produk yang sudah ada" data-bs-toggle="tooltip"
                    data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right"><span class="menu-bullet">
                        <span class="bullet bullet-dot"></span></span>
                    <span class="menu-title">List Produk</span>
                </a>
            </div>
        </div>
    </div>
    <div class="menu-item">
        <a class="menu-link " href="#">
            <span class="menu-icon">
                <i class="ki-outline ki-lock-2 fs-2"></i> </span>
            <span class="menu-title"> Ulasan </span>
        </a>
    </div>

</div>
