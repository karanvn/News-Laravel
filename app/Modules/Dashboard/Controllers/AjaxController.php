<?php


namespace App\Modules\Dashboard\Controllers;

use App\Http\Controllers\SiteController;
use App\Modules\Dashboard\Models\Home;
use App\Modules\Log\Libraries\LibActivityLog;
use App\Modules\Log\Models\ActivityLog;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Exports\OrderStatisExport;
use App\Exports\ExcelRevenueStatis;
use Maatwebsite\Excel\Facades\Excel;

use App\User;
use Illuminate\Http\Request;
use App\Modules\Order\Models\Order;
use App\Modules\Order\Models\OrderItem;

class AjaxController extends SiteController
{

    function __construct()
    {
        $this->home = new Home();
        $this->log = new ActivityLog();
        $this->order = new Order();
        $this->orderItem = new OrderItem();
    }

    function loadWizard($step, Request $request) {
        $inputs = $request->except(['_token']);
        $products = [];
        $categories = [];
        $values = [];
        $orders = [];
        $period = !empty($inputs['period']) ? $inputs['period'] : 0;
        $step = !empty($step) ? $step : 1;
        $tab = [];
        if(!empty($period)){
            $period_exp = explode('_', $period);
            $start = @$period_exp[1];
            $end = @$period_exp[2];
            $title = Str::upper($period_exp[0]);
        }else{
            $keys = get_time_keys();
            $key = @$keys[$step - 1];
            $filters = get_times($key, false);
            $start = @$filters['start'];
            $end = @$filters['end'];
            $title = "";
        }
        $days = get_days(@$start, $end);
        $dates = get_dates($start, $end, '+1 day', 'Y-m-d');
        $params = [];
        if(!empty($dates)){
            if(count($dates) == 1){
                $date = $dates[0];
                $days = 12;
                for($i = 0; $i < 24; $i+= 2){
                    $categories[] = $i.'H~'.($i + 2).'H';
                    $order = @$this->home->get_statistic_orders([
                        'start' => $date . ' ' . fm_zeros($i, 2) . ':00:01',
                        'end' => $date . ' ' . fm_zeros($i + 1, 2) . ':59:59'
                    ]);
                    $import_price = 0;
                    if(!empty($order)){
                        $listOrders = @$this->home->get_statistic_orders_list([
                            'start' => $date . ' ' . fm_zeros($i, 2) . ':00:01',
                            'end' => $date . ' ' . fm_zeros($i + 1, 2) . ':59:59'
                        ]);
                       if(!empty($listOrders)){
                        foreach($listOrders as $listOrder){
                            $item_orders = $this->orderItem->getItems(['order_id' => $listOrder->order_id]);
                            foreach(@$item_orders as $item_order){
                                if(!empty($item_order)){
                                    $proImp = $item_order->product;
                                    if(!empty($proImp)){
                                        $import_price = $import_price + (int)$proImp->import_price * (int)$item_order->amount;
                                    }
                                }
                            }
                        }
                       }
                    }

                    $values[] = !empty($order) ? (int)$order->total : 0;
                    $profit[] = !empty($order) ? (int)$order->total - (int)$import_price : 0;
                    $orders[] = !empty($order) ? (int)$order->number : 0;
                }
                $products = $this->home->get_products([
                    'start' => $date.' 00:00:01',
                    'end' => $date.' 23:59:59',
                ]);

            }else{
                foreach($dates as $date){
                    $categories[] = date('d-m-Y', strtotime($date));
                    $params = [
                        'start' => $date.' 00:00:01',
                        'end' => $date.' 23:59:59'
                    ];
                    $order = @$this->home->get_statistic_orders($params);

                    $import_price = 0;
                    if(!empty($order)){
                        $listOrders = @$this->home->get_statistic_orders_list($params);
                        if(!empty($listOrders)){
                            foreach($listOrders as $listOrder){
                                $item_orders = $this->orderItem->getItems(['order_id' => $listOrder->order_id]);
                                foreach(@$item_orders as $item_order){
                                    if(!empty($item_order)){
                                        $proImp = $item_order->product;
                                        if(!empty($proImp)){
                                            $import_price = (int)$import_price + (int)$proImp->import_price * (int)$item_order->amount;
                                        }
                                    }
                                }
                            }
                           }
                    }

                    $values[] = !empty($order) ? (int)$order->total : 0;
                    $profit[] = !empty($order) ? (int)$order->total - (int)$import_price : 0;
                    $orders[] = !empty($order) ? (int)$order->number : 0;
                }
                $last = count($dates) - 1;
                $products = $this->home->get_products([
                    'start' => $dates[0]. ' 00:00:01',
                    'end' => $dates[$last]. ' 23:59:59'
                ]);
            }

            if($step == 4){
                $params = [
                    'start' => $start.' 00:00:01',
                    'end' => $end.' 23:59:59'
                ];
                $order = @$this->home->get_statistic_orders($params);
                $products = $this->home->get_products($params);
                $tab = [
                    'title' => $title . ' : ' . ($start == $end ? date('d-m', strtotime($start)) : ( date('d-m', strtotime($start)) . ' / ' . date('d-m', strtotime($end)) )),
                    'number' => !empty($order) ? (int)$order->number : 0,
                    'total' => !empty($order) ? number_format($order->total).' đ' : 0
                ];
            }
        }

        $bar = count($dates) <= 31 ? [false, 400] : [false,400];
        $html = view('Dashboard::dashboard.wizard_content', [
                    'step' => $step,
                    'products' => $products,
                    'categories' => $categories,
                    'values' => $values,
                    'orders' => $orders,
                    'dates' => $dates
                    ])->render();
        return response()->json([
            'success' => true,
            'products' => $products,
            'categories' => $categories,
            'values' => $values,
            'profit' => @$profit,
            'orders' => $orders,
            'step' => $step,
            'bar' => $bar,
            'params' => $params,
            'width_bar' => $days > 31 ? $days * 2 : $days * 4,
            'width' => $days > 31 ? $days : $days * 2,
            'html' => $html,
            'tab' => $tab
        ]);
    }

    function loadLog(Request $request)
    {
        $inputs = $request->except(['_token']);
        $page = !empty($inputs['page']) ? (int)$inputs['page'] : 1;
        $lastPage = 1;
        if($page >= 1){
            $logs = $this->log->get_logs(['type' => @$_GET['type'],'limit' => 10, 'orderBy' => ['id', 'desc']]);
            if(@$_GET['type']=="ORDER"){
                $html = view('Dashboard::dashboardorder.log', [
                    'logs' => $logs ,
                    'lib' => new LibActivityLog(),
                    'startPage' => $logs->firstItem()
                ])->render();
            }else{
                $html = view('Dashboard::dashboard.log', [
                    'logs' => $logs ,
                    'lib' => new LibActivityLog(),
                    'startPage' => $logs->firstItem()
                ])->render();
            }

            $msgPage = $logs->firstItem() . ' - ';
            if($logs->lastPage()){
                $msgPage .= $logs->lastItem();
            }else{
                $msgPage .= $logs->firstItem() + $logs->perPage() - 1;
            }
            $msgPage .= ' / '.$logs->total();
            $lastPage = $logs->lastPage();
            return response()->json([
                'success' => true,
                'lastPage' => $lastPage,
                'msgPage' => $msgPage,
                'html' => $html
            ]);
        }

        return response()->json([
            'success' => false,
            'html' => trans('Dashboard.dashboard.log.no_data')
        ]);

    }

    
    function dashboardorderWizad($step, Request $request) {
        $inputs = $request->except(['_token']);
        $categories = [];
        $values = [];
        $orders = [];
        $period = !empty($inputs['period']) ? $inputs['period'] : 0;
        $step = !empty($step) ? $step : 1;
        $tab = [];
        if(!empty($period)){
            $period_exp = explode('_', $period);
            $start = @$period_exp[1];
            $end = @$period_exp[2];
            $title = Str::upper($period_exp[0]);
        }else{
            $keys = get_time_keys();
            $key = @$keys[$step - 1];
            $filters = get_times($key, false);
            $start = @$filters['start'];
            $end = @$filters['end'];
            $title = "";
        }
        $days = get_days(@$start, $end);
        $dates = get_dates($start, $end, '+1 day', 'Y-m-d');
        $params = [];
        if(!empty($dates)){
            if(count($dates) == 1){
                $date = $dates[0];
                $days = 12;
                for($i = 0; $i < 24; $i+= 2){
                    $categories[] = $i.'H~'.($i + 2).'H';
                    $order = @$this->home->get_statistic_orders([
                        'start' => $date . ' ' . fm_zeros($i, 2) . ':00:01',
                        'end' => $date . ' ' . fm_zeros($i + 1, 2) . ':59:59',
                        'status'   => 'COM'
                    ]);
                    $values[] = !empty($order) ? (int)$order->number : 0;

                    $orderFalse = @$this->home->get_statistic_orders([
                        'start' => $date . ' ' . fm_zeros($i, 2) . ':00:01',
                        'end' => $date . ' ' . fm_zeros($i + 1, 2) . ':59:59',
                        'status'   => 'CAN'
                    ]);
                    $valuesFalse[] = !empty($orderFalse) ? (int)$orderFalse->number : 0;

                    $orderCONF = @$this->home->get_statistic_orders([
                        'start' => $date . ' ' . fm_zeros($i, 2) . ':00:01',
                        'end' => $date . ' ' . fm_zeros($i + 1, 2) . ':59:59',
                        'status'   => 'CONF'
                    ]);
                    $valuesCONF[] = !empty($orderCONF) ? (int)$orderCONF->number : 0;

                    $orderSHIP = @$this->home->get_statistic_orders([
                        'start' => $date . ' ' . fm_zeros($i, 2) . ':00:01',
                        'end' => $date . ' ' . fm_zeros($i + 1, 2) . ':59:59',
                        'status'   => 'SHIP'
                    ]);
                    $valuesSHIP[] = !empty($orderSHIP) ? (int)$orderSHIP->number : 0;

                    $orderPLN = @$this->home->get_statistic_orders([
                        'start' => $date . ' ' . fm_zeros($i, 2) . ':00:01',
                        'end' => $date . ' ' . fm_zeros($i + 1, 2) . ':59:59',
                        'status'   => 'PLN'
                    ]);
                    $valuesPLN[] = !empty($orderPLN) ? (int)$orderPLN->number : 0;

                }
              

            }else{
                foreach($dates as $date){
                    $categories[] = date('d-m-Y', strtotime($date));
                    $params = [
                        'start' => $date.' 00:00:01',
                        'end' => $date.' 23:59:59',
                        'status'   => 'COM'
                    ];
                    $order = @$this->home->get_statistic_orders($params);
                    $values[] = !empty($order) ? (int)$order->number : 0;

                    $paramsFalse = [
                        'start' => $date.' 00:00:01',
                        'end' => $date.' 23:59:59',
                        'status'   => 'CAN'
                    ];
                    $orderFalse = @$this->home->get_statistic_orders($paramsFalse);
                    $valuesFalse[] = !empty($orderFalse) ? (int)$orderFalse->number : 0;

                    $paramsCONF = [
                        'start' => $date.' 00:00:01',
                        'end' => $date.' 23:59:59',
                        'status'   => 'CONF'
                    ];
                    $orderCONF = @$this->home->get_statistic_orders($paramsCONF);
                    $valuesCONF[] = !empty($orderCONF) ? (int)$orderCONF->number : 0;

                    $paramsSHIP = [
                        'start' => $date.' 00:00:01',
                        'end' => $date.' 23:59:59',
                        'status'   => 'SHIP'
                    ];
                    $orderSHIP = @$this->home->get_statistic_orders($paramsSHIP);
                    $valuesSHIP[] = !empty($orderSHIP) ? (int)$orderSHIP->number : 0;

                    $paramsPLN = [
                        'start' => $date.' 00:00:01',
                        'end' => $date.' 23:59:59',
                        'status'   => 'PLN'
                    ];
                    $orderPLN = @$this->home->get_statistic_orders($paramsPLN);
                    $valuesPLN[] = !empty($orderPLN) ? (int)$orderPLN->number : 0;

                   
                }
                $last = count($dates) - 1;
             
            }

            if($step == 4){
                $params = [
                    'start' => $start.' 00:00:01',
                    'end' => $end.' 23:59:59'
                ];
                $order = @$this->home->get_statistic_orders($params);
                $tab = [
                    'title' => $title . ' : ' . ($start == $end ? date('d-m', strtotime($start)) : ( date('d-m', strtotime($start)) . ' / ' . date('d-m', strtotime($end)) )),
                    'number' => !empty($order) ? (int)$order->number : 0,
                    'total' => !empty($order) ? number_format($order->total).' đ' : 0
                ];
            }
        }

        $bar = count($dates) <= 31 ? [false, 400] : [false,400];
        $html = view('Dashboard::dashboardorder.wizard_content', [
        'step' => $step,
        'values' => $values,
        'valuesFalse' => $valuesFalse,
        'valuesCONF' => $valuesCONF,
        'valuesSHIP' => $valuesSHIP,
        'valuesPLN' => $valuesPLN,
        'categories' => $categories,
        'dates' => $dates
        ])->render();
        return response()->json([
            'success' => true,
            'categories' => $categories,
            'values' => $values,
            'valuesFalse' => $valuesFalse,
            'valuesCONF' => $valuesCONF,
            'valuesSHIP' => $valuesSHIP,
            'valuesPLN' => $valuesPLN,
            'orders' => $orders,
            'step' => $step,
            'bar' => $bar,
            'params' => $params,
            'width_bar' => $days > 31 ? $days * 2 : $days * 4,
            'width' => $days > 31 ? $days : $days * 2,
            'html' => $html,
            'tab' => $tab
        ]);
    }



    function excelOrderStatis(Request $request)
    {
        $fileName = 'ExOrder.xlsx'; 
       
        $datas = $request->all();
        ob_end_clean(); 
        ob_start();
        return Excel::download(new OrderStatisExport($datas), $fileName);
    }
    function excelRevenueStatis(Request $request)
    {
        // dd($request->all());
        $fileName = 'excelRevenueStatis.xlsx'; 
       
        $datas = $request->all();
        ob_end_clean(); 
        ob_start();
        return Excel::download(new ExcelRevenueStatis($datas), $fileName);
    }
    function PreviewExcelModule(Request $request){
        // dd($request->all());
        $inputs = $request->except(['_token']);
        if(empty($request->typedate)){
            $published_start = strtotime($inputs['time_start']);
            $published_end = strtotime($inputs['time_end']);
            if($published_start > $published_end){
                $conditions['time_start'] = 'required';
                $messages['time_start.required'] = 'Ngày bắt đầu phải nhỏ hơn ngày kết thúc';
                $inputs['time_start'] = '';

                $validator = Validator::make($inputs,
                $conditions,
                $messages
                );
    
                $passes = $validator->passes();
                $errors = $validator->errors();
                return response()->json([
                    'success' => $passes,
                    'errors' => $errors,
                    'toastr' => 'Lỗi ngày tháng',
                     'html' => '',
                ]);

            }
        }


        //  thực hiện
        if(!empty($request->typedate)){
           if($request->typedate == 'TODAY'){
               $start = date("d-m-Y");
               $end = date("d-m-Y");
           }
           if($request->typedate == 'THISWEEK'){
            $start = date( 'd-m-Y', strtotime( 'monday this week' ) );
            $end = date( 'd-m-Y', strtotime( 'sunday this week' ) );
            }
            if($request->typedate == 'THISMONTH'){
                $start = date( 'd-m-Y', strtotime( 'first day of this month' ) );
                $end = date( 'd-m-Y', strtotime( 'last day of this month' ) );
            }
            if($request->typedate == 'THISYEAR'){
                $start = date( 'd-m-Y', strtotime( 'first day of january this year' ) );
                $end = date( 'd-m-Y', strtotime( 'last day of december this year' ) );
            }
        }else{
            // ngày cụ thể
            $start = $request->time_start;
            $end = $request->time_end;
        }
       

        // bắt đầu
        if($request->type=='other'){
            $days = get_days(@$start, $end);
        $dates = get_dates($start, $end, '+1 day', 'Y-m-d');
        $params = [];
        if(!empty($dates)){
            if(count($dates) == 1){
                $date = $dates[0];
                $days = 12;
                for($i = 0; $i < 24; $i+= 2){
                    $categories[] = $i.'H~'.($i + 2).'H';
                    $order = @$this->home->get_statistic_orders([
                        'start' => $date . ' ' . fm_zeros($i, 2) . ':00:01',
                        'end' => $date . ' ' . fm_zeros($i + 1, 2) . ':59:59'
                    ]);
                    $values[] = !empty($order) ? (int)$order->total : 0;
                    $orders[] = !empty($order) ? (int)$order->number : 0;
                }
                $products = $this->home->get_products([
                    'start' => $date.' 00:00:01',
                    'end' => $date.' 23:59:59',
                ]);

            }else{
                foreach($dates as $date){
                    $categories[] = date('d-m-Y', strtotime($date));
                    $params = [
                        'start' => $date.' 00:00:01',
                        'end' => $date.' 23:59:59'
                    ];
                    $order = @$this->home->get_statistic_orders($params);
                    $values[] = !empty($order) ? (int)$order->total : 0;
                    $orders[] = !empty($order) ? (int)$order->number : 0;
                }
                $last = count($dates) - 1;
                $products = $this->home->get_products([
                    'start' => $dates[0]. ' 00:00:01',
                    'end' => $dates[$last]. ' 23:59:59'
                ]);
            }

           
        }
        $html = view('Dashboard::excel.order_demo', [
                    'products' => $products,
                    'categories' => $categories,
                    'values' => $values,
                    'orders' => $orders,
                    'dates' => $dates
                    ])->render();
        }
        if($request->type=='order'){
            $days = get_days(@$start, $end);
            $dates = get_dates($start, $end, '+1 day', 'Y-m-d');
            $params = [];
            if(!empty($dates)){
                if(count($dates) == 1){
                    $date = $dates[0];
                    $days = 12;
                    for($i = 0; $i < 24; $i+= 2){
                        $categories[] = $i.'H~'.($i + 2).'H';
                        $order = @$this->home->get_statistic_orders([
                            'start' => $date . ' ' . fm_zeros($i, 2) . ':00:01',
                            'end' => $date . ' ' . fm_zeros($i + 1, 2) . ':59:59',
                            'status'   => 'COM'
                        ]);
                        $values[] = !empty($order) ? (int)$order->number : 0;
    
                        $orderFalse = @$this->home->get_statistic_orders([
                            'start' => $date . ' ' . fm_zeros($i, 2) . ':00:01',
                            'end' => $date . ' ' . fm_zeros($i + 1, 2) . ':59:59',
                            'status'   => 'CAN'
                        ]);
                        $valuesFalse[] = !empty($orderFalse) ? (int)$orderFalse->number : 0;
    
                        $orderCONF = @$this->home->get_statistic_orders([
                            'start' => $date . ' ' . fm_zeros($i, 2) . ':00:01',
                            'end' => $date . ' ' . fm_zeros($i + 1, 2) . ':59:59',
                            'status'   => 'CONF'
                        ]);
                        $valuesCONF[] = !empty($orderCONF) ? (int)$orderCONF->number : 0;
    
                        $orderSHIP = @$this->home->get_statistic_orders([
                            'start' => $date . ' ' . fm_zeros($i, 2) . ':00:01',
                            'end' => $date . ' ' . fm_zeros($i + 1, 2) . ':59:59',
                            'status'   => 'SHIP'
                        ]);
                        $valuesSHIP[] = !empty($orderSHIP) ? (int)$orderSHIP->number : 0;
    
                        $orderPLN = @$this->home->get_statistic_orders([
                            'start' => $date . ' ' . fm_zeros($i, 2) . ':00:01',
                            'end' => $date . ' ' . fm_zeros($i + 1, 2) . ':59:59',
                            'status'   => 'PLN'
                        ]);
                        $valuesPLN[] = !empty($orderPLN) ? (int)$orderPLN->number : 0;
    
                    }
                  
    
                }else{
                    foreach($dates as $date){
                        $categories[] = date('d-m-Y', strtotime($date));
                        $params = [
                            'start' => $date.' 00:00:01',
                            'end' => $date.' 23:59:59',
                            'status'   => 'COM'
                        ];
                        $order = @$this->home->get_statistic_orders($params);
                        $values[] = !empty($order) ? (int)$order->number : 0;
    
                        $paramsFalse = [
                            'start' => $date.' 00:00:01',
                            'end' => $date.' 23:59:59',
                            'status'   => 'CAN'
                        ];
                        $orderFalse = @$this->home->get_statistic_orders($paramsFalse);
                        $valuesFalse[] = !empty($orderFalse) ? (int)$orderFalse->number : 0;
    
                        $paramsCONF = [
                            'start' => $date.' 00:00:01',
                            'end' => $date.' 23:59:59',
                            'status'   => 'CONF'
                        ];
                        $orderCONF = @$this->home->get_statistic_orders($paramsCONF);
                        $valuesCONF[] = !empty($orderCONF) ? (int)$orderCONF->number : 0;
    
                        $paramsSHIP = [
                            'start' => $date.' 00:00:01',
                            'end' => $date.' 23:59:59',
                            'status'   => 'SHIP'
                        ];
                        $orderSHIP = @$this->home->get_statistic_orders($paramsSHIP);
                        $valuesSHIP[] = !empty($orderSHIP) ? (int)$orderSHIP->number : 0;
    
                        $paramsPLN = [
                            'start' => $date.' 00:00:01',
                            'end' => $date.' 23:59:59',
                            'status'   => 'PLN'
                        ];
                        $orderPLN = @$this->home->get_statistic_orders($paramsPLN);
                        $valuesPLN[] = !empty($orderPLN) ? (int)$orderPLN->number : 0;
                       
                    }
                    $last = count($dates) - 1;
                 
                }
    
            }
    
            $html = view('Dashboard::excel.orders_demo', [
            'values' => $values,
            'valuesFalse' => $valuesFalse,
            'valuesCONF' => $valuesCONF,
            'valuesSHIP' => $valuesSHIP,
            'valuesPLN' => $valuesPLN,
            'categories' => $categories,
            'dates' => $dates
            ])->render();

        }

        // end orrder
        return response()->json([
            'success' => true,
            'html' => $html,
            'toastr' => 'Truy xuất thành công'
        ]);
    }



  
}
