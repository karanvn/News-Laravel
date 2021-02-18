<div class="row">
    <!--begin::Avatar-->
    <div class="col-lg-12">
        <!--begin::List Widget 10-->
        <div class="card card-custom card-stretchs gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">{{ trans('Blog::blog.add.form.avatar') }}
                </h3>
                <div class="card-toolbar"></div>
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
                                style="background-image: url({{ asset('storage/editor/blog/category/'.@$category->image) }});height:265px;width: 100%">
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
                            value="{{ @$category->seo_title }}">
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label">{{ trans('Blog::blog.add.form.seo_description') }}
                        </label>
                        <textarea class="form-control" rows="8"
                            name="seo_description">{{ @$category->seo_description }}</textarea>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label">{{ trans('Blog::blog.add.form.seo_link') }}</label>
                        <textarea class="form-control" rows="2"
                            name="seo_link">{{ @$category->seo_link }}</textarea>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label">{{ trans('Blog::blog.add.form.seo_keywords') }}</label>
                        <input class="form-control form-control-lg" type="text" name="seo_keywords" placeholder="" value="{{ @$category->seo_keywords }}">
                    </div>
                </div>
            </div>
            <!--end::Body-->
        </div>
    </div>

    {{-- booj caau hoir thuowfng gawjp --}}
    <div class="col-lg-12">
        <!--begin::List Widget 10-->
        <div class="card card-custom card-stretchs gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">Bộ câu hỏi thường gặp</h3>
                <div class="card-toolbar">
                    <div class="accordion accordion-light accordion-light-borderless accordion-toggle-plus"
                        id="accordion_seo">
                        <div class="card">
                            <div class="card-header">
                                <a class="add_que"><b>Thêm câu hỏi</b> +</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Header-->
            <div class="separator separator-solid"></div>
            <!--begin::Body-->
            <div class="card-body pt-5" id="contentque">
              
               @if(!empty($questions))
                @foreach ($questions as $question)
                <div class="form-group mb-2 bg-light row px-2 py-2 rounded">
                    <label class="col-form-label">Câu hỏi</label>
                    <input class="form-control form-control-lg" type="text" name="questions_name[]" placeholder="" value="{{@$question->questions}}">
                    <label class="col-form-label">Trả lời</label>
                    <input class="form-control form-control-lg" type="text" name="questions_reply[]" placeholder="" value="{{@$question->reply}}">
                </div>
                @endforeach

               @endif

                
                

            </div>
            <!--end::Body-->
        </div>
    </div>
</div>
<div class="inputque d-none">
    <div class="form-group mb-2 bg-light row px-2 py-2 rounded">
        <label class="col-form-label">Câu hỏi</label>
        <input class="form-control form-control-lg" type="text" name="questions_name[]" placeholder="" value="">
        <label class="col-form-label">Trả lời</label>
        <input class="form-control form-control-lg" type="text" name="questions_reply[]" placeholder="" value="">
    </div>
</div>
<script>
    $('.add_que').on('click', function(){
        $('#contentque').append($('.inputque').html());
    })
</script>