@if( !empty($tabs) && count($tabs) > 0)
<!--begin::Wizard Step Nav-->
@foreach($tabs as $index => $tab)
<div class="wizard-step"  data-wizard-type="step" data-wizard-state="step-{{ $index}}">
    <div class="wizard-wrapper step-{{ $index  + 1}}">
        <div class="wizard-number pl-8 pr-8">{{ !empty($tab->number) ? $tab->number : 0 }}</div>
        <div class="wizard-label">
            <div class="wizard-desc text-muted">
                @if($index < count($tabs) - 1)
                {{ @$titles[$index] . ' : ' .$tab->date }}
                @else
                {{ @$titles[$index] }}
                @endif
            </div>
            <div class="wizard-title"><h3 class="wizard-total">{{ !empty($tab->total) ? number_format($tab->total) : 0 }} đ</h3></div>
        </div>
    </div>
</div>
@endforeach
<!--end::Wizard Step Nav-->
@endif
