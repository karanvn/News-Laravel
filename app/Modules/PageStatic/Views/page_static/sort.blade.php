<div class="col-xl-12 col-lg-12 col-md-12">
    <form id="frmSortBanner" name="frmSortBanner" method="post" class="form-horizontal row drag-body ui-sortable ui-droppable" role="form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="message_loading" value="{{ trans('custom.loading') }}" />
        @foreach($banners as $banner)
        <div class="col-xl-6 col-lg-12 col-md-12 item ui-sortable-handle">
            <input type="hidden" name="ids[]" value="{{ $banner->id }}">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <!--begin::Top-->
                    @php
                        $published_labels = trans('Banner::banner.published_labels');
                        $published = get_banner_published($banner->published_start, $banner->published_end);
                        $pub_status = key($published);
                        $pub_title = $published[$pub_status];
                    @endphp
                    <div class="d-flex flex-wrap align-items-center mb-0">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-80 symbol-2by3 flex-shrink-0 mr-4">
                            <div class="symbol-label" style="background-image: url('{{  show_image(config('banner.image.org_path'), $banner->avatar) }}')"></div>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Title-->
                        <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                            <a class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ Str::limit($banner->name, 40) }}</a>
                            <span class="text-muted font-weight-bold font-size-sm my-1">
                                <i class="icon-x text-dark-10 flaticon-calendar-with-a-clock-time-tools"></i> {{ date('d-m-Y H:i', strtotime($banner->published_start)) }} / {{ date('d-m-Y H:i', strtotime($banner->published_end)) }}
                            </span>
                        </div>
                        <!--end::Title-->
                        <!--begin::Info-->
                        <div class="d-flex align-items-center py-lg-0 py-2">
                            <div class="d-flex flex-column text-right">
                                <span class="label label-{{ @$published_labels[$pub_status] }} label-inline mr-2">{{ $pub_title }}</span></strong>
                            </div>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Top-->
                </div>
            </div>
        </div>
        @endforeach
    </form>
</div>

