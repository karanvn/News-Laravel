<link href="admin/assets/plugins/global/plugins.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
<link href="admin/assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
<link href="admin/assets/css/style.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
<!--end::Global Theme Styles-->
<!--begin::Layout Themes(used by all pages)-->
<link href="admin/assets/css/themes/layout/header/base/dark.css?v=7.0.5" rel="stylesheet" type="text/css" />
<link href="admin/assets/css/themes/layout/header/menu/light.css?v=7.0.5" rel="stylesheet" type="text/css" />
<link href="admin/assets/css/themes/layout/brand/dark.css?v=7.0.5" rel="stylesheet" type="text/css" />
<link href="admin/assets/css/themes/layout/aside/dark.css?v=7.0.5" rel="stylesheet" type="text/css" />
<link href="css/pages/styles.css" rel="stylesheet" type="text/css" />
<!--end::Layout Themes-->
<link rel="shortcut icon" href="admin/assets/media/logos/favicon.ico" />
<link href="admin/assets/plugins/custom/cropper/cropper.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
<link href="admin/assets/plugins/custom/jstree/jstree.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
<link href="third/editable/css/bootstrap-editable.css" rel="stylesheet" />
<link href="third/modal/dist/bootstrap4-modal-fullscreen.min.css" rel="stylesheet" />
<div class="row">
    <!--begin::Access-->
    <!--end::Access-->
    <!--begin::Avatar-->
    <div class="col-lg-12 px-0">
        <!--begin::List Widget 10-->
        <div class="card card-custom card-stretchs gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">{{ trans('Blog::blog.add.form.avatar') }}
                </h3>
                <div class="card-toolbar">

                </div>
            </div>
            <!--end::Header-->
            <div class="separator separator-solid"></div>
            <!--begin::Body-->
            <div class="card-body pt-5">
                <div class="col-lg-12">
                    <div class="form-group row">
                        <div class="image-input image-input-outline"
                            id="kt_image" style="width: 100%">
                            <div class="image-input-wrapper min-h-265px"
                                style="background-image: url({{ asset('storage/editor/blog/'.@$blog->image) }}); width: 100%">
                            </div>
                            <label
                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-success btn-shadow"
                                data-action="change" data-toggle="tooltip"
                                title="" data-original-title="Đổi ảnh">
                                <i class="icon-x text-dark-50 flaticon2-image-file"></i>
                                <input type="file" name="image" accept=".png, .jpg, .jpeg">
                            </label>
                            <span
                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-success btn-shadow" data-action="cancel" data-toggle="tooltip"
                                title="" data-original-title="Huỷ ảnh">
                                <i
                                    class="icon-x text-dark-50 flaticon-delete-1"></i>
                            </span>
                        </div>
                        <span class="form-text text-muted">{{ trans('Blog::blog.add.form.header_avatar_allow') }}
                            png, jpg, jpeg.</span>
                    </div>
                    @if($errors->has('image'))
                        <p class="text-danger"> {{$errors->first('image')}}</p>
                    @endif
                    <span class="form-text text-error avatar-error"></span>
                </div>
            </div>
            <!--end::Body-->
        </div>
    </div>
    <!--end::Avatar-->
    <!-- begin::SEO -->
    <div class="row">
        <div class="col-lg-12">
            <!--begin::List Widget 10-->
            <div class="card card-custom card-stretchs gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0">
                    <h3 class="card-title font-weight-bolder text-dark">{{ trans('Blog::blog.add.form.seo_optimization') }}</h3>
                    <div class="card-toolbar">
                        <div class="accordion accordion-light accordion-light-borderless accordion-toggle-plus"
                            id="accordion_seo">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title collapsed text-hover-primary"
                                        data-toggle="collapse" data-target="#collapse_seo"
                                        aria-expanded="false">
                                        {{ trans('Blog::blog.add.form.header_add') }}
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Header-->
                <div class="separator separator-solid"></div>
                <!--begin::Body-->
                <div class="card-body pt-5">
                    <div>
                        <span class="text-muted">{{ trans('Blog::blog.add.form.header_seo_add') }}</span>
                    </div>
                    <div class="col-lg-12 collapse" id="collapse_seo"
                        data-parent="#accordion_seo" style="">
                        <div class="form-group row">
                            <label class="col-form-label">{{ trans('Blog::blog.add.form.seo_title') }}</label>
                            <input class="form-control form-control-lg"
                                type="text" name="seo_title" placeholder=""
                                value="{{ @$blog->seo_title }}">
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label">{{ trans('Blog::blog.add.form.seo_description') }}
                            </label>
                            <textarea class="form-control" rows="8"
                                name="seo_description">{{ @$blog->seo_description }}</textarea>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label">{{ trans('Blog::blog.add.form.seo_link') }}</label>
                            <textarea class="form-control" rows="2"
                                name="seo_link">{{ @$blog->seo_link }}</textarea>
                        </div>
                    </div>
                </div>
                <!--end::Body-->
            </div>
        </div>
    <!-- end::SEO -->
    {{-- <!--begin::Category-->
    <div class="col-lg-12">
        <!--begin::List Widget 10-->
        <div class="card card-custom card-stretchs gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">{{ trans('Blog::blog.add.form.header_category') }}
                    <span class="label-text-error">*</span></h3>
                <div class="card-toolbar">
                    <div class="accordion accordion-light accordion-light-borderless accordion-toggle-plus"
                        id="accordion_categories">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title collapsed text-hover-primary"
                                    data-toggle="collapse"
                                    data-target="#collapse_categories"
                                    aria-expanded="false">
                                    <a href="{{ route('blog-category-add') }}">{{ trans('Blog::blog.add.form.header_add') }}&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Header-->
            <div class="separator separator-solid"></div>
            <!--begin::Body-->
            <div class="card-body pt-5">
                <div class="col-lg-12">
                    <div class="form-group row">
                        <select class="form-control custom-select" name="blog_category_id">
                            <option selected="" disabled >{{ trans('Blog::blog.add.form.header_category_select') }}</option>
                            @foreach($categories as $cate)
                            <option {{ @$blog->category->id==$cate->id ? 'selected' : '' }} value="{{ $cate->id }}">{{ @$cate->title }}</option>
                            @endforeach
                            
                        </select>
                        @if($errors->has('blog_category_id'))
                        <p class="text-danger"> {{$errors->first('blog_category_id')}}</p>
                        @endif
                    </div>

                </div>

                
            </div>
            <!--end::Body-->
        </div>
    </div>
    <!--end::Category--> --}}

    <div class="col-lg-12" data-select2-id="11">
        <!--begin::List Widget 10-->
        <div class="card card-custom card-stretchs gutter-b" data-select2-id="10">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">Danh mục</h3>
                <div class="card-toolbar">
                    <div class="accordion accordion-light accordion-light-borderless accordion-toggle-plus" id="accordion_categories">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title text-hover-primary" data-toggle="collapse" data-target="#collapse_categories" aria-expanded="true">
                                    Thêm &nbsp;&nbsp;&nbsp;&nbsp;
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Header-->
            <div class="separator separator-solid"></div>
            <!--begin::Body-->
            <div class="card-body pt-5" data-select2-id="9">
        <div class="col-lg-12">
            <!--begin::List Widget 10-->
            <div class="card card-custom card-stretchs gutter-b">
            
{{--  --}}
<div class="form-group row">
    <select class="form-control select2" id="selected_categories" name="blog_category_id" multiple="true" data-select2-id="op_category_product" tabindex="-1" aria-hidden="true">
        @if(!empty($selected_categories))
        @foreach($selected_categories as $selected_category)
            <option selected="selected" value="{{ $selected_category['id'] }}" >{{ $selected_category['title'] }}</option>
        @endforeach
        @endif
    </select>
    <span class="form-text text-error category_ids-error"></span>
</div>

<div class="form-group row collapse" id="collapse_categories" data-parent="#accordion_categories">
    
    @if(count($categories) > 0)
    <div class="input-group" style="background: #F3F6F9;border-radius:5px;max-height: 250px;overflow: scroll">
        
        <div class="radio-list">
            <div id="kt_tree_111" class="tree jstree-default" role="tree">
                <ul class="jstree-container-ul jstree-children" role="group" style="padding: 10px">
                  
                 {{-- cay danh muc --}}
                 @foreach($categories as $cate)
                 <li role="treeitem" id="jstree_node_{{ $cate->id }}" class="jstree-node jstree-closed jstree-node-{{ $cate->id }}">
                     @php
                     $children = $cate->categories()->get();
                     $count = $children->count();
                     @endphp
                     @if($count > 0)
                     <i class="jstree-icon jstree-ocl jstree-icon-{{ $cate->id }}" onclick="show_treesblog({{ $cate->id }}, {{ @$flag }})" role="presentation" expanded="closed"></i>
                     {{--
                     <i class="icon-l fas fa-long-arrow-alt-right" style="{{ !empty(@$is_banner) ? 'margin-top:13px;margin-left:-9px' : 'margin-top:5px;margin-left:-9px' }}"></i>
                     --}}
                     @else
                     <i class="icon-l fas fa-long-arrow-alt-right" style="margin-top:5px;margin-left:12px"></i>
                     @endif
                 
                     <a class="jstree-anchor" style="margin-top:3px">
                         <label class="radio-radio-rounded">
                             @if(@$flag==0)
                             <input type="radio" class="radio_parent_id" name="parent_id" value="{{ $cate->id }}" rel="{{ $cate->id }}">
                             <span></span> <label class="category_name_{{ $cate->id }}">
                                 {{ $cate->title }}
                                 @if($count > 0)
                                 <span class="label label-sm label-danger">{{ $count }}</span>
                                 @endif
                             </label>
                             @else
                             <a href="{{ route('ProductCategoryEdit', [$cate->id]) }}"><span class="label label-{{ $cate->status == 'A' ? 'success' : 'danger' }} label-inline mr-0"><strong>{{ $cate->title }}</strong>
                                 @if($count > 0)
                                 &nbsp;&nbsp;<span class="label label-sm label-white">{{ $count }}</span>
                                 @endif
                             </span></a>
                             @endif
                         </label>
                     </a>
                 
                     <ul class="jstree-container-ul jstree-children jstree-container-category jstree-children-{{ $cate->id }}" role="group" style="margin-left: 30px"></ul>
                 
                 </li>
                 @endforeach
                 
                 {{-- end cay danh muc --}}
                </ul>
            </div>
        </div>
    </div>
    <div class="col text-center pt-4">
        <button type="button" class="btn btn-success" id="btn_selected_categoriesBlog">Chọn</button>
    </div>
    @else
    <div>
       Không có danh mục nào
     
    </div>
    @endif
</div>





{{--  --}}
                
                <!--end::Header-->
      
                </div>
            </div>
            <!--end::Body-->
        </div>
    </div>
    {{-- begin: link thay thế  --}}

<div class="col-lg-12 px-0">
    <!--begin::List Widget 10-->
    <div class="card card-custom card-stretchs gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0">
            <h3 class="card-title font-weight-bolder text-dark">{{ trans('Blog::blog.add.form.alternative_link') }}
            </h3>
            <div class="card-toolbar">
            </div>
        </div>
        <!--end::Header-->
        <div class="separator separator-solid"></div>
        <!--begin::Body-->
        <div class="card-body pt-5">
            <div class="col-lg-12">
                <div class="form-group row">
                    <input class="form-control form-control-lg" type="text" name="alternative_link" placeholder="" value="{{@$blog->alternative_link}}">

                </div>
                <span class="form-text text-muted">
                    {{ trans('Blog::blog.add.form.alternative_link_note') }}
                </span>
                </div>
               
            </div>
        </div>
        <!--end::Body-->
    </div>
    {{-- begin: lposition show  --}}
    @if(@$selected_categories[0]['position'] =='FOOTER')
    <div class="col-lg-12 px-0" id="position_show">
    @else
    <div class="col-lg-12 px-0" id="position_show" style="display:none">

    @endif 
        <!--begin::List Widget 10-->
        <div class="card card-custom card-stretchs gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">{{ trans('Blog::blog.add.form.position_show.title') }}
                </h3>
                <div class="card-toolbar">
                </div>
            </div>
            <!--end::Header-->
            <div class="separator separator-solid"></div>
            <!--begin::Body-->
            <div class="card-body pt-5">
                <div class="col-lg-12">
                    <div class="form-group row">
                        <select name="position_show" class="form-control form-control-lg">
                           @if(isset($blog->position_show) && (!empty($blog->position_show)))
                                @if(@$blog->position_show == 'top')
                                    <option value="top">{{ trans('Blog::blog.add.form.position_show.top') }}</option>
                                    <option value="">{{ trans('Blog::blog.add.form.position_show.none') }}</option>
                                    <option value="bottom">{{ trans('Blog::blog.add.form.position_show.bottom') }}</option>
                                @endif
                                @if(@$blog->position_show == 'bottom')
                                    <option value="bottom">{{ trans('Blog::blog.add.form.position_show.bottom') }}</option>
                                    <option value="top">{{ trans('Blog::blog.add.form.position_show.top') }}</option>
                                    <option value="">{{ trans('Blog::blog.add.form.position_show.none') }}</option>
                                @endif
                           
                           @else
                           <option value="">{{ trans('Blog::blog.add.form.position_show.none') }}</option>
                           <option value="top">{{ trans('Blog::blog.add.form.position_show.top') }}</option>
                           <option value="bottom">{{ trans('Blog::blog.add.form.position_show.bottom') }}</option>
                           @endif 
                        </select>
                    </div>
                    </div>
                   
                </div>
            </div>
            <!--end::Body-->
        </div>
    </div>


    {{-- end: position show --}}
</div>
{{-- end: link thay thế --}}


    
</div>




<script src="admin/assets/plugins/global/plugins.bundle.js?v=7.0.5"></script>
<script src="admin/assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.5"></script>
<script src="admin/assets/js/scripts.bundle.js?v=7.0.5"></script>
<!--end::Global Theme Bundle-->

<script src="admin/assets/plugins/custom/jstree/jstree.bundle.js?v=7.0.5"></script>
<script src="admin/assets/js/pages/features/miscellaneous/treeview.js?v=7.0.5"></script>
<script src="admin/assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js?v=7.0.5"></script>
<script src="admin/assets/js/pages/crud/forms/widgets/select2.js?v=7.0.5"></script>
<script src="https://oms.hotdeal.vn/assets/global/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="third/editable/js/bootstrap-editable.min.js"></script>
<script src="js/crud/ckeditor/ckeditor.js"></script>


<script src="js/pages/tagify.js"></script>
<script src="js/pages/product.js"></script>