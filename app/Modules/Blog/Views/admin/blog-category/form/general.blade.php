<link href="admin/assets/plugins/global/plugins.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
<link href="admin/assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
<link href="admin/assets/css/style.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
<script src="https://danpianoco.vn/js/crud/ckeditor/ckeditor.js"></script>
<!--end::Global Theme Styles-->
<!--begin::Layout Themes(used by all pages)-->
<link href="admin/assets/css/themes/layout/header/base/dark.css?v=7.0.5" rel="stylesheet" type="text/css" />
<link href="admin/assets/css/themes/layout/header/menu/light.css?v=7.0.5" rel="stylesheet" type="text/css" />
<link href="admin/assets/css/themes/layout/brand/dark.css?v=7.0.5" rel="stylesheet" type="text/css" />
<link href="admin/assets/css/themes/layout/aside/dark.css?v=7.0.5" rel="stylesheet" type="text/css" />
<link href="css/pages/styles.css" rel="stylesheet" type="text/css" />
<!--end::Layout Themes-->
<link rel="shortcut icon" href="admin/assets/media/logos/favicon.ico" />
<link href="admin/assets/plugins/custom/jstree/jstree.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
<div class="col-lg-12">
    {{-- <div class="form-group row">
        <label
            class="col-form-label">{{trans('Blog::blogcategory.add.form.header_category_parent') }}
        </label>
        <select class="form-control custom-select" name="parent_id"
            id="status">
            <option selected value="">{{trans('Blog::blogcategory.add.form.header_category_parent_select') }}</option>
            @foreach($categoriesparent as $parent)
            <option {{ @$category->parent_id==$parent->id?'selected':'' }}  value="{{ @$parent->id }}">
                {{ $parent->title_short }}
            </option>
            @endforeach
            
        </select>
        @if($errors->has('status'))
        <p class="text-danger"> {{$errors->first('status')}}</p>
        @endif
        </p>
    </div> --}}
    


    <div class="form-group row">
        <label>
            @if(isset($category))
            @php
            $parent = $category->parent()->get()->first();
            @endphp
            <div class="input-group">
                <input type="hidden" name="parent_id" value="{{ @$category->parent_id }}">
               <p>Danh mục cha hiện tại: {{ $parent ? $parent->title :  'Danh mục cha' }}</p>
            <span class="label-text-error">*</span></label>
            </div>

            @endif
        @if(!empty($categoriesparent))
        <div class="input-group" style="background: #F3F6F9;border-radius:5px;">
            <div class="radio-list">
                <div id="kt_tree_111" class="tree jstree-default" role="tree">
                    <ul class="jstree-container-ul jstree-children" role="group" style="padding: 10px">
                        <li role="treeitem" aria-selected="false" aria-level="1" aria-labelledby="j1_1_anchor" aria-expanded="false" id="j1_1" class="jstree-node jstree-closed">
                            <a class="jstree-anchor">
                                <label class="radio-radio-rounded">
                                    <input type="radio" class="radio_parent_id" name="parent_id" value="0" rel="0">
                                    <span></span> <label class="category_name_0">Danh mục cha</label>
                                </label>
                            </a>
                        </li>
                        @foreach($categoriesparent as $cate)
                        <li role="treeitem" id="jstree_node_{{ $cate->id }}" class="jstree-node jstree-closed jstree-node-{{ $cate->id }}">
                            @php
                            $statuses = !empty($flag) ? ['A','D'] : ['A'];
                            $children = $cate->categories()->whereIn('status', $statuses)->get();
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
                                    <a href="{{ route('blog-category-edit', [$cate->id]) }}"><span class="label label-{{ $cate->status == 'A' ? 'success' : 'danger' }} label-inline mr-0"><strong>{{ $cate->title }}</strong>
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
                        
                    </ul>
                </div>
            </div>
        </div>
        @endif
    </div>
    


    {{-- end parent --}}
    <div class="form-group row">
        <label
            class="col-form-label">{{trans('Blog::blogcategory.add.form.title') }}</label>
        <input type="name" class="form-control" name="title" value="{{ @$category->title }}">
        @if($errors->has('title'))
        <p class="text-danger"> {{$errors->first('title')}}</p>
        @endif
    </div>
    <div class="form-group row">
        <label
            class="col-form-label">{{trans('Blog::blogcategory.add.form.title_short') }}</label>
        <input type="name" class="form-control" name="title_short" value="{{ @$category->title_short }}">
        @if($errors->has('title_short'))
        <p class="text-danger"> {{$errors->first('title_short')}}</p>
        @endif
    </div>
    <div class="form-group row">
        <label
            class="col-form-label">{{trans('Blog::blogcategory.add.form.description') }}</label>
        <textarea class="form-control" name="description" id="product_note">{{ @$category->description }}</textarea>
        @if($errors->has('title_shdescriptionort'))
        <p class="text-danger"> {{$errors->first('description')}}</p>
        @endif
    </div>
    <div class="form-group row">
        <label
            class="col-form-label">{{trans('Blog::blogcategory.add.form.slug') }}</label>
        <input type="name" class="form-control" name="slug" value="{{ @$category->slug }}">
        @if($errors->has('slug'))
        <p class="text-danger"> {{$errors->first('slug')}}</p>
        @endif
    </div>
    <div class="form-group row">
        <label
            class="col-form-label">{{trans('Blog::blogcategory.add.form.position') }}
        </label>
        <select class="form-control custom-select" name="position"
            id="status">
            <option disabled>{{trans('Blog::blogcategory.add.form.select_position') }}</option>
            <option {{ @$category->position=='BLOG'?'selected':'' }} value="BLOG">
                {{trans('Blog::blogcategory.positions.BLOG') }}
            </option>
            <option {{ @$category->position=='FOOTER'?'selected':'' }} value="FOOTER">
                {{trans('Blog::blogcategory.positions.FOOTER') }}
            </option>
            <option {{ @$category->position=='HOME'?'selected':'' }} value="HOME">
                Trang chủ
            </option>
            <option {{ @$category->position=='SERVICE'?'selected':'' }} value="SERVICE">
                Dịch vụ
            </option>
            <option {{ @$category->position=='NONE'?'selected':'' }} value="NONE">
                {{trans('Blog::blogcategory.positions.NONE') }}
            </option>
        </select>
        @if($errors->has('status'))
        <p class="text-danger"> {{$errors->first('status')}}</p>
        @endif
        </p>
    </div>
    <!-- status -->
    <div class="form-group row">
        <label
            class="col-form-label">{{trans('Blog::blogcategory.add.form.status') }}
        </label>
        <select class="form-control custom-select" name="status"
            id="status">
            <option disabled>{{trans('Blog::blogcategory.add.form.header_status') }}</option>
            <option {{ @$category->status=='A'?'selected':'' }} value="A">
                {{trans('Blog::blogcategory.add.form.statuses.A') }}
            </option>
            <option {{ @$category->status=='D'?'selected':'' }} value="D">
                {{trans('Blog::blogcategory.add.form.statuses.D') }}
            </option>  
        </select>
        @if($errors->has('status'))
        <p class="text-danger"> {{$errors->first('status')}}</p>
        @endif
        </p>
    </div>
    {{-- show home --}}
    <div class="form-group row">
        <label class="col-form-label">Hiển thị ngoài trang chủ</label>
        <select class="form-control custom-select" name="showHome">
            <option value="D">Vô hiệu</option>
            <option value="A" {{ @$category->showHome == 'A' ? 'selected' :  '' }}>Hiển thị</option>
        </select>
    </div>
    <!-- Type menu -->
    <div class="form-group row">
        <label class="col-form-label mr-5">Chọn kiểu menu:</label>
            <div style="line-height: 40px">
                <input type="radio" name="type" value="1" @if (@$category->type == 1) checked @endif>&nbsp;Menu bình thường &nbsp;&nbsp;
            <input type="radio" name="type" value="2" @if (@$category->type == 2) checked @endif>&nbsp;Menu hot
            </div>
        </p>
    </div>
</div>
<script src="admin/assets/plugins/global/plugins.bundle.js?v=7.0.5"></script>
<script src="admin/assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.5"></script>
<script src="admin/assets/js/scripts.bundle.js?v=7.0.5"></script>
<!--end::Global Theme Bundle-->


<script src="admin/assets/plugins/custom/jstree/jstree.bundle.js?v=7.0.5"></script>
<script src="admin/assets/js/pages/features/miscellaneous/treeview.js?v=7.0.5"></script>
<script src="js/pages/product.js"></script>