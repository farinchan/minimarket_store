<div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false"
    class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary mb-6">
    <div class="menu-item mb-2">
        <div class="menu-heading text-uppercase fs-7 fw-bold">
            Point Of Sale
        </div>
        <div class="app-sidebar-separator separator"></div>
    </div>
    <div class="menu-item">
        <a class="menu-link @if (request()->routeIs('back.kasir.index')) active @endif" href="{{ route('back.kasir.index') }}">
            <span class="menu-icon">
                <i class="ki-outline ki-lock-2 fs-2"></i> </span>
            <span class="menu-title">Kasir </span>
        </a>
    </div>
    <div class="menu-item">
        <a class="menu-link " href="#">
            <span class="menu-icon">
                <i class="ki-outline ki-lock-2 fs-2"></i> </span>
            <span class="menu-title"> History Transaksi </span>
        </a>
    </div>

</div>
