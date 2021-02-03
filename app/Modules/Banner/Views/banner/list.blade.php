@foreach($banners as $banner)
<div class="col-xl-6 col-lg-12 col-md-12 item ui-sortable-handle">
    <!--begin::Card-->
    <input type="hidden" name="ids[]" value="{{ $banner->id }}">
    <div class="card card-custom gutter-b card-stretch">
        <div class="card-body">
            <!--begin::Top-->
            <div class="d-flex align-items-center">
                <!--begin::Info-->
                <div class="d-flex flex-column flex-grow-1">
                    @php
                        $published_labels = trans('Banner::banner.published_labels');
                        $published = get_banner_published($banner->published_start, $banner->published_end);
                        $pub_status = key($published);
                        $pub_title = $published[$pub_status];
                    @endphp
                    <strong>{{ get_banner_types()[@$banner->type] }}
                    <span class="label label-{{ @$published_labels[$pub_status] }} label-inline mr-2">{{ $pub_title }}</span></strong>
                    <span class="text-muted font-weight-bold"><i class="icon-x text-dark-10 flaticon-calendar-with-a-clock-time-tools"></i>  {{ date('d-m-Y H:i', strtotime($banner->published_start)) }} /  {{ date('d-m-Y H:i', strtotime($banner->published_end)) }}</span>
                </div>
                <!--end::Info-->
                <span class="label label-{{ $banner->status == 'A' ? 'success' : 'danger' }} label-inline mr-2">{{ get_banner_statuses()[$banner->status] }}</span>
            </div>
            <!--end::Top-->
            <!--begin::Bottom-->
            <div class="pt-4">
                <!--begin::Image-->
                <div class="bgi-no-repeat bgi-size-cover rounded min-h-265px" style="background-image: url({{  show_image(config('banner.image.org_path'), $banner->avatar) }})"></div>
                <!--end::Image-->
                <!--begin::Text-->
                <p class="text-dark-75 font-size-lg font-weight-normal  pt-5 mb-2"><a href="{{ route('BannerEdit', [$banner->id]) }}" class="text-dark font-weight-bold text-hover-success font-size-h4 mb-0"><i class="icon-x text-dark-10 flaticon2-image-file"></i> {{ $banner->name }}</a></p>
                <!--end::Text-->

                @if(!empty($banner->object_id))
                <div class="text-dark-75 font-size-lg font-weight-normal">
                @php
                    $object = $obj->get_object($banner->id);
                @endphp
                    <i class="icon-x text-dark-10 flaticon2-poll-symbol"></i> {{ Str::limit(@$object->name, 80, '...') }}{{ Str::limit(@$object->title, 80, '...') }}
                </div>
                @endif

                @if(!empty($banner->link))
                <div class="text-dark-75 font-size-lg font-weight-normal">
                <a href="{{ $banner->link }}" target="_blank" class="btn btn-icon-danger btn-sm btn-text-dark-10 rounded font-weight-bolder font-size-sm p-2" style="margin-left: -7px">
                    <i class="icon-x text-dark-10 flaticon2-analytics"></i> {{ $banner->link }}
                </a>
                </div>
                @endif

                <div class="d-flex align-items-center">
                    @php
                        $user = $banner->user()->get()->first();
                    @endphp
                    <span class="btn btn-hover-text-success btn-hover-icon-success btn-sm btn-text-dark-50 bg-hover-light-success font-weight-bolder font-size-sm p-2">
                        <i class="icon-x text-dark-10 flaticon2-user"></i> {{ @$user->name }}
                    </span>

                    <span class="btn btn-icon-danger btn-sm btn-text-dark-50 rounded font-weight-bolder font-size-sm p-2">
                        <i class="icon-x text-dark-10 flaticon-calendar-with-a-clock-time-tools"></i> {{ date('d-m-Y H:i', strtotime($banner->created_at)) }}
                    </span>
                </div>
                <!--end::Action-->
            </div>
            <!--end::Bottom-->
        </div>
    </div>
    <!--end::Card-->
</div>
@endforeach
