@if(count($logs) > 0)
@foreach($logs as $index => $log)
@php
    $user = @$log->user()->first();
@endphp
<div class="timeline-item">
    <div class="timeline-media">
        <img alt="Pic" src="{{ show_image(config('auth_.image.thumb_path'), $user->avatar, config('auth_.image.no_image')) }}">
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
                    <a class="text-primary" target="_blank" href="{{ @$objects['route'] }}">{{ @$objects['title'] }}</a>
                </span>

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
            <span class="text-danger ml-2">
                {{ date('d-m-Y H:i', strtotime($log->created_at)) }}
                <span class="label label-lg label-danger mr-2">
                    {{ $startPage + $index }}
                </span>
            </span>
        </div>
    </div>
</div>
@endforeach
@endif
