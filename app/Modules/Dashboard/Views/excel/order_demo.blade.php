<form action="{{route("excelRevenueStatis")}}" method="POST">
    @csrf

    @if(count($dates)==1)
        <input type="hidden" name="dates" value="Thống kê cho ngày {{$dates[0]}}">
    @else
        <input type="hidden" name="dates" value="Thống kê từ {{$dates[0]}} đến {{$dates[count($dates)-1]}}">
    @endif

    @if(!empty($categories))
        @foreach($categories as $key => $value)
            <input type="hidden" name="categories[]" value="{{$value}}">
            <input type="hidden" name="values[]" value="{{!empty($values[$key]) ? $values[$key] : 0}}">
        <input type="hidden" name="orders[]" value="{{!empty($orders[$key]) ? $orders[$key] : 0}}">

        @endforeach
    @endif

<div class="row mb-2">
 <div class="col">
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Bản xem trước</h5>
 </div>
<div class="col text-right"><button class="btn btn-danger">Xuất thống kê EXCEL</button></div>
</div>
</form>
<table class="table">
<tr>
    <th>Thời gian</th>
    <th>Doanh nhu</th>
    <th>Đơn hàng</th>
</tr>
@if(!empty($categories))
@foreach($categories as $keys => $categorie)

   <tr>
       <td>{{$categorie}}</td>
       <td>{{@$values[$keys]}} đ</td>
       <td>{{@$orders[$keys]}}</td>
   </tr>

@endforeach
@endif

</table>
