@if(!empty($datas))
    @if($type=='CATEGORY')
        @foreach($datas->where('parent_id','0') as $data)
            <option value="{{$data->id}}">{{$data->name}}</option>
                @foreach($datas->where('parent_id', $data->id) as $dataChild)
                    <option value="{{$dataChild->id}}">--{{$dataChild->name}}</option>
                    @foreach($datas->where('parent_id', $dataChild->id) as $dataChildTwo)
                        <option value="{{$dataChildTwo->id}}">----{{$dataChildTwo->name}}</option>
                    @endforeach
                @endforeach
        @endforeach
    @endif

    @if($type=='CATEGORYBLOG')
        @foreach($datas->where('parent_id','0') as $data)
            <option value="{{$data->id}}">{{$data->title}}</option>
            @foreach($datas->where('parent_id', $data->id) as $dataChild)
                    <option value="{{$dataChild->id}}">--{{$dataChild->title}}</option>
                    @foreach($datas->where('parent_id', $dataChild->id) as $dataChildTwo)
                        <option value="{{$dataChildTwo->id}}">----{{$dataChildTwo->title}}</option>
                    @endforeach
                @endforeach
        @endforeach
    @endif
    @if($type=='COLLECTION')
        @foreach($datas as $data)
        <option value="{{$data->id}}">{{$data->name}}</option>
        @endforeach
    @endif


@else
<option value="0">=============</option>
@endif