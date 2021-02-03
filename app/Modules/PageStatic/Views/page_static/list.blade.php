@php
    // dd(config('page_static.image.org_path'));
@endphp

@foreach($pageStatics as $item)
<div class="col-xl-6 col-lg-12 col-md-12 item ui-sortable-handle">
    <!--begin::Card-->
    <input type="hidden" name="ids[]" value="{{ $item->id }}">
    <div class="card card-custom gutter-b card-stretch">
        <div class="card-body">
            <!--begin::Top-->
            <div class="d-flex align-items-center">
                <!--begin::Info-->
                <div class="d-flex flex-column flex-grow-1">
                    <!--begin::Text-->
                    <p class="text-dark-75 font-size-lg font-weight-normal  pt-2 mb-2"><a href="{{ route('PageStaticEdit', [$item->id]) }}" class="text-dark font-weight-bold text-hover-success font-size-h4 mb-0"><i class="icon-x text-dark-10 flaticon2-image-file"></i> {{ $item->title }}</a></p>
                    <!--end::Text-->
                    <span class="text-muted font-weight-bold"><i class="icon-x text-dark-10 flaticon-calendar-with-a-clock-time-tools"></i>  {{ date('d-m-Y H:i', strtotime($item->published_start)) }} /  {{ date('d-m-Y H:i', strtotime($item->published_end)) }}</span>
                </div>
                <!--end::Info-->
                <span class="label label-{{ $item->status == '1' ? 'success' : 'danger' }} label-inline mr-2">{{ get_page_static_statuses()[$item->status] }}</span>
            </div>
            <!--end::Top-->
            <!--begin::Bottom-->
            <div class="pt-4">
                
                <!--begin::Image-->
                <div class="bgi-no-repeat bgi-size-cover rounded min-h-265px" style="background-image: url({{'storage/page_static/org/'.@$item->image}})"></div>
                <!--end::Image-->
                

                @if(!empty($item->seo_link))
                <div class="text-dark-75 font-size-lg font-weight-normal">
                <a href="{{ $item->seo_link }}" target="_blank" class="btn btn-icon-danger btn-sm btn-text-dark-10 rounded font-weight-bolder font-size-sm p-2" style="margin-left: -7px">
                    <i class="icon-x text-dark-10 flaticon2-analytics"></i> {{ $item->seo_link }}
                </a>
                </div>
                @endif

                <div class="d-flex align-items-center">
                    @php
                        $user = $item->user()->get()->first();
                    @endphp
                    <span class="btn btn-hover-text-success btn-hover-icon-success btn-sm btn-text-dark-50 bg-hover-light-success font-weight-bolder font-size-sm p-2">
                        <i class="icon-x text-dark-10 flaticon2-user"></i> {{ @$user->name }}
                    </span>

                    <span class="btn btn-icon-danger btn-sm btn-text-dark-50 rounded font-weight-bolder font-size-sm p-2">
                        <i class="icon-x text-dark-10 flaticon-calendar-with-a-clock-time-tools"></i> {{ date('d-m-Y H:i', strtotime($item->created_at)) }}
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
