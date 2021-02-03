@if(!empty($points))
    <!--begin::Card-->
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">{{ trans('Product::product.add.form.preview') }}</span>
                <ul class="nav nav-pills nav-pills-sm nav-dark-75 pt-3">
                    <li class="nav-item">
                        <span class="label label-inline mr-2">{{ trans('Product::product.add.form.preview_success') }} : {{ @$total_success }}</span>
                    </li>
                    <li class="nav-item">
                        <span class="label label-danger label-inline mr-2">{{ trans('Product::product.add.form.preview_danger') }} : {{ @$total - @$total_success }}</span>
                    </li>
                </ul>
            </h3>

            <div class="card-toolbar">
                @if(@$total_success > 0)
                <button type="submit" form="frmAddShipCompleted" class="btn btn-danger font-weight-bold btn-sm px-3 font-size-base">{{ trans('Product::product.add.header_btn_save') }}</button>
                @endif
            </div>
        </div>
        <input type="hidden" name="type" value="{{ @$type }}" />

        <!--end::Header-->
        <div class="separator separator-solid my-3"></div>
        <!--begin::Body-->
        <div class="card-body pt-3 pb-0">
            <!--begin::Table-->
            <div class="table-responsive" id="tbl_preview">
                <table class="table table-borderless table-vertical-center">
                    <thead>
                        <tr>
                            <th class="p-0" style="min-width: 100px">Id</th>
                            <th class="p-0" style="min-width: 100px">Tên</th>
                            <th class="p-0" style="min-width: 300px">Phí Ship</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($points as $point)
                     
                        <input type="hidden" name="id[]" value="{{ @$point['id'] }}" />
                        <input type="hidden" name="ship[]" value="{{ @$point['ship'] }}" />
                      
                        <tr class="tr-{{ @$point['cls'] }} separator separator-dashed my-2">
                            <td class="pl-2">
                                <span class="text-dark-75 d-block font-size-lg">{{ @$point['id'] }}</span>
                            </td>
                            <td class="pl-0">
                                <span class="text-dark-75 d-block font-size-lg">{{ @$point['name'] }}</span>
                            </td>
                            <td class="pl-0">
                                <span class="text-dark-75 d-block font-size-lg">{{ @$point['ship'] }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!--end::Table-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Import-->
@else
<div class="card card-custom card-stretch gutter-b">
    <div class="card-header border-0 pt-8" style="color: red">
        {{ trans('Product::product.add.form.errors.no_data') }}
    </div>
</div>
@endif
