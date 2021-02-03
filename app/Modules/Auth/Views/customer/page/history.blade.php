<div class="row">
    <div class="col-lg-12 col-xxl-12">
        <!--begin::List Widget 9-->
        <div class="card card-custom card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header align-items-center border-0 mt-4">
                <h3 class="card-title align-items-start flex-column">
                    <span class="font-weight-bolder text-dark">{{ trans('Log::log.other.title') }}</span>
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">{{ @$logs->count() }} {{ trans('Log::log.other.total') }}</span>
                </h3>
                <div class="card-toolbar">

                </div>
            </div>
            <!--end::Header-->
            <div class="separator separator-solid"></div>
            <!--begin::Body-->
            <div class="card-body pt-4">
                <div class="timeline timeline-3">
                    <div class="timeline-items">
                        @foreach($logs as $log)
                        @php
                            $user = @$log->user()->first();
                        @endphp
                        <div class="timeline-item">
                            <div class="timeline-media symbol symbol-circle">
                                <img alt="Pic" src="{{ show_image(config('auth_.image.thumb_path'), $user->avatar) }}">
                            </div>
                            <div class="timeline-content">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="mr-2 font-size-h6">
                                        <span class="text-dark-75 font-weight-bold">
                                            <a class="text-primary" target="_blank" href="{{ route('CustomerEdit', [@$user->id, 'general']) }}">{{ @$user->name }}</a>
                                            {{ @get_log_types()[$log->action] }}
                                            @php
                                                $objects = @$lib->objectLogs($log);
                                            @endphp
                                            <a class="text-primary" target="_blank" href="{{ $objects['route'] }}">{{ $objects['title'] }}</a>
                                        </span>
                                    </div>
                                    <span class="text-danger ml-2">{{ date('d-m-Y H:i', strtotime($log->created_at)) }}</span>
                                </div>
                                @php
                                    $data_logs = @unserialize($log->data);
                                @endphp
                                <div>
                                    @if(!empty($data_logs))
                                    @foreach($data_logs as $key => $value)
                                    <div class="d-flex align-items-center">
                                        <span class="font-weight-bold mr-2" style="min-width: 80px"><strong><i class="icon-xs la la-plus"></i> {{ $key }}:</strong></span>
                                        <span class="text-dark">{!! $value !!}</span>
                                    </div>
                                    @endforeach
                                @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!--end: Card Body-->
        </div>
        <!--end: Card-->
        <!--end: List Widget 9-->
    </div>

</div>
