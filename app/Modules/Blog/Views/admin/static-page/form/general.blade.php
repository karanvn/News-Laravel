<div class="col-lg-12">
    <!--begin::Body-->
    <input  type="hidden" name="blog_category_id" placeholder="blog_category_id" value="21">
    <div class="form-group row">
        <label class="col-form-label">Tên Page Page tĩnh <span
                class="label-text-error">*</span></label>
        <input class="form-control form-control-lg" type="text"
            name="title" placeholder=""
            value="{{ isset($blog->title)?$blog->title:old('title') }}">
        <span class="form-text text-error name-error">
            @if($errors->has('title'))
            <p class="text-danger"> {{$errors->first('title')}}</p>
            @endif
        </span>
    </div>
    
    <div class="form-group row">
        <label
            class="col-form-label">Tên ngắn Page Tĩnh</label>
        <input type="name" class="form-control" name="title_short" value="{{ isset($blog->title_short)?$blog->title_short:old('title_short') }}">
        @if($errors->has('title_short'))
        <p class="text-danger"> {{$errors->first('title_short')}}</p>
        @endif
    </div>
    <div class="form-group row">
        <label
            class="col-form-label">{{ trans('Blog::blog.add.form.slug') }}</label>
        <input type="name" class="form-control" name="slug" value="{{ isset($blog->slug)?$blog->slug:old('slug') }}">
        @if($errors->has('slug'))
        <p class="text-danger"> {{$errors->first('slug')}}</p>
        @endif
    </div>
    <div class="form-group row">
        <label class="col-form-label" style="width: 100%">Nội dung page tĩnh
            <span class="label-text-error">*</span></label>
            <textarea id="blog_content"  class="ckeditor" name="content" rows="3">{{ isset($blog->content)?$blog->content:old('content') }}</textarea>
            @if($errors->has('content'))
            <p class="text-danger"> {{$errors->first('content')}}</p>
            @endif
    </div>
    <div class="form-group row">
        <label class="col-form-label">{{ trans('Blog::blog.add.form.status') }}
            <span class="label-text-error">*</span>
        </label>
        <select class="form-control custom-select" name="status">
            <option disabled> {{ trans('Blog::blog.add.form.header_status') }}</option>
            <option value="A" {{ @$blog->status=='A' ? 'selected' : '' }}>{{ trans('Blog::blog.statuses.A') }}</option>
            <option value="D" {{ @$blog->status=='D' ? 'selected' : '' }}>{{ trans('Blog::blog.statuses.D') }}</option>
        </select>
        @if($errors->has('status'))
            <p class="text-danger"> {{$errors->first('status')}}</p>
        @endif
    </div>
    <!--end::Body-->
</div>