@extends('back.app')

@section('content')
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container  container-fluid ">
            <!--begin::Row-->
            <div class="row g-5 gx-xl-10">
                <!--begin::Col-->
                <div class="col-xxl-6 mb-md-5 mb-xl-10">
                    <!--begin::Row-->
                    <div class="row g-5 g-xl-10">
                        <!--begin::Col-->
                        <div class="col-md-6 col-xl-6 mb-xxl-10">
                            @include('back/partials/widgets/cards/_widget-8')
                            @include('back/partials/widgets/cards/_widget-5')
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6 col-xl-6 mb-xxl-10">
                            @include('back/partials/widgets/cards/_widget-9')
                            @include('back/partials/widgets/cards/_widget-7')
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xxl-6 mb-5 mb-xl-10">
                    @include('back/partials/widgets/maps/_widget-1')
                </div>
                <!--end::Col-->
            </div>
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
@endsection
