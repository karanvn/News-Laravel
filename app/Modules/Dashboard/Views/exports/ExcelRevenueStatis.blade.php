
<table>
    <tr align="center">
        <td colspan="6">THỐNG KÊ DOANH THU</td>
    </tr>
    <tr>
        <td colspan="6">{{@$datas['dates']}}</td>
    </tr>
    <tr align="center">
        <td>Thời gian</td>
        <td>Doanh thu</td>
        <td>Đơn hàng</td>
    </tr>
    @php
        $orders = @$datas['orders'];
        $values = @$datas['values'];
        $categories = @$datas['categories'];
    @endphp
    @foreach($categories as $key => $categorie)
    <tr>
        <td>{{@$categorie}}</td>
        <td>{{@$values[$key]}} đ</td>
        <td>{{@$orders[$key]}}</td>
    </tr>
    @endforeach 
</table>