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
    <div class="menu-item">
        <!--begin::Menu link-->
        <a class="menu-link active" href="?page=apps/projects/project">
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
    <div class="menu-item">
        <!--begin::Menu link-->
        <a class="menu-link " href="?page=apps/projects/activity">
            <!--begin::Bullet-->
            <span class="menu-icon">
                <span class="bullet bullet-dot bg-danger">
                </span>
            </span>
            <!--end::Bullet-->
            <!--begin::Title-->
            <span class="menu-title">
                Schipol Extranet </span>
            <!--end::Title-->
        </a>
        <!--end::Menu link-->
    </div>
    <div class="menu-item">
        <a class="menu-link @if (request()->routeIs('back.profile')) active @endif"
        href="{{ route('back.profile') }}">
            <span class="menu-icon">
                <i class="ki-outline ki-lock-2 fs-2"></i> </span>
            <span class="menu-title">Profil Saya</span>
        </a>
    </div>
</div>
<!--end::Teams-->
