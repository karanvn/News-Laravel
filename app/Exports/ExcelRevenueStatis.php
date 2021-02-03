<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExcelRevenueStatis implements FromView{

    protected $id;
    protected $datas;

    function __construct($datas) {
        $this->datas = $datas;
    }

    public function view(): View
    {
        return view('Dashboard::exports.ExcelRevenueStatis',[
            'datas' => $this->datas
        ]);
    }
}