<div class="cls{{ $block->position_type }}">
    <input type="hidden" name="block_ids[]" value="{{ $block->block_id }}">
    {!! $block->html !!}
</div>
