<!--begin::Form(use d-none d-lg-block classes for responsive search)-->
<form data-kt-search-element="form" class="d-none d-lg-block w-100 position-relative mb-5 mb-lg-0" autocomplete="off">
    <!--begin::Hidden input(Added to disable form autocomplete)-->
    <input type="hidden"/>
    <!--end::Hidden input-->
    <!--begin::Icon-->
    <i class="ki-outline ki-magnifier search-icon fs-2 text-gray-500 position-absolute top-50 translate-middle-y ms-5"></i>    <!--end::Icon-->
    <!--begin::Input-->
    <input type="text" class="search-input form-control form-control rounded-1  ps-13" name="search" value="" placeholder="Search..." data-kt-search-element="input"/>
    <!--end::Input-->
    <!--begin::Spinner-->
    <span class="search-spinner  position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5" data-kt-search-element="spinner">
        <span class="spinner-border h-15px w-15px align-middle text-gray-500"></span>
    </span>
    <!--end::Spinner-->
    <!--begin::Reset-->
    <span class="search-reset  btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-4" data-kt-search-element="clear">
        <i class="ki-outline ki-cross fs-2 fs-lg-1 me-0"></i>    </span>
    <!--end::Reset-->
</form>
<!--end::Form-->