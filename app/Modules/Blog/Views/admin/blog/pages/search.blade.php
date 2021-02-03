<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-2 col-xl-2">
            <div class="form-group">
                <label class="col-form-label"><strong>{{ trans('Blog::blog.list.filter.id') }}</strong></label>
                <input type="text" name="id" class="form-control" placeholder="" value="">
            </div>
        </div>

        <div class="col-lg-2 col-xl-3">
            <div class="form-group">
                <label class="col-form-label"><strong>{{ trans('Blog::blog.list.filter.name') }}</strong></label>
                <input type="title_short" name="title_short" class="form-control" placeholder="" value="">
            </div>
        </div>

        <div class="form-group col-lg-4" style="width: 100%">
            <div class="input-group">
                <label class="col-form-label">
                    <strong>{{ trans('Blog::blog.list.filter.category') }}</strong>
                    {{-- <a data-toggle="modal" data-target="#modalTreeCategories" class="btn-light-success"><span class="label label-danger label-inline mr-2">Thêm</span></a> --}}
                    <a class="btn-light-success" href="{{ route('blog-category-add') }}"><span class="label label-danger label-inline mr-2">{{ trans('Blog::blog.list.filter.add') }}</span></a>
                </label>
            </div>
            <div class="input-group">
                <select class="form-control custom-select" name="blog_category_id">
                    <option selected value="">---TẤT CẢ---</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title_short }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-3 col-xl-3">
            <div class="form-group">
                <label class="col-form-label"><strong>{{ trans('Blog::blog.list.filter.status') }}</strong></label>
                <select class="form-control custom-select" name="status">
                    <option selected value="">---TẤT CẢ---</option>
                    <option value="D">Ẩn</option>
                    <option value="A">Kích hoạt</option>
                </select>
            </div>
        </div>

    </div>
</div>