<?php


namespace App\Modules\Api\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;

use App\Modules\Api\Libraries\UserOut;
use App\Modules\Auth\Models\Shipping;
use App\Modules\Location\Models\District;
use App\Modules\Location\Models\State;
use App\Modules\Location\Models\Ward;
use App\Modules\Order\Models\Order;
use App\Modules\Order\Models\OrderItem;
use App\Modules\Product\Models\Product;

class UserController extends Controller
{

    function __construct()
    {
        $this->user = new User();
        $this->product = new Product();
        $this->shipping = new Shipping();
        $this->lib = new UserOut();
        $this->state = new State();
        $this->district = new District();
        $this->ward = new Ward();
        $this->order = new Order();
    }

    /*function login(Request $request) {
        $credentials = $request->except(['_token']);
        $remember = @$credentials['remember'];
        $auth = Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'status' => 'A',
            'user_type' => 'A'
        ], !empty($remember) ? true : false);
        if ($auth) {

            $user = $this->user->get_email_user($credentials['email']);
            $user->last_login = date("Y-m-d H:i:s", time());
            $user->ip = get_client_ip();
            $user->save();

            return redirect()->intended('/');
        }else{
            return redirect()->back()->with('message', trans('Auth::auth.login.msg_login_fail'));
        }
    }*/

    function users(Request $request) {
        $inputs = $request->except(['_token']);

        $filters = [
            'name' => @$inputs['name'],
            'email' => @$inputs['email'],
        ];

        $params = array_merge($filters, ['limit' => 3, 'orderBy' => ['id', 'desc']]);
        $params['email'] = $filters['email'].'%';
        $params['user_type'] = 'C';
        $params['status'] = 'A';

        $users = $this->user->get_users($params);
        return response()->json($this->lib->users($users));
    }

    function user($id){
        $user = $this->user->get_user($id);
        return response()->json($this->lib->user($user, true));
    }

    function addUser(Request $request, $id = 0){
        $inputs = $request->except(['_token']);
        $params = @$inputs['params'];
        $user_id = $id;
        $flag = !empty($params) ? true : false;
        if($flag)
            $inputs = @json_decode($params, true);

        $inputs = !empty($inputs) ? $inputs : [];

        $prefix_errors_trans = 'Auth::customer.add.form.errors.';

        if(empty($user_id)){
            $conditions = [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                're_password' => 'required|same:password'
            ];
            $messages = [
                'name.required'  => trans($prefix_errors_trans . 'name') ,
                'email.required' => trans($prefix_errors_trans . 'email'),
                'email.email' => trans($prefix_errors_trans . 'email_format'),
                'email.unique' => trans($prefix_errors_trans . 'email_exists'),
                'password.required'        => trans($prefix_errors_trans . 'password'),
                're_password.required'        => trans($prefix_errors_trans . 're_password'),
                're_password.same'             => trans($prefix_errors_trans . 're_password_same'),
                'password.min'             => trans($prefix_errors_trans . 'password_min')
            ];
        }else{
            $conditions = [
                'name' => 'required'
            ];

            $messages = [
                'name.required'  => trans($prefix_errors_trans . 'name')
            ];
        }

        $validator = Validator::make($inputs,
            $conditions,
            $messages
        );

        $success = $validator->passes();

        if($success){
            $user = !empty($user_id) ? $this->user->get_user($user_id) : $this->user;
            if(!empty($user_id) && empty($user)){
                return response()->json([
                    'success' => false,
                    'msg' => trans('Api::api.user.msg.empty')
                ]);
            }else{
                $permit_keys = [
                    'name', 'phone', 'password', 'gender', 'bod'
                ];

                if(empty($user_id))
                    $permit_keys[] = 'email';

                foreach($inputs as $key => $val){
                    if(in_array($key, $permit_keys))
                        $user->$key = $key != 'password' ? $val : Hash::make($val);
                }

                $user->user_type = 'C';
                $user->status = 'A';

                if($flag){
                    $user->id = !empty($user_id) ? $user_id : rand(100000000, 900000000);
                }else{
                    $user->save();
                    if(empty($user_id)){
                        $user->user_id = $user->id;
                        $user->save();
                    }
                }

                return response()->json($this->lib->user($user, false));
            }

        }else{
            $errors = $validator->errors();
            $msgs = [];
            foreach($errors->getMessages() as $key => $message){
                $msgs[$key] = @$message[0];
            }
            return response()->json([
                'success' => $success,
                'msg' => $msgs
            ]);
        }
    }


    function addShipping(Request $request, $id = 0){
        $inputs = $request->except(['_token']);
        $params = @$inputs['params'];
        $shipping_id = $id;
        $flag = !empty($params) ? true : false;
        if($flag)
            $inputs = @json_decode($params, true);

        $inputs = !empty($inputs) ? $inputs : [];
        $user_id = @$inputs['user_id'];
        $prefix_errors_trans = 'Auth::customer.add.form.errors.';
        $shipping = $this->shipping;
        if(!empty($shipping_id)){
            $shipping = $this->shipping->get_shipping($shipping_id);
            if(empty($shipping)){
                return response()->json([
                    'success' => false,
                    'msg' => trans($prefix_errors_trans . 'shipping_not_found')
                ]);
            }elseif($shipping->user_id != $user_id){
                return response()->json([
                    'success' => false,
                    'msg' => trans($prefix_errors_trans . 'user_not_found')
                ]);
            }
        }

        $conditions = [
            'user_id' => 'required|exists:users,id',
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'state_id' => 'required|exists:states,state_id|numeric|gt:0',
            'district_id' => 'required|exists:districts,district_id|numeric|gt:0',
            'ward_id' => 'required|exists:wards,ward_id|numeric|gt:0'
        ];

        $messages = [
            'user_id.required'  => trans($prefix_errors_trans . 'user_id') ,
            'user_id.exists'  => trans($prefix_errors_trans . 'user_id_exists'),
            'name.required'  => trans($prefix_errors_trans . 'name') ,
            'phone.required' => trans($prefix_errors_trans . 'phone'),
            'address.required'        => trans($prefix_errors_trans . 'address'),
            'state_id.required'    => trans($prefix_errors_trans . 'state_id'),
            'state_id.gt'  => trans($prefix_errors_trans . 'state_id'),
            'state_id.exists'  => trans($prefix_errors_trans . 'state_id_exists'),
            'district_id.required'    => trans($prefix_errors_trans . 'district_id'),
            'district_id.gt'  => trans($prefix_errors_trans . 'district_id'),
            'district_id.exists'  => trans($prefix_errors_trans . 'district_id_exists'),
            'ward_id.required'    => trans($prefix_errors_trans . 'ward_id'),
            'ward_id.gt'  => trans($prefix_errors_trans . 'ward_id'),
            'ward_id.exists'  => trans($prefix_errors_trans . 'ward_id_exists'),
        ];

        $validator = Validator::make($inputs,
            $conditions,
            $messages
        );

        $success = $validator->passes();

        $permit_keys = [
            'user_id', 'name', 'phone', 'address', 'state_id', 'district_id', 'ward_id'
        ];

        if($success){
            $state_id = @$inputs['state_id'];
            $district_id = @$inputs['district_id'];
            $ward_id = @$inputs['ward_id'];
            $msgs = [];
            $district = $this->district->get_district($district_id);
            if(@$district->state_id != $state_id){
                $msgs['district_id'] = trans($prefix_errors_trans . 'district_id_not_match');
            }else{
                $ward = $this->ward->get_ward($ward_id);
                if(@$ward->district_id != $district_id){
                    $msgs['ward_id'] = trans($prefix_errors_trans . 'ward_id_not_match');
                }
            }

            if(empty($msgs)){
                foreach($inputs as $key => $val){
                    if(in_array($key, $permit_keys))
                        $shipping->$key = $val;
                }

                $shipping->status = 'A';

                if($flag){
                    $shipping->id = !empty($shipping_id) ? $shipping_id : rand(100000000, 900000000);
                }else{
                    $shipping->save();
                }

                return response()->json($this->lib->shipping($shipping));
            }else{
                return response()->json([
                    'success' => false,
                    'msg' => $msgs
                ]);
            }

        }else{
            $errors = $validator->errors();
            $msgs = [];
            foreach($errors->getMessages() as $key => $message){
                $msgs[$key] = @$message[0];
            }
            return response()->json([
                'success' => $success,
                'msg' => $msgs
            ]);
        }
    }


    function addOrder(Request $request){
        $inputs = $request->except(['_token']);
        $prefix_errors_trans = 'Order::order.add.form.errors.';
        $prefix_success_trans = 'Order::order.add.form.success.';
        $params = @$inputs['params'];
        $flag = !empty($params) ? true : false;
        if($flag)
            $inputs = @json_decode($params, true);

        $inputs = !empty($inputs) ? $inputs : [];
        $user_id = @$inputs['user_id'];
        $name = @$inputs['name'];
        $email = @$inputs['email'];
        $shipping = @$inputs['shipping'];
        $products = @$inputs['products'];
        $msgs = [];
        $createCustomer = false;
        $requests = [];
        if(!empty($shipping)){
            $requests = array_merge(['name' => $name, 'email' => $email], $shipping);
        }

        $conditions = [
            'name' => 'required',
            'email' => 'required|email',
            's_phone' => 'required',
            's_address' => 'required',
            's_state' => 'required|exists:states,state_id|numeric|gt:0',
            's_district' => 'required|exists:districts,district_id|numeric|gt:0',
            's_ward' => 'required|exists:wards,ward_id|numeric|gt:0'
        ];

        $messages = [
            'name.required'  => trans($prefix_errors_trans . 'name') ,
            'email.required'  => trans($prefix_errors_trans . 'email') ,
            'email.email'    => trans($prefix_errors_trans . 'email_format'),
            's_phone.required'        => trans($prefix_errors_trans . 's_phone'),
            's_address.required'        => trans($prefix_errors_trans . 's_address'),
            's_state.required'    => trans($prefix_errors_trans . 's_state'),
            's_state.gt'  => trans($prefix_errors_trans . 's_state'),
            's_state.exists'  => trans($prefix_errors_trans . 's_state_exists'),
            's_district.required'    => trans($prefix_errors_trans . 's_district'),
            's_district.gt'  => trans($prefix_errors_trans . 's_district'),
            's_district.exists'  => trans($prefix_errors_trans . 's_district_exists'),
            's_ward.required'    => trans($prefix_errors_trans . 's_ward'),
            's_ward.gt'  => trans($prefix_errors_trans . 's_ward'),
            's_ward.exists'  => trans($prefix_errors_trans . 's_ward_exists'),
        ];


        $email_error = 0;
        $email_msg = "";
        if(!empty($user_id)){
            $user = $this->user->get_user($user_id);
            if(empty($user) || @$user->user_type == 'A' || @$user->status !='A'){
                $email_error++;
                $email_msg = trans($prefix_errors_trans . 'user_not_found');
            }
        }

        $email_user = $this->user->get_email_user($email);
        if(empty($email_user)){
            if(empty($user_id)){
                $createCustomer = true;
            }else{
                $email_error++;
                $email_msg = trans($prefix_errors_trans . 'email_not_exist');
            }
        }else{
            if($email_user->user_type == 'A'){
                $email_error++;
                $email_msg = trans($prefix_errors_trans . 'user_email');
            }else{
                if(empty($user_id)){
                    $email_error++;
                    $email_msg = trans($prefix_errors_trans . 'email_login_exist');
                }elseif($email_user->id != $user_id){
                    $email_error++;
                    $email_msg = trans($prefix_errors_trans . 'user_email');
                }
            }
        }

        if($email_error > 0){
            $conditions['email'] = 'required';
            $messages['email.required'] = $email_msg;
            $requests['email'] = "";
        }

        $product_error = 0;
        $product_msg = "";

        if(empty($products) ||!is_array($products)){
            $product_msg = trans($prefix_errors_trans . 'product_id');
        }else{
            foreach($products as $prd){
                $amount = (int)@$prd['amount'];
                $product_id = $prd['product_id'];
                if($amount <= 0){
                    $product_msg = trans($prefix_errors_trans . 'amount');
                    $product_error++;
                }
                if(empty($product_id)){
                    $product_msg = trans($prefix_errors_trans . 'product_id');
                    $product_error++;
                }else{
                    $product = $this->product->get_product($product_id);
                    if(empty($product) || @$product->status != 'A' || @$product->has_child == 'Y'){
                        $product_msg = trans($prefix_errors_trans . 'product_not_found');
                        $product_error++;
                    }elseif(@$product->qty < $amount){
                        $product_msg = trans($prefix_errors_trans . 'product_qty') . ': ' . @$product->qty;
                        $product_error++;
                    }
                }
            }
        }

        if($product_error > 0){
            $conditions['product_id'] = 'required';
            $messages['product_id.required'] = $product_msg;
            $requests['product_id'] = "";
        }

        $validator = Validator::make($requests,
            $conditions,
            $messages
        );

        $passes = $validator->passes();

        if($passes){

            $customer = new User();
            if($createCustomer){
                $customer->name = $name;
                $customer->email = $email;
                $customer->phone = @$shipping['s_phone'];
                $customer->password = Hash::make(Str::random(10));
                $customer->user_id = 1;
                $customer->user_type = 'C';
                $customer->status = 'A';
                if($flag){
                    $customer->id = rand(100000000, 900000000);
                }else{
                    $customer->save();

                    $ship = new Shipping();
                    $ship->user_id = $customer->id;
                    $ship->name = $name;
                    $ship->phone = @$shipping['s_phone'];
                    $ship->address = @$shipping['s_address'];
                    $ship->state_id = @$shipping['s_state'];
                    $ship->district_id = @$shipping['s_district'];
                    $ship->ward_id = @$shipping['s_ward'];
                    $ship->status = 'A';
                    $ship->save();
                }
            }

            $order = new Order();
            $order->user_id = !empty($customer->id) ? $customer->id : $email_user->id;
            $order->email = $email;
            $order->payment_id = 1;
            $order->status = 'PLN';
            $order->notes = @$inputs['notes'];
            $order->shipping_cost = 0;
            $order->point = 0;
            $order->discount = 0;
            $order->s_name = $name;
            $order->s_phone = @$shipping['s_phone'];
            $order->s_address = @$shipping['s_address'];
            $order->s_state = @$shipping['s_state'];
            $order->s_district = @$shipping['s_district'];
            $order->s_ward = @$shipping['s_ward'];
            if($flag){
                $order->order_id = rand(100000000, 900000000);
                $order->created_at = date('Y-m-d H:i:s', time());
            }else{
                $order->save();
            }

            $total = 0;
            $items = [];
            foreach($products as $prd){
                $orderItem = new OrderItem();
                $product_id = $prd['product_id'];
                $amount = (int)$prd['amount'];
                $product = $this->product->get_product($product_id);
                $price = (int)@$product->sell_price;
                $total += $amount * $price;
                $orderItem->order_id = $order->order_id;
                $orderItem->product_id = $product_id;
                $orderItem->amount = $amount;
                $orderItem->amount_success = 0;
                $orderItem->price = $price;
                $items[] = [
                    'product_id' => $product_id,
                    'amount' => $amount,
                    'price' => $price
                ];
                if($flag){
                    $orderItem->item_id = rand(100000000, 900000000);
                }else{
                    $orderItem->save();
                }
            }

            $order->total = $total;
            $order->subtotal = $total;
            if($flag){
                $order->order_id = rand(100000000, 900000000);
            }else{
                $order->save();
            }
            return response()->json($this->lib->form_order($order, $items));
        }else{
            $errors = $validator->errors();
            $msgs = [];
            foreach($errors->getMessages() as $key => $message){
                $msgs[$key] = @$message[0];
            }
            return response()->json([
                'success' => false,
                'msg' => $msgs
            ]);
        }
    }


    function shippings($id){
        $user = $this->user->get_user($id);
        return response()->json($this->lib->shippings($user));
    }

    function orders($id){
        $user = $this->user->get_user($id);
        return response()->json($this->lib->orders($user));
    }
}
