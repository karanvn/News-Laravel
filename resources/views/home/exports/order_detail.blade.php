
<table>
    <tr align="center">
        <td colspan="2">ĐƠN HÀNG  #{{$orders->order_id}}</td>
        <td colspan="3">Ngày đặt hàng: {{ date_format($orders->created_at,'d-m-Y') }}</td>
    </tr>
    <tr>
        <th>Mã ĐH</th>
        <td>{{ $orders->order_id }}</td> 
    </tr>
    <tr>
        <th>Số ĐT</th>
        <td>{{ $orders->s_phone }}</td> 
    </tr>
    <tr>
        <th>Tên KH</th>
        <td>{{ $orders->s_name }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $orders->email }}</td>
    </tr>
    <tr>
        <th>Địa chỉ</th>
        <td>{{ $orders->s_address }}</td>
        <td>{{ $orders->ward->name }},</td>
        <td>{{ $orders->district->name }}, </td>
        <td>{{ $orders->state->name }}.</td>
    </tr>
    <tr>
        <th>{{ trans('Order::order.list.filter.status') }}</th>
        <td>{{ trans('Order::order.statuses.'.$orders->status) }}</td>
    </tr>
    <tr>
        <th>{{ trans('Order::order.payments.title') }}</th>
        <td>{{$orders->payment_id == 1 ? 'COD' : 'ATM'}}</td>
    </tr>
</table>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>{{ trans('Order::order.list.filter.product') }} &amp; {{ trans('Order::order.list.filter.product_id') }}</th>
            <th class="text-right">{{ trans('Order::order.list.filter.sell_price') }}</th>
            <th class="text-right">{{ trans('Order::order.list.filter.qty') }}</th>
            <th class="text-right">{{ trans('Order::order.add.form.amount') }}</th>
        </tr>
    </thead>
    <tbody>
        @php $stt = 1; @endphp
        @foreach($orders->items as $item)
        <tr>
            <th scope="row">{{$stt++}}</th>
            <td>
                {{ $item->product->name }} - {{ $item->product->product_id }}
            </td>
            <td class="text-right">{{ number_format($item->price) }}₫</td>
            <td class="text-right">{{ $item->amount }}</td>
            <td class="text-right">{{ number_format($item->price*$item->amount) }}₫</td>
        </tr>
        @endforeach
    </tbody>
</table>

<table>
        <tr>
            <td>{{ trans('Order::order.add.form.lastotal') }}</td>
            <td class="text-right">{{ number_format($orders->subtotal) }}₫</td>
        </tr>
        <tr>
            <td>{{ trans('Order::order.add.form.discountcode') }}</td>
            <td class="text-right">(-){{ number_format(trim($orders->discount,'VND')?trim($orders->discount,'VND'):0) }}₫</td>
        </tr>
        <tr>
            <td>{{ trans('Order::order.add.form.discountmember') }}</td>
            <td class="text-right">(-){{ number_format(trim($orders->discountmember,'VND')?trim($orders->discountmember,'VND'):0) }}₫</td>
        </tr>
        <tr>
            <td>{{ trans('Order::order.add.form.shipping') }}</td>
            <td class="text-right">(+){{ number_format(trim($orders->shipping,'VND')?trim($orders->shipping,'VND'):0) }}₫</td>
        </tr>
        <tr>
            <td class="text-bold-800">Tổng tiền</td>
            <td class="text-bold-800 text-right"> {{ number_format($orders->total) }}₫</td>
        </tr>
</table>