<!--begin::Card widget 7-->
<div class="card card-flush h-md-50 mb-xl-10">
    <!--begin::Header-->
    <div class="card-header pt-5">
        <!--begin::Title-->
        <div class="card-title d-flex flex-column">
            <!--begin::Amount-->
            <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ $pembeli_count }}</span>
            <!--end::Amount-->
            <!--begin::Subtitle-->
            <span class="text-gray-500 pt-1 fw-semibold fs-6">Total Pembeli Terdaftar</span>
            <!--end::Subtitle-->
        </div>
        <!--end::Title-->
    </div>
    <!--end::Header-->
    <!--begin::Card body-->
    <div class="card-body d-flex flex-column justify-content-end pe-0">
        <!--begin::Title-->
        <span class="fs-6 fw-bolder text-gray-800 d-block mb-2">Pembeli Terbaru</span>
        <!--end::Title-->
        <!--begin::Users group-->
        <div class="symbol-group symbol-hover flex-nowrap">
            @foreach ($pembeli_all as $pembeli)

            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{ $pembeli->nama }}">
                <img alt="Pic" src="{{ $pembeli->getFoto() }}" />
            </div>
            @endforeach
            <a href="#" class="symbol symbol-35px symbol-circle" data-bs-toggle="modal"
                data-bs-target="#kt_modal_view_users">
                <span class="symbol-label bg-light text-gray-400 fs-8 fw-bold">
                    {{ $pembeli_count }}
                </span>
            </a>
        </div>
        <!--end::Users group-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card widget 7-->
