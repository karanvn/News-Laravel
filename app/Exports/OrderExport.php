<?php

namespace App\Exports;

use App\Modules\Order\Models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OrderExport implements FromView{

    protected $id;
    protected $order;

    function __construct($order) {
        $this->order = $order;
    }

    public function view(): View
    {
        return view('home.exports.order_detail',[
            'orders' => $this->order,
        ]);
    }
}