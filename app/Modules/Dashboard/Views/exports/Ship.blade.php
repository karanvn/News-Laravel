
<table>
    <tr>
        <td>Id</td>
        <td>Phí Ship</td>
        <td>Ghi chú</td>
    </tr>
@php
$ids = @$datas['subId'];
$Names = @$datas['subName'];
@endphp
@foreach($datas as $key => $data)
        <tr>
            <td>{{@$ids[$key]}}</td>
            <td>{{ empty($data->shipping) ? 0 : $data->shipping }}</td>
            <td>{{@$Names[$key]}}</td>
        </tr>
@endforeach

</table>