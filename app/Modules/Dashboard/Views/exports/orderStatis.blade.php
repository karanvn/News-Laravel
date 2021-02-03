
<table>
    <tr align="center">
        <td colspan="6">THỐNG KÊ ĐƠN HÀNG</td>
    </tr>
    <tr>
        <td colspan="6">{{@$datas['dates']}}</td>
    </tr>
    <tr align="center">
        <td>Thời gian</td>
        <td>Thành công</td>
        <td>Thất bại</td>
        <td>Đang giao</td>
        <td>Đã xác nhận</td>
        <td>Mới đặt</td>
    </tr>
    @php
        $coms = @$datas['com'];
        $cans = @$datas['can'];
        $conf = @$datas['conf'];
        $ships = @$datas['ship'];
        $plns = @$datas['pln'];
        $categories = @$datas['categories'];
    @endphp
    @foreach($categories as $key => $categorie)
    <tr>
        <td>{{@$categorie}}</td>
        <td>{{@$coms[$key]}}</td>
        <td>{{@$cans[$key]}}</td>
        <td>{{@$ships[$key]}}</td>
        <td>{{@$conf[$key]}}</td>
        <td>{{@$plns[$key]}}</td>
    </tr>
    @endforeach
</table>