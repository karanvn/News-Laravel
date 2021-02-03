<table border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #d2d2d2; margin: 20px auto; width: 450px; background: white !important">
    <tbody>
        <tr style="background: #f4f4f4;">
            <td style=" border-bottom: 1px solid #d2d2d2; color: #999; padding:10px; text-align:center;" width="5%"><font color="#333333" face="Tahoma">STT</font></td>
            <td style=" border-bottom: 1px solid #d2d2d2; color: #999; padding:10px;" width="25%"><font color="#35" face="Tahoma">Tên</font></td>
            <td style=" border-bottom: 1px solid #d2d2d2; color: #999; padding:10px; text-align:center;" width="10%"><font color="#333333" face="Tahoma">SL</font></td>
            <td style=" border-bottom: 1px solid #d2d2d2; color: #999; padding:10px; text-align:right;" width="20%"><font color="#333333" face="Tahoma">Giá</font></td>
            <td style=" border-bottom: 1px solid #d2d2d2; color: #999; padding:10px; text-align:right;" width="20%"><font color="#333333" face="Tahoma">Tổng</font></td>
        </tr>
     
        @php
            $items = $order->items()->get();
        @endphp
        @foreach($items as $index => $item)
        <tr>
            <td style=" border-bottom: 1px dotted #e2e2e2;  padding:10px; text-align:center;" width="5%"><font face="Tahoma">{{ $index + 1 }}</font></td>
            <td style=" border-bottom: 1px dotted #e2e2e2; padding:10px;" width="35%"><font face="Tahoma">{{ @$item->product()->first()->name }}</font></td>
            <td style=" border-bottom: 1px dotted #e2e2e2; padding:10px; text-align:center;" width="10%"><font face="Tahoma">{{ $item->amount }}</font></td>
            <td style=" border-bottom: 1px dotted #494545; padding:10px; text-align:right;" width="20%"><font face="Tahoma">{{ number_format($item->price) }} đ</font></td>
            <td style=" border-bottom: 1px dotted #e2e2e2; color: #000; padding:10px; font-weight: bold; text-align:right;" width="20%"><font color="#333333" face="Tahoma"><span style="font-weight: 400;">{{ number_format($item->amount * $item->price) }} đ</span></font></td>
        </tr>
        @endforeach
    </tbody>
</table>


<table border="0" cellpadding="0" cellspacing="0" style="width:80%;margin: 10px auto">
    <tbody>
        <tr>
            <td><font face="Tahoma">Tạm tính</font></td>
            <td style="color: #d71921; font-weight: bold; font-size:15px;"><font color="#333333" face="Tahoma"><span style="font-size: 13px; font-weight: 400;">{{ number_format($order->subtotal) }} đ</span></font></td>
        </tr>
        <tr>
            <td ><font face="Tahoma">Giãm giá mã khuyến mãi (nếu có)</font></td>
            <td><font face="Tahoma">{{!empty($order->discount) ?$order->discount : '0'}} đ</font></td>
        </tr>

        <tr>
            <td><font face="Tahoma">{{ trans('Order::order.add.form.discountmember') }}</font></td>
            <td><font face="Tahoma">{{ number_format($order->discountmember) }} đ</font></td>
        </tr>
        <tr>
            <td><font face="Tahoma">Phí ship</font></td>
            <td><font face="Tahoma">{{ number_format($order->shipping) }} đ</font></td>
        </tr>
        <tr>
            <td><font face="Tahoma">Tổng</font></td>
            <td><font face="Tahoma">{{ number_format($order->total) }} đ</font></td>
        </tr>
    </tbody>
</table>