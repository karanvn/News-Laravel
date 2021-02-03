<div class="col-lg-12" id="box_products">
    <!--begin::List Widget 10-->
    <div class="card card-custom card-stretchs gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0">
            <h3 class="card-title font-weight-bolder text-danger"><span class="label label-lg label-danger mr-2">1</span>{{ trans('Api::api.product.products.header') }}</h3>
            <div class="card-toolbar">
                <div class="accordion accordion-light accordion-light-borderless accordion-toggle-plus" id="accordion_products">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title collapse text-hover-dark text-danger" data-toggle="collapse" data-target="#collapse_products" aria-expanded="false">
                                {{ trans('Api::api.product.view_detail') }} &nbsp;&nbsp;&nbsp;&nbsp;
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Header-->
        <div class="separator separator-solid"></div>
        <!--begin::Body-->
        <div class="card-bodys pt-5">
            <div class="col-lg-12 collapse show" id="collapse_products" data-parent="#accordion_products">
                <div class="p-4">
                    <div class="bg-light-cus rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-2 font-size-h6">
                            <span class="font-weight-bolder mr-2 text-primary"><i class="icon-x text-dark-50 flaticon2-soft-icons"></i> {{ trans('Api::api.common.input') }}</span>
                        </div>
                        <div class="bg-light-white rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-0 font-size-h6">
                                <span class="font-weight-bolder mr-2 "><i class="icon-x la la-plus"></i> {{ trans('Api::api.common.url') }}:</span>
                                <span class="text order-subtotal">{{ url('') . trans('Api::api.product.products.url') }}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-0 font-size-h6">
                                <span class="font-weight-bolder mr-2 "><i class="icon-x la la-plus"></i> {{ trans('Api::api.common.method') }}:</span>
                                <span class="text">{{ trans('Api::api.product.products.method') }}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-0 font-size-h6">
                                <span class="font-weight-bolder mr-2 "><i class="icon-x la la-plus"></i> {{ trans('Api::api.common.params') }}:</span>
                                @php
                                    $params = trans('Api::api.product.products.params');
                                @endphp
                                <span class="text">
                                    <ul class="navi navi-hover">
                                        @foreach($params as $key => $value)
                                        <li class="">
                                            <span>+ {{ $key.': '.$value }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card card-custom card-stretchs gutter-b mt-8 bg-light-cus rounded">
                        <!--begin::Header-->
                        <div class="card-header border-0">
                            <h3 class="card-title font-weight-bolder text-primary">{{ trans('Api::api.product.products.exp.header') }}</h3>
                            <div class="card-toolbar">
                                <button type="button"  class="btn btn-primary font-weight-bold btn-sm px-3 font-size-base btn-filter-products"> {{ trans('Api::api.common.submit') }}</button>
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-bodys">
                            <div class="col-lg-12 collapsed">
                                <div class="p-4">
                                    <div class="row bg-light-white rounded">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label"><strong>{{ trans('Api::api.product.products.exp.name') }}</strong></label>
                                                        <input type="text" class="form-control product_name">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label"><strong>{{ trans('Api::api.product.products.exp.page') }}</strong></label>
                                                        <select class="form-control custom-select product_page" >
                                                            @for($i = 1; $i <= 10; $i ++)
                                                            <option value="{{ $i }}">---Page{{ ' '.$i }}---</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                @if($categories)
                                                <div class="input-group" style="">
                                                    <div class="radio-list">
                                                        <div id="kt_tree_111" class="tree jstree-default" role="tree">
                                                            <ul class="jstree-container-ul jstree-children" role="group" style="padding: 10px">
                                                                <li role="treeitem" aria-selected="false" aria-level="1" aria-labelledby="j1_1_anchor" aria-expanded="false" id="j1_1" class="jstree-node jstree-closed">
                                                                    <a class="jstree-anchor">
                                                                        <label class="radio-radio-rounded">
                                                                            <input type="radio" class="radio_parent_id" checked  name="parent_id" value="0" rel="0">
                                                                            <span></span> <label class="category_name_0">Không chọn danh mục</label>
                                                                        </label>
                                                                    </a>
                                                                </li>
                                                                {{ view('Product::category.tree', ['categories' => $categories, 'category' => false, 'is_banner' => false])  }}
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Body-->
                    </div>

                    <div class="bg-light-cus rounded p-4 mb-5">
                        <div class="d-flex align-items-center justify-content-between mb-2 mt-4 font-size-h6">
                            <span class="font-weight-bolder mr-2 text-primary"><i class="icon-x text-dark-50 flaticon2-soft-icons"></i> {{ trans('Api::api.common.output') }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between font-size-h6">
                            <div class="col-lg-12 response-products bg-light-white rounded">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Body-->
    </div>
</div>
