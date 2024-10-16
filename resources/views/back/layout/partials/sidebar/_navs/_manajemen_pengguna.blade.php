<div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false"
    class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary mb-6">
    <div class="menu-item mb-2">
        <div class="menu-heading text-uppercase fs-7 fw-bold">
            Manajemen Pengguna
        </div>
        <div class="app-sidebar-separator separator"></div>
    </div>
    <div class="menu-item">
        <a class="menu-link @if (request()->routeIs('back.pengguna.pegawai')) active @endif" href="{{ route('back.pengguna.pegawai') }}">
            <span class="menu-icon">
                <i class="ki-outline ki-user-tick fs-2">
                </i>
            </span>
            <span class="menu-title">Pegawai</span>
        </a>
    </div>
    <div class="menu-item">
        <a class="menu-link @if (request()->routeIs('back.pengguna.pembeli')) active @endif"
            href="{{ route('back.pengguna.pembeli') }}">
            <span class="menu-icon">
                <i class="ki-outline ki-people fs-2">
                </i>
            </span>
            <span class="menu-title">Pembeli </span>
        </a>
    </div>

</div>
