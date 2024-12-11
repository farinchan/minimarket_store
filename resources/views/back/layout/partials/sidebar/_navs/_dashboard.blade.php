<!--begin::Teams-->
<div class="app-sidebar-menu-secondary menu menu-rounded menu-column mb-6">
    <!--begin::Heading-->
    <div class="menu-item mb-2">
        <div class="menu-heading text-uppercase fs-7 fw-bold">
            Dashboard
        </div>
        <!--begin::Separator-->
        <div class="app-sidebar-separator separator"></div>
        <!--end::Separator-->
    </div>
    @role('admin super|admin jual beli|pegawai')
    <div class="menu-item">
        <!--begin::Menu link-->
        <a class="menu-link @if (request()->routeIs('back.dashboard')) active @endif" href="{{ route("back.dashboard") }}">
            <!--begin::Bullet-->
            <span class="menu-icon">
                <span class="bullet bullet-dot bg-success">
                </span>
            </span>
            <!--end::Bullet-->
            <!--begin::Title-->
            <span class="menu-title">
                Penjualan
            </span>
            <!--end::Title-->
        </a>
        <!--end::Menu link-->
    </div>
    @endrole
    <div class="menu-item">
        <a class="menu-link @if (request()->routeIs('back.profile')) active @endif" href="{{ route('back.profile') }}">
            <span class="menu-icon">
                <i class="ki-outline ki-user fs-2">
                </i>
            </span>
            <span class="menu-title">Profil Saya</span>
        </a>
    </div>
</div>
<!--end::Teams-->
