@php
$sedBlocks = !empty($tpl) ?  @$tpl->blocks()->get() : false;
@endphp
<div class="template_body drag-body ui-sortable ui-droppable">
    @if($sedBlocks)
    <div class="text-center ui-sortable-handle pb-4">
        {{ $tpl->subject }}
    </div>
    @foreach($sedBlocks as $block)
        @include('Mail::tpl.item')
    @endforeach
    @endif
</div>
<span class="form-text text-error block-ids-error"></span>
