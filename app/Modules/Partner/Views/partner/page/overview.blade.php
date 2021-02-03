<div class="card card-custom card-stretch">
    <!--begin::Header-->
    <div class="card-header py-3">
        <div class="card-title align-items-start flex-column">
            <h3 class="card-label font-weight-bolder text-dark">{{ trans('Partner::partner.edit.header_overview') }}</h3>
            <span class="text-muted font-weight-bold font-size-sm mt-1">{{ trans('Partner::partner.edit.sub_overview') }}</span>
        </div>
        <div class="card-toolbar">

        </div>
    </div>
    <!--end::Header-->
    <!--begin::Form-->
        @include('Partner::partner.form.overview_item')
    <!--end::Form-->
</div>
