<?php

namespace App\Modules\Dashboard\Models;

use App\Modules\Product\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Home extends Model
{
    public function __construct()
    {
        $this->product = new Product();
    }

    public function get_statistic_orders($params = []){
        if(!empty($params['start']) && !empty($params['end'])){
            if(!empty($params['status'])){
                $statistics = DB::select('
            select sum(total) as total, count(order_id) as number
            from orders
            where status ="'.$params['status'].'" 
            and created_at >= "'.$params['start'].'"
            and created_at <= "'. $params['end'].'"');
            }else{
                $statistics = DB::select('
            select sum(total) as total, count(order_id) as number
            from orders
            where created_at >= "'.$params['start'].'"
            and created_at <= "'. $params['end'].'"');
            }
            return !empty($statistics) ? $statistics[0] : false;
        }
        return false;
    }
    public function get_statistic_orders_list($params = []){
        if(!empty($params['start']) && !empty($params['end'])){
            if(!empty($params['status'])){
                $statistics = DB::select('
            select * 
            from orders
            where status ="'.$params['status'].'" 
            and created_at >= "'.$params['start'].'"
            and created_at <= "'. $params['end'].'"');
            }else{
                $statistics = DB::select('
            select *
            from orders
            where created_at >= "'.$params['start'].'"
            and created_at <= "'. $params['end'].'"');
            }
            return !empty($statistics) ? $statistics : false;
        }
        return false;
    }

    public function get_best_sells($params = []){
        if(!empty($params['start']) && !empty($params['end'])){
            $sells = DB::select('
            select d.product_id as product_id, sum(d.amount) as total
            from orders as o
            join order_items as d ON d.order_id = o.order_id
            where o.created_at >= ?
            and o.created_at <= ?
            group by d.product_id
            order by total desc
            limit 5', [$params['start'], $params['end']]);
            return !empty($sells) ? $sells : false;
        }
        return false;
    }

    public function get_tabs(){
        $tabs = [];
        $time_keys = get_time_keys();
        foreach($time_keys as $time){
            $params = get_times($time);
            $start = date('d-m', strtotime($params['start']));
            $end = date('d-m', strtotime($params['end']));
            $order = $this->get_statistic_orders($params);
            if($start == $end){
                $order->date = $start;
            }else{
                $order->date = $start . ' / ' . $end;
            }
            $tabs[] = $order;
        }
        return $tabs;
    }

    public function get_products($params){
        $products = [];
        //$params = get_times($time);
        $sells = $this->get_best_sells($params);
        if(!empty($sells)){
            foreach($sells as $sell){
                $product_id = $sell->product_id;
                $total = $sell->total;
                $product = $this->product->get_product($product_id);
                if($product){
                    $product->total = $total;
                    $products[] = $product;
                }
            }
        }
        return $products;
    }

}
