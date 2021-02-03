<input type="hidden" name ="id" value="{{ @$blog->id }}">
<div class="col-lg-12">
    <!--begin::Body-->
    <div class="form-group row">
        <label class="col-form-label">{{ trans('Blog::blog.add.form.title') }} <span
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
            class="col-form-label">{{ trans('Blog::blog.add.form.title_short') }}</label>
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
        <label class="col-form-label" style="width: 100%">{{ trans('Blog::blog.add.form.description') }}
            <span class="label-text-error">*</span></label>
        <textarea id="blog_description"  class="ckeditor" name="description" rows="3">{{ isset($blog->description)?$blog->description:old('description') }}</textarea>
        @if($errors->has('description'))
            <p class="text-danger"> {{$errors->first('description')}}</p>
        @endif
    </div>
    <div class="form-group row">
        <label class="col-form-label" style="width: 100%">{{ trans('Blog::blog.add.form.content') }}
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
    <div class="form-group row">
        <label class="col-form-label">Hiển thị ngoài trang chủ
            <span class="label-text-error">*</span>
        </label>
        <select class="form-control custom-select" name="show_home">
            <option value="D" {{ @$blog->show_home=='D' ? 'selected' : '' }}>{{ trans('Blog::blog.statuses.D') }}</option>
            <option value="A" {{ @$blog->show_home=='A' ? 'selected' : '' }}>{{ trans('Blog::blog.statuses.A') }}</option>
        </select>
        @if($errors->has('status'))
            <p class="text-danger"> {{$errors->first('status')}}</p>
        @endif
    </div>
    <!--end::Body-->
    <div class="form-group row">
        <label class="col-form-label">Icon blog
        </label>
        <input type="text" class="form-control" name="icon" value="{{@$blog->icon}}">
     
    </div>
</div>