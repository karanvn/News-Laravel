<?php

namespace App\Modules\Api\Libraries;

class UserOut
{

    function __construct()
    {
        $this->statuses = get_api_statuses();
        $this->genders = get_api_genders();
        $this->order_statuses = get_order_statuses();
        $this->order_payments = get_order_payments();
    }

    public function users($users) {
        if(count($users) > 0){
            $result = [];
            foreach($users as $user){
                $avatar = url('') . '/' .show_image(config('auth_.image.customer_thumb_path'), $user->avatar);
                $result[] = $this->form_user($user);
            }

            return [
                'success' => true,
                'currentPage' => $users->currentPage(),
                'total' => $users->total(),
                'perPage' => $users->perPage(),
                'lastPage' => $users->lastPage(),
                'data' => $result
            ];
        }else{
            return [
                'success' => false,
                'msg' => trans('Api::api.user.msg.empty')
            ];
        }
    }


    public function user($user, $full = true) {
        if(!empty($user) && $user->user_type == 'C'){
            $result = $this->form_user($user);
            if($full){
                $shippings = $user->shippings()->where('status', 'A')->orderBy('position', 'asc')->get();
                if(count($shippings) > 0){
                    foreach($shippings as $shipping){
                        $result['shippings'][] = $this->form_shipping($shipping);
                    }
                }else{
                    $result['shippings'] = [];
                }

                $orders = $user->orders()->orderBy('created_at', 'desc')->get();
                if(count($orders) > 0){
                    foreach($orders as $order){
                        $result['orders'][] = $this->form_order($order);
                    }
                }else{
                    $result['orders'] = [];
                }
            }
            return [
                'success' => true,
                'data' => $result
            ];
        }else{
            return [
                'success' => false,
                'msg' => trans('Api::api.user.msg.empty')
            ];
        }
    }

    public function shipping($shipping) {
        if(!empty($shipping)){
            $result = $this->form_shipping($shipping);
            return [
                'success' => true,
                'data' => $result
            ];
        }else{
            return [
                'success' => false,
                'msg' => trans('Api::api.user.msg.empty')
            ];
        }
    }

    public function shippings($user) {
        if(!empty($user)){
            $shippings = $user->shippings()->where('status', 'A')->orderBy('position', 'asc')->get();
            if(count($shippings) > 0){
                $result = [];
                $statuses = get_api_statuses();
                foreach($shippings as $shipping){
                    $result[] = $this->form_shipping($shipping);
                }
                return [
                    'success' => true,
                    'data' => $result
                ];
            }else{
                return [
                    'success' => true,
                    'data' => []
                ];
            }
        }else{
            return [
                'success' => false,
                'msg' => trans('Api::api.user.msg.empty')
            ];
        }
    }

    public function orders($user) {
        if(!empty($user)){
            $orders = $user->orders()->orderBy('created_at', 'desc')->get();
            if(count($orders) > 0){
                $result = [];
                foreach($orders as $order){
                    $result[] = $this->form_order($order);
                }
                return [
                    'success' => true,
                    'data' => $result
                ];
            }else{
                return [
                    'success' => true,
                    'data' => []
                ];
            }
        }else{
            return [
                'success' => false,
                'msg' => trans('Api::api.user.msg.empty')
            ];
        }
    }

    public function form_user($user){
        $avatar = url('') . '/' .show_image(config('auth_.image.customer_thumb_path'), $user->avatar);
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'avatar' => $avatar,
            'status' => $user->status,
            'status_name' => @$this->statuses[$user->status],
            'gender' => @$this->genders[$user->gender],
            'bod' => date('d-m-Y', strtotime($user->bod))
        ];
    }

    public function form_shipping($shipping){
        $user = $shipping->user()->first();
        return [
            'id' => $shipping->id,
            'name' => $shipping->name,
            'user_id' => @$user->id,
            'user_name' => @$user->name,
            'phone' => $shipping->phone,
            'status' => $shipping->status,
            'status_name' => @$this->statuses[$shipping->status],
            'address' => $shipping->address,
            'state_id' => $shipping->state_id,
            'state_name' => @$shipping->state()->first()->name,
            'district_id' => $shipping->district_id,
            'district_name' => @$shipping->district()->first()->name,
            'ward_id' => $shipping->ward_id,
            'ward_name' => @$shipping->ward()->first()->name
        ];
    }

    public function form_order($order, $items = []){
        return [
            'order_id' => $order->order_id,
            'total' => $order->total,
            'subtotal' => $order->subtotal,
            'created_at' => date('d-m-Y H:i:s', strtotime($order->created_at)),
            'email' => $order->email,
            'user_id' => $order->user_id,
            'payment_id' => $order->payment_id,
            'payment_name' => @$this->order_payments[$order->payment_id],
            'status' => $order->status,
            'status_name' => @$this->order_statuses[$order->status],
            'notes' => $order->notes,
            'cs_notes' => $order->cs_notes,
            'items' => !empty($items) ? $items : $this->form_items($order->items()->orderBy('price', 'desc')->get()),
            'shipping' => [
                's_name' => $order->s_name,
                's_phone' => $order->s_phone,
                's_address' => $order->s_address,
                's_state' => $order->s_state,
                's_state_name' => @$order->state()->first()->name,
                's_district' => $order->s_district,
                's_district_name' => @$order->district()->first()->name,
                's_ward' => $order->s_ward,
                's_ward_name' => @$order->ward()->first()->name
            ]
        ];
    }

    public function form_item($item){
        $product = $item->product()->first();
        if (!empty($product->product_id)) {
            $avatar = $product->images()->orderBy('position', 'asc')->first();
            $image_path = config('product.image.product.thumb_path') . (!empty($product->parent_product_id) ? $product->parent_product_id : $product->product_id) . '/';
            return [
                'product_id' => $item->product_id,
                'avatar' => url('') .'/'. show_banner($image_path, @$avatar->image_path),
                'product_name' => @$product->name,
                'product_short_name' => @$product->short_name,
                'product_slug' => @$product->slug,
                'price' => $item->price,
                'amount' => $item->amount,
                'amount_success' => $item->amount_success
            ];
        }
        return [];
    }

    public function form_items($items){
        $result = [];
        if(count($items) > 0){
            foreach($items as $item){
                $result[] = $this->form_item($item);
            }
        }
        return $result;
    }
}
