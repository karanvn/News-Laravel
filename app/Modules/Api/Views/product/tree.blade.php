@foreach($categories as $cate)
<li role="treeitem" id="jstree_node_{{ $cate->id }}" class="jstree-node jstree-closed jstree-node-{{ $cate->id }}">
    @php
    $statuses = !empty($flag) ? ['A','D'] : ['A'];
    $children = $cate->categories()->whereIn('status', $statuses)->get();
    @endphp
    @if(count($children) > 0)
    <i class="jstree-icon jstree-ocl jstree-icon-{{ $cate->id }}" onclick="show_trees({{ $cate->id }}, {{ @$flag }})" role="presentation" expanded="closed"></i>
    <i class="icon-l fas fa-long-arrow-alt-right" style="{{ !empty(@$is_banner) ? 'margin-top:13px;margin-left:-9px' : 'margin-top:5px;margin-left:-9px' }}"></i>
    @else
    <i class="icon-l fas fa-long-arrow-alt-right" style="margin-top:5px;margin-left:12px"></i>
    @endif

    <a class="jstree-anchor" style="margin-top:5px">
        <label class="radio-radio-rounded">
            @if(@$flag==0)
            <input type="radio" class="radio_parent_id" name="parent_id" value="{{ $cate->id }}" rel="{{ $cate->id }}">
            <span></span> <label class="category_name_{{ $cate->id }}">{{ $cate->name }}</label>
            @else
            <a href="{{ route('ProductCategoryEdit', [$cate->id]) }}"><span class="label label-{{ $cate->status == 'A' ? 'success' : 'danger' }} label-inline mr-2"><strong>{{ $cate->name }}</strong></span></a>
            @endif
        </label>
    </a>

    <ul class="jstree-container-ul jstree-children jstree-container-category jstree-children-{{ $cate->id }}" role="group" style="margin-left: 30px"></ul>

</li>
@endforeach
