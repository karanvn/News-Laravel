<?php


namespace App\Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;
use App\Libraries\Upload;
use App\Modules\Auth\Models\Shipping;
use App\Modules\Log\Libraries\LibActivityLog;
use App\Modules\Mail\Libraries\MailTemplate;
use App\Modules\Location\Models\District;
use App\Modules\Location\Models\Ward;
use App\Modules\Feedback\Models\Feedback;
use App\PasswordReset;

class AjaxController extends Controller
{

    function __construct()
    {
        $this->user = new User();
        $this->password = new PasswordReset();
        $this->user = new User();
        $this->district = new District;
        $this->Shipping = new Shipping();
        $this->feedback     = new Feedback();
        $this->ward = new Ward;
    }
    function login(Request $request) {
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

            return redirect()->intended('/admins');
        }else{
            return redirect()->back()->with('message', trans('Auth::auth.login.msg_login_fail'));
        }
    }

    function reset(Request $request) {
        $inputs = $request->except(['_token']);
        $email = @$inputs['email'];
        if(empty($email)){
            return redirect()->back()->with('message', trans('Auth::auth.reset.msg_email_empty'));
        }else{
            $user = $this->user->get_email_user(@$inputs['email']);
            if(empty($user) || @$user->status != 'A'){
                return redirect()->back()->with('message', trans('Auth::auth.reset.msg_email_not_found'));
            }else{
                $mail = new MailTemplate();
                $reset = new PasswordReset();
                $token = Str::random(100);
                $reset->email = $email;
                $reset->token = $token;
                $reset->created_at = date('Y-m-d H:i:s', time() + 86400);
                $reset->save();
                if(@$request->customer == 'on'){
                    $user->url = route('ResetCustomerGet').'?token='.$token;
                }else{
                    $user->url = route('Reset').'?token='.$token;

                }
                $mail->sendMail([
                    'type' => 'USER_FORGOT_PASSWORD',
                    'object' => $user
                ]);
                return redirect()->back()->with('message', trans('Auth::auth.reset.msg_reset_success'));
            }
        }
    }

    function resetPassword(Request $request){
        $inputs = $request->except(['_token']);
        $prefix_errors_trans = 'Auth::auth.password.errors.';
        $prefix_success_trans = 'Auth::auth.password.success';
        $token = @$inputs['token'];

        $conditions = [
            'email' => 'required|email',
            'password' => 'required|min:6',
            're_password' => 'required|same:password'
        ];

        $messages = [
            'password.required'        => trans($prefix_errors_trans . 'password'),
            're_password.required'        => trans($prefix_errors_trans . 're_password'),
            're_password.same'             => trans($prefix_errors_trans . 're_password_same'),
            'password.min'             => trans($prefix_errors_trans . 'password_min'),
            'email.required' => trans($prefix_errors_trans . 'email'),
            'email.email'    => trans($prefix_errors_trans . 'email_format')
        ];

        $validator = Validator::make($inputs,
            $conditions,
            $messages
        );

        $passes = $validator->passes();
        if($passes){
            $password = $this->password->get_password_reset($token);
            if(empty($password)){
                return redirect()->route('resetCustomer')->with('message', trans($prefix_errors_trans.'token_not_found'));
            }else{
                $email = @$inputs['email'];
                if($password->email != $email){
                    $message = trans($prefix_errors_trans.'email_token_not_match');
                }else{
                    $user = $this->user->get_email_user($email);
                    $user->password = Hash::make(@$inputs['password']);
                    $user->save();
                    $message = trans($prefix_success_trans);
                }
            }
        }else{
            $errors = $validator->errors();
            $msgs = [];
            foreach($errors->getMessages() as $key => $message){
                $msgs[] = @$message[0];
            }
            $message = implode(". ", $msgs);
        }
        return redirect()->back()->with('message', $message);

    }

    function processAdmin(Request $request) {
        $inputs = $request->except(['_token']);
        $upload = new Upload();
        $hasFile = $request->hasFile('avatar') ? true : false;
        $id = !empty($inputs['id']) ? $inputs['id'] : 0;
        $prefix_errors_trans = 'Auth::admin.add.form.errors.';
        $prefix_success_trans = 'Auth::admin.add.form.success.';

        $page = @$inputs['page'];

        $conditions = [];
        $messages = [];

        $pass_conditions = [
            'password' => 'required|min:6',
            're_password' => 'required|same:password'
        ];

        $pass_messages = [
            'password.required'        => trans($prefix_errors_trans . 'password'),
            're_password.required'        => trans($prefix_errors_trans . 're_password'),
            're_password.same'             => trans($prefix_errors_trans . 're_password_same'),
            'password.min'             => trans($prefix_errors_trans . 'password_min')
        ];

        if($page== 'general'){
            $conditions = [
                'name' => 'required',
                'email' => 'required|email',
            ];

            $messages = [
                'name.required'  => trans($prefix_errors_trans . 'name') ,
                'email.required' => trans($prefix_errors_trans . 'email'),
                'email.email'    => trans($prefix_errors_trans . 'email_format')
            ];

            if(empty($id)){
                $conditions = array_merge($pass_conditions, $conditions);
                $messages = array_merge($pass_messages, $messages);
            }
        }elseif($page == 'password'){
            $conditions = $pass_conditions;
            $messages = $pass_messages;
        }

        if(empty($id) && $page == 'general'){
            $conditions['email'] = 'required|email|unique:users,email';
            $messages['email.unique'] = trans($prefix_errors_trans . 'email_exists');
        }

        if ($hasFile && $page) {
            $conditions['avatar'] = 'mimes:jpeg,png,jpg|max:1024';
            $messages['avatar'] = trans($prefix_errors_trans . 'avatar');
        }

        $validator = Validator::make($request->all(),
            $conditions,
            $messages
        );

        $passes = $validator->passes();
        $user = !empty($id) ? $this->user->get_user($id) : $this->user;
        $object = clone $user;
        $toastr = trans($prefix_errors_trans. 'header');

        if($passes){
            $toastr = !empty($id) ? trans($prefix_success_trans . 'edit') : trans($prefix_success_trans . 'add');
            $user_id = Auth::user()->id;
            if(empty($id))
                $user->user_id = $user_id;
            foreach($inputs as $key => $val){
                if(!in_array($key, array('re_password', 'page', 'id')))
                    $user->$key = $key != 'password' ? $val : Hash::make($val);
            }
            $user->save();

            if ($hasFile) {
                $file = $request->avatar;
                $image_path = config('auth_.image.thumb');
                $user->avatar = $upload->doUpload($image_path, $file, md5($user->id), [250, 250]);
                $user->save();
            }

            $object->object_id = $user->id;
            $object->user_id = $user_id;
            $object->empty = !empty($id) ? false : true;
            $log = new LibActivityLog();
            $log->adminLog([
                'object' => $object,
                'data' => $inputs
            ]);
        }
        $errors = $validator->errors();
        return response()->json([
            'success' => $passes,
            'errors' => $errors,
            'toastr' => $toastr,
            'user' => $user,
            'flag' => !empty($id) ? true : false,
            'route' => $passes  ? route('AdminEdit', [$user->id, 'general']) : false,
        ]);
    }


    function processAdminRule(Request $request) {
        $inputs = $request->except(['_token']);

        $id = !empty($inputs['id']) ? $inputs['id'] : 0;
        $prefix_success_trans = 'Auth::admin.add.form.success.';

        $user = !empty($id) ? $this->user->get_user($id) : $this->user;

        $toastr = trans($prefix_success_trans . 'rule');

        //Remove all user roles
        $user_roles = $user->roles()->get();
        if(count($user_roles) > 0){
            foreach($user_roles as $user_role){
                $user->removeRole($user_role->id);
            }
        }

        $role_ids = @$inputs['role_ids'];
        if(!empty($role_ids)){
            //Asign new user roles
            foreach($role_ids as $role_id){
                $user->assignRole($role_id);
            }
        }

        //Remove all user permissions
        $user_permissions = $user->permissions()->get();
        if(count($user_permissions) > 0){
            foreach($user_permissions as $user_permission){
                $user->revokePermissionTo($user_permission->id);
            }
        }

        $permission_ids = @$inputs['permission_ids'];
        if(!empty($permission_ids)){
            //Asign new user permissions
            foreach($permission_ids as $permission_id){
                $user->givePermissionTo($permission_id);
            }
        }

        return response()->json([
            'success' => true,
            'toastr' => $toastr,
            'flag' => true,
            'user' => $user
        ]);
    }


    function processCustomer(Request $request) {
        $inputs = $request->except(['_token']);
        $upload = new Upload();
        $hasFile = $request->hasFile('avatar') ? true : false;
        $id = !empty($inputs['id']) ? $inputs['id'] : 0;
        $prefix_errors_trans = 'Auth::customer.add.form.errors.';
        $prefix_success_trans = 'Auth::customer.add.form.success.';

        $page = @$inputs['page'];

        $conditions = [];
        $messages = [];

        $pass_conditions = [
            'password' => 'required|min:6',
            're_password' => 'required|same:password'
        ];

        $pass_messages = [
            'password.required'        => trans($prefix_errors_trans . 'password'),
            're_password.required'        => trans($prefix_errors_trans . 're_password'),
            're_password.same'             => trans($prefix_errors_trans . 're_password_same'),
            'password.min'             => trans($prefix_errors_trans . 'password_min')
        ];

        if($page== 'general'){
            $conditions = [
                'name' => 'required',
                'email' => 'required|email',
            ];

            $messages = [
                'name.required'  => trans($prefix_errors_trans . 'name') ,
                'email.required' => trans($prefix_errors_trans . 'email'),
                'email.email'    => trans($prefix_errors_trans . 'email_format')
            ];

            if(empty($id)){
                $conditions = array_merge($pass_conditions, $conditions);
                $messages = array_merge($pass_messages, $messages);
            }
        }elseif($page == 'password'){
            $conditions = $pass_conditions;
            $messages = $pass_messages;
        }

        if(empty($id) && $page == 'general'){
            $conditions['email'] = 'required|email|unique:users,email';
            $messages['email.unique'] = trans($prefix_errors_trans . 'email_exists');
        }

        if ($hasFile && $page) {
            $conditions['avatar'] = 'mimes:jpeg,png,jpg|max:1024';
            $messages['avatar'] = trans($prefix_errors_trans . 'avatar');
        }

        $validator = Validator::make($request->all(),
            $conditions,
            $messages
        );

        $passes = $validator->passes();
        $user = !empty($id) ? $this->user->get_user($id) : $this->user;
        $object = clone $user;
        $toastr = trans($prefix_errors_trans. 'header');

        if($passes){
            $toastr = !empty($id) ? trans($prefix_success_trans . 'edit') : trans($prefix_success_trans . 'add');
            $user_id = Auth::user()->id;
            if(empty($id))
                $user->user_id = $user_id;
            foreach($inputs as $key => $val){
                if(!in_array($key, array('re_password', 'page', 'id')))
                    $user->$key = $key != 'password' ? $val : Hash::make($val);
            }
            $user->save();

            if ($hasFile) {
                $file = $request->avatar;
                $image_path = config('auth_.image.customer_thumb');
                $user->avatar = $upload->doUpload($image_path, $file, md5($user->id), [250, 250]);
                $user->save();
            }

            $object->object_id = $user->id;
            $object->user_id = $user_id;
            $object->empty = !empty($id) ? false : true;
            $log = new LibActivityLog();
            $log->customerLog([
                'object' => $object,
                'data' => $inputs
            ]);
        }

        $errors = $validator->errors();
        return response()->json([
            'success' => $passes,
            'errors' => $errors,
            'toastr' => $toastr,
            'flag' => !empty($id) ? true : false,
            'route' => $passes  ? route('CustomerEdit', [$user->id, 'general']) : false
        ]);
    }

    function processCustomerShipping(Request $request){
        $inputs = $request->except(['_token']);
        $id = !empty($inputs['id']) ? $inputs['id'] : 0;
        $prefix_errors_trans = 'Auth::customer.add.form.errors.';
        $prefix_success_trans = 'Auth::customer.add.form.success.';

        $conditions = [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'state_id' => 'required|numeric|gt:0',
            'district_id' => 'required|numeric|gt:0',
            'ward_id' => 'required|numeric|gt:0'
        ];

        $messages = [
            'name.required'  => trans($prefix_errors_trans . 'name') ,
            'phone.required' => trans($prefix_errors_trans . 'phone'),
            'address.required'        => trans($prefix_errors_trans . 'address'),
            'state_id.required'    => trans($prefix_errors_trans . 'state_id'),
            'state_id.gt'  => trans($prefix_errors_trans . 'state_id'),
            'district_id.required'    => trans($prefix_errors_trans . 'district_id'),
            'district_id.gt'  => trans($prefix_errors_trans . 'district_id'),
            'ward_id.required'    => trans($prefix_errors_trans . 'ward_id'),
            'ward_id.gt'  => trans($prefix_errors_trans . 'ward_id')
        ];

        $validator = Validator::make($request->all(),
            $conditions,
            $messages
        );

        $passes = $validator->passes();
        $model = new Shipping();
        $shipping = !empty($id) ? $model->get_shipping($id) : $model;
        $object = clone $shipping;
        $toastr = trans($prefix_errors_trans. 'header');

        if($passes){
            $toastr = !empty($id) ? trans($prefix_success_trans . 'edit_shipping') : trans($prefix_success_trans . 'add_shipping');
            foreach($inputs as $key => $val){
                if($key != 'page')
                    $shipping->$key = $val;
            }
            $shipping->save();

            $object->object_id = $shipping->user_id;
            $object->user_id = Auth::user()->id;
            $object->sub_id = $shipping->id;
            $object->empty = !empty($id) ? false : true;
            $log = new LibActivityLog();

            $log->shippingLog([
                'object' => $object,
                'data' => $inputs
            ]);
        }
        $errors = $validator->errors();
        return response()->json([
            'success' => $passes,
            'errors' => $errors,
            'toastr' => $toastr,
            'flag' => true,
            'shipping' => $shipping
        ]);
    }

    function processCustomerShippingForm($change_id){
        $model = new Shipping();
        $html = "";
        $flag = false;
        if($change_id != 'list'){
            $shipping = !empty($change_id) ? $model->get_shipping($change_id) : $model;
            $html  = view('Auth::customer.form.shipping_item', ['shipping' => $shipping])->render();
            $flag = true;
        }

        return response()->json([
            'success' => true,
            'flag' => $flag,
            'html' => $html
        ]);
    }

    function processCustomerOrder(User $user){
        $success = false;
        $colorStatuses = [
            'PLN'  => '#EBEDF3',
            'CONF' => '#8950FC',
            'SHIP' => '#3699FF',
            'SHIF' => '#FFA800',
            'CAN'  => '#F64E60',
            'COM'  => '#1BC5BD',
        ];
        $labelStatuses = get_order_statuses();
        $colors = [];
        $labels = [];
        $series = [];
        if(!empty($user->id)){
            $orders = $user->orders()->orderBy('order_id', 'desc')->get();
            if(count($orders) > 0){
                foreach($orders as $order){
                    $series[$order->status] = @$series[$order->status] + 1;
                }
                if(!empty($series)){
                    $success = true;
                    $keys = array_keys($series);
                    $series = array_values($series);
                    foreach($keys as $key){
                        $colors[] = @$colorStatuses[$key];
                        $labels[] = Str::upper(@$labelStatuses[$key]);
                    }
                }
            }
        }
        return response()->json([
            'success' => $success,
            'labels' => $labels,
            'colors' => $colors,
            'series' => $series
        ]);
    }
    function loadDistricts($state_id = 0){
        if(!empty($state_id)){
            $districts = $this->district->get_districts(['status' => 'A', 'state_id' => $state_id, 'orderBy' => ['name', 'asc']]);
            return response()->json([
                'success' => true,
                'data' => $districts
            ]);
        }else{
            return response()->json([
                'success' => false,
                'data' => []
            ]);
        }
    }

    function loadWards($district_id = 0){
        if(!empty($district_id)){
            $wards = $this->ward->get_wards(['status' => 'A', 'district_id' => $district_id, 'orderBy' => ['name', 'asc']]);
            return response()->json([
                'success' => true,
                'data' => $wards
            ]);
        }else{
            return response()->json([
                'success' => false,
                'data' => []
            ]);
        }
    }
    function addAddressAjax(Request $request){
       
        $pattern = [
            'address'       => 'required',
            'state'      => 'required',
            'district'   => 'required',
            'ward'       => 'required',
            'name'       => 'required',
            'phone'       => 'required|regex:/(0)[0-9]{9}/'
        ];
        $messenger = [
            'required'  =>  ':attribute '.trans('Auth::customer.add.form.errors.required'),
            'numeric'  =>  ':attribute không đúng định dạng',
            'regex'  =>  ':attribute không đúng định dạng'
        ];
        $customAttributes = [
            'address'       => 'Địa chỉ ',
            'state'      => 'Tỉnh/Thành ',
            'district'   => 'Quận/Huyện ',
            'ward'       => 'Phường/Xã '
        ];
        $validator = Validator::make($request->all(),$pattern,$messenger,$customAttributes);
        if ($validator->fails()) {
            return response()->json([
                'status' => '2',
                'message' =>  trans('Cart::cart.address.error.required')
            ]);
        }
        if(empty($request->address)||empty($request->ward)||empty($request->district)||empty($request->state)){
            return response()->json([
                'status' => '2',
                'message' => trans('Cart::cart.address.error.required')
            ]);
        }

        // trường hợp chạy dk
        
        $request->request->add(['user_id' => Auth::id()]);
        $checkIssetAddress = $this->Shipping->get_shippings_new($request);
        if(empty($request->address_update_id)){
            if(!empty($checkIssetAddress[0])){
                return response()->json([
                    'status' => '2',
                    'message' =>  trans('Cart::cart.address.error.addressUsed')
                ]);
            }
        }
        $request->request->add([
            'phone' => $request->phone,
            'name' =>  $request->name,
            'state_id' => $request->state,
            'district_id' => $request->district,
            'ward_id' => $request->ward,
            'status' => 'A'
            ]);
        if(!empty($request->address_update_id)){
                $shippingUpdate = Shipping::find($request->address_update_id);
                if(empty($shippingUpdate)){
                    return response()->json([
                        'status' => '2',
                        'message' => trans('Cart::cart.address.error.addressNone')
                    ]);
                }
                $shippingUpdate->edit_shipping($request->all());
            }else{
                $shippingNew = new Shipping();
                $shippingNew->save_shipping($request);
            }
        $orders = $this->Shipping->get_shippings(Auth::id())->where('status','A');
        $address_update_id =  empty($request->address_update_id) ? '' : $request->address_update_id;
        return response()->json([
            'status' => '1',
            'message' => empty($request->address_update_id) ? trans('Cart::cart.address.success.add') :  trans('Cart::cart.address.success.edit'),
            'html'      =>view('Auth::customer.ajax.listAddressAddCheckout', ['orders' => $orders,'address_update_id' =>$address_update_id])->render()
        ]);
    }
    function searchAddressAjax($id = ''){
        if(empty($id)){
            return response()->json([
                'status' => '2',
                'message' =>  trans('Cart::cart.address.error.addressNone')
            ]);
        }
        $address = $this->Shipping->get_shipping($id);
        if(empty($address)){
            return response()->json([
                'status' => '2',
                'message' =>  trans('Cart::cart.address.error.addressNone')
            ]);
        }
        $districts = $this->district->get_districts(['status' => 'A', 'state_id' => $address->state_id, 'orderBy' => ['name', 'asc']]);
        $wards = $this->ward->get_wards(['status' => 'A', 'district_id' => $address->district_id, 'orderBy' => ['name', 'asc']]);
        return response()->json([
            'status' => '1',
            'data' => $address,
            'districts' => $districts,
            'wards' => $wards,
            'name' => $address->name,
            'phone' => $address->phone
        ]);

    }
    function withlistajax(){
        $datas = $this->productlove->get_productloves([
            'UserId'  => Auth::id(),
            'limit'    => 2
        ]);
        $status = 0;
       if($datas->hasMorePages()){
        $status = 1;
       }
        return response()->json([
            'status' => $status,
            'html' => view('Auth::web.pages.withlistAjax',compact('datas'))->render()
        ]);
    }
    function deleteWithList($id, $i){
        if(Auth::check()){
            $love = $this->productlove->get_productloves([
                'product_id' => $id,
                'UserId' => Auth::id()
            ]);
            if(!empty($love->toArray())){
                $love = $love[0];
                $love->delete();
            }else{
                $addLove = new ProductLove();
                $addLove->product_id = $id;
                $addLove->user_id = Auth::id();
                $addLove->save();
            }
        }
        $datas = $this->productlove->get_productloves([
            'UserId'  => Auth::id(),
            'limit'    => $i*2
        ]);
        $status = 0;
       if($datas->hasMorePages()){
        $status = 1;
       }
        return response()->json([
            'status' => $status,
            'html' => view('Auth::web.pages.withlistAjaxDel',compact('datas'))->render()
        ]);
    } 
    public function addfeedBack(Request $request){
        // $this->feedback
        $conditions = [
            'name' => 'required',
            'email' => 'required',
            'content' => 'required'
        ];
  
        $messages = [
            'name.required'  => 'Xin vui lòng nhập tên',
            'email.required'  => 'Xin vui lòng nhập email',
            'content.required'  => 'Xin vui lòng nhập nội dung'
        ];
        $validator = Validator::make($request->all(),
            $conditions,
            $messages
        );
        $passes = $validator->passes();
        $errors = 'Xin vui lòng nhập đầy đủ thông tin';
        if($passes){
            $feedback = new Feedback();
            $feedback->fullname = @$request->name;
            $feedback->email = @$request->email;
            $feedback->content = @$request->content;
            $feedback->status = '1';
            $feedback->save();
            $errors = 'Gửi tin nhắn thành công';
        }
        return response()->json([
            'success' => $passes,
            'errors' => $errors
        ]);
    }

}
