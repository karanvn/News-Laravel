<form action="{{route("excelOrderStatis")}}" method="POST">
    @csrf
    
    @if(count($dates)==1)
    <input type="hidden" name="dates" value="Thống kê cho ngày {{$dates[0]}}">
    @else
    <input type="hidden" name="dates" value="Thống kê từ {{$dates[0]}} đến {{$dates[count($dates)-1]}}">
    @endif
    @if(!empty($categories))
                                @foreach($categories as $key => $value)
        <input type="hidden" name="categories[]" value="{{$value}}">
        <input type="hidden" name="com[]" value="{{!empty($values[$key]) ? $values[$key] : 0}}">
        <input type="hidden" name="can[]" value="{{!empty($valuesFalse[$key]) ? $valuesFalse[$key] : 0}}">
        <input type="hidden" name="conf[]" value="{{!empty($valuesCONF[$key]) ? $valuesCONF[$key] : 0}}">
        <input type="hidden" name="ship[]" value="{{!empty($valuesSHIP[$key]) ? $valuesSHIP[$key] : 0}}">
        <input type="hidden" name="pln[]" value="{{!empty($valuesPLN[$key]) ? $valuesPLN[$key] : 0}}">

                                @endforeach
                            @endif
    
                             
<div class="row">
    <div class="col">
        <h5 style="display:inline-block"><strong>{{ trans('Dashboard::dashboard.revenue') }}</strong></h5> </div>
    <div class="col text-right">
     <button  class="btn btn-danger">Xuất thống kê EXCEL</button>
    </div>
</div>
</form>
<table class="table">
    <tr>
        <td>Thời gian</td>
        <td>Thành công</td>
        <td>Thất bại</td>
        <td>Đang giao</td>
        <td>Đã xác nhận</td>
        <td>Mới đặt</td>
    </tr>
    @if(!empty($categories))
    @foreach($categories as $keys => $categorie)
    
       <tr>
           <td>{{$categorie}}</td>
           <td>{{@$values[$keys]}}</td>
           <td>{{@$valuesFalse[$keys]}}</td>
           <td>{{@$valuesSHIP[$keys]}}</td>
           <td>{{@$valuesCONF[$keys]}}</td>
           <td>{{@$valuesPLN[$keys]}}</td>
       </tr>
    @endforeach
    @endif
    
    </table>