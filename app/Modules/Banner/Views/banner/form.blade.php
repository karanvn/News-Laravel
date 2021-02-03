<!--begin::Body-->
<input type="hidden" name="id" value="{{ @$banner->id }}" />
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Banner::banner.add.form.avatar') }} <span class="label-text-error">*</span></label>
    <div class="col-lg-9 col-xl-6">
        <div class="image-input image-input-outline" id="kt_image" style="width: 100%">
            <div class="image-input-wrapper" style="background-image: url({{ show_banner(config('banner.image.org_path'), @$banner->avatar) }}); width: 100%"></div>
            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-success btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="{{ trans('Banner::banner.add.form.avatar_change') }}">
                <i class="icon-x text-dark-50 flaticon2-image-file"></i>
                <input type="file" name="avatar" accept=".png, .jpg, .jpeg">
            </label>
            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-success btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="{{ trans('Banner::banner.add.form.avatar_cancel') }}">
                <i class="icon-x text-dark-50 flaticon-delete-1"></i>
            </span>
        </div>
        <span class="form-text text-muted">{{ trans('Banner::banner.add.form.allow_image_extension') }}</span>
        <span class="form-text text-error avatar-error"></span>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Banner::banner.add.form.name') }} <span class="label-text-error">*</span></label>
    <div class="col-lg-9 col-xl-6">
        <input class="form-control form-control-lg form-control-solid" type="text" name="name" placeholder="" value="{{ @$banner->name }}">
        <span class="form-text text-error name-error"></span>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Banner::banner.add.form.type') }}</label>
    <div class="col-lg-9 col-xl-6">
        <select class="form-control custom-select form-control-solid banner-type" name="type" id="typeObject">
            @foreach(get_banner_types() as $key => $value)
            <option value="{{ $key }}" {{ @$banner->type == $key ? "selected" : '' }}>{{ $value }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Banner::banner.add.form.published_start') }} <span class="label-text-error">*</span></label>
    <div class="col-lg-9 col-xl-6">
        <div class="input-group date">
            <input type="text" class="form-control" name="published_start" readonly="readonly" value="{{ !empty($banner->published_start) ? $banner->published_start : date('Y-m-d H:i') }}" id="dtpk_published_start">
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="la la-calendar glyphicon-th"></i>
                </span>
            </div>
        </div>
        <span class="form-text text-error published_start-error"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Banner::banner.add.form.published_end') }} <span class="label-text-error">*</span></label>
    <div class="col-lg-9 col-xl-6">
        <div class="input-group date">
            <input type="text" class="form-control" name="published_end" readonly="readonly" value="{{ !empty($banner->published_end) ? $banner->published_end : date('Y-m-d H:i') }}" id="dtpk_published_end">
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="la la-calendar glyphicon-th"></i>
                </span>
            </div>
        </div>
        <span class="form-text text-error published_end-error"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Banner::banner.add.form.extension') }}</label>
    <div class="col-lg-9 col-xl-6">
        <select class="form-control custom-select" name="extension">
            @foreach(get_banner_extensions() as $key => $value)
            <option value="{{ $key }}" {{ @$banner->extension == $key ? "selected" : '' }}>{{ $value }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Banner::banner.add.form.link_youtube') }}</label>
    <div class="col-lg-9 col-xl-6">
        <input class="form-control form-control-lg form-control-solid" name="link_youtube" type="text" value="{{ @$banner->link_youtube }}" placeholder="">
    </div>
</div>

<div class="form-group row">
    <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Banner::banner.add.form.link') }} </label>
    <div class="col-lg-9 col-xl-6">
        <input class="form-control form-control-lg form-control-solid" name="link" type="text" value="{{ @$banner->link }}" placeholder="">
    </div>
</div>

<div class="form-group row">
    <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Banner::banner.add.form.titlebutton') }} </label>
    <div class="col-lg-9 col-xl-6">
        <input class="form-control form-control-lg form-control-solid" name="titlebutton" type="text" value="{{ @$banner->titlebutton }}" placeholder="">
    </div>
</div>

<div class="form-group row">
    <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Banner::banner.add.form.object_id') }} </label>
    <div class="col-lg-9 col-xl-6">
        <select class="form-control form-control-lg form-control-solid" name="object_id" value="{{ @$banner->object_id }}" id="object_id">
           @if(!empty($objects))
           @if($banner->type=='CATEGORY')
          
        @foreach($objects->where('parent_id','0') as $dataCa)
            <option value="{{$dataCa->id}}" {{@$dataCa->id == @$banner->object_id ? 'selected' : '' }}>{{$dataCa->name}}</option>
                @foreach($objects->where('parent_id', $dataCa->id) as $dataChild)
                    <option value="{{$dataChild->id}}" {{@$dataChild->id == @$banner->object_id ? 'selected' : '' }}>--{{$dataChild->name}}</option>
                    @foreach($objects->where('parent_id', $dataChild->id) as $dataChildTwo)
                        <option value="{{$dataChildTwo->id}}"  {{@$dataChildTwo->id == @$banner->object_id ? 'selected' : '' }}>----{{$dataChildTwo->name}}</option>
                    @endforeach
                @endforeach
        @endforeach
       @endif
   
       @if($banner->type=='CATEGORYBLOG')
      
           @foreach($objects->where('parent_id','0') as $dataCa)
           <option value="{{$dataCa->id}}" {{@$dataCa->id == @$banner->object_id ? 'selected' : '' }}>{{$dataCa->title}}</option>
           @foreach($objects->where('parent_id', $dataCa->id) as $dataChild)
                   <option value="{{$dataChild->id}}" {{@$dataChild->id == @$banner->object_id ? 'selected' : '' }}>--{{$dataChild->title}}</option>
                   @foreach($objects->where('parent_id', $dataChild->id) as $dataChildTwo)
                       <option value="{{$dataChildTwo->id}}" {{@$dataChildTwo->id == @$banner->object_id ? 'selected' : '' }}>----{{$dataChildTwo->title}}</option>
                   @endforeach
               @endforeach
       @endforeach
       @endif
       @if($banner->type=='COLLECTION')
      
           @foreach($objects as $dataCa)
           <option value="{{$dataCa->id}}" {{@$dataCa->id == @$banner->object_id ? 'selected' : '' }}>{{$dataCa->name}}</option>
       @endforeach
       @endif

           @else
            <option value="">==============</option>
           @endif
        </select>
        @if(!empty($banner->object_id))
        <span class="form-text"><strong>{{ @$obj->get_object($banner->id)->name }}</strong></span>
        @endif
        <span class="form-text text-error object_id-error"></span>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Banner::banner.add.form.description') }}</label>
    <div class="col-lg-9 col-xl-6">
        <input class="form-control form-control-lg form-control-solid" name="description" type="text" value="{{ @$banner->description }}" placeholder="">
    </div>
</div>

<div class="form-group row">
    <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Banner::banner.add.form.status') }}</label>
    <div class="col-lg-9 col-xl-6">
        <select class="form-control custom-select form-control-solid" name="status">
            @foreach(get_banner_statuses() as $key => $value)
            <option value="{{ $key }}" {{ @$banner->status == $key ? "selected" : '' }}>{{ $value }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row" id="showhome">
    <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Banner::banner.add.form.showhome.title') }}</label>
    <div class="col-lg-9 col-xl-6">
        <select class="form-control custom-select form-control-solid" name="showhome">
            @if(@$banner->showhome=='A')
                    <option value="A">{{ trans('Banner::banner.add.form.showhome.A') }}</option>
                    <option value="D">{{ trans('Banner::banner.add.form.showhome.D') }}</option>
            @else
                <option value="D">{{ trans('Banner::banner.add.form.showhome.D') }}</option>
                <option value="A">{{ trans('Banner::banner.add.form.showhome.A') }}</option>
            @endif
        </select>
    </div>
</div>
<!--end::Body-->
<script src="{{asset('js/newpage/jquery/jquery.min.js')}}"></script>

<script>
    $('#typeObject').on('change', function(){
        if(($(this).val()=="CATEGORYBLOG")||($(this).val()=="CATEGORY")||($(this).val()=="COLLECTION")){
        $('#showhome').show();
        
        $.ajax("/admins/banner/objectAddBanner/" + $(this).val(), {
		method: "GET",
		dataType: "json",
		contentType: !1,
		cache: !1,
		processData: !1,
		success: function (a) {
           $('#object_id').html(a.html);
		}
	})
    }else{
        $('#showhome').hide();
        $("#showhome select").val("D");
    }

    })
    if(($('#typeObject').val()=="CATEGORYBLOG")||($('#typeObject').val()=="CATEGORY")||($('#typeObject').val()=="COLLECTION")){
        $('#showhome').show();
    }else{
        $('#showhome').hide();
        $("#showhome select").val("D");
    }

</script>
