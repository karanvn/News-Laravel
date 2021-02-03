<?php

namespace App\Modules\Auth\Models;

use App\Modules\Order\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Order::all();
    }

    //Thêm hàng tiêu đề cho bảng
    public function headings() :array {
    	return ["STT", "Tên tài khoản", "Email", "Loại"];
    }
}
