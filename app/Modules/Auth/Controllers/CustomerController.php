<?php


namespace App\Modules\Auth\Controllers;

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Libraries\Upload;
use App\Modules\Log\Libraries\LibActivityLog;
use App\Modules\Log\Models\ActivityLog;
use App\Modules\Blog\Models\BlogCategory;
use App\Modules\Auth\Models\Shipping;
use App\Modules\Location\Models\State;
use App\Modules\Location\Models\District;
use App\Modules\Location\Models\Ward;
use App\Modules\Feedback\Models\Feedback;
use App\Modules\Mail\Models\MailLog;
use App\Modules\Auth\Models\Pointuser;
use App\Modules\Auth\Models\ReciveMail;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomerController extends SiteController
{
    function __construct()
    {
        $this->user         = new User();
        $this->log          = new ActivityLog();
        $this->blogCategory = new BlogCategory();
        $this->feedback     = new Feedback();
        $this->upload       = new Upload();
        $this->pointuser    = new Pointuser();
        $this->reciveMail   = new ReciveMail();
        $this->upload       = new Upload();
        $this->mailLog      = new MailLog();
    }

    public function index(Request $request) {
        $filters = [
            'name' => @$request->get('name'),
            'email' => @$request->get('email'),
            'id'    => @$request->get('id'),
            'status' => @$request->get('status'),
            'bod'   => @$request->bod,
            'point'   => @$request->point,
            'count_order'  => @$request->count_order
        ];
       

        $params = array_merge($filters, ['limit' => 12, 'orderBy' => ['point', 'desc']]);
        $params['email'] = $filters['email'].'%';
        $params['user_type'] = 'C';

        $users = $this->user->get_users($params);
        return view('Auth::customer.index', [
            'filters' => $filters,
            'filter' => get_auth_filters($filters),
            'users' => $users]);

        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('Auth::customer.index', ['users' => $users]);
    }

    public function add(){
        return view('Auth::customer.add', ['user_type' => 'C']);
    }

    public function edit(User $user, $page = 'general'){
        if($user->user_type == 'A')
            return redirect()->route('AdminEdit', [$user->id, 'general']);

        $logs = $page != 'history' ? [] : $this->log->get_logs([
            'type' => 'CUSTOMER',
            'object_id' => $user->id
        ]);
        return view('Auth::customer.edit', [
            'user' => $user,
            'logs' => $logs,
            'lib' => new LibActivityLog(),
            'page' => $page]);
    }
    public function getProfileCustomer() 
    {
        $user = Auth::user();
        return view('Auth::web.profile',compact('user'));        
    }
    public function postEditInfoCustomer(Request $request)
    {
        $pattern = [
            'fullname' => 'required',
            'phone' => 'required|max:11|min:10',
        ];
        $messenger = [
            'fullname.required'  =>  ':attribute '.trans('Auth::customer.add.form.errors.required'),
            'phone.required'  =>  ':attribute '.trans('Auth::customer.add.form.errors.required'),
            'phone.min'       =>  ':attribute '.trans('Auth::customer.add.form.errors.phone_min'),
            'phone.max'       =>  ':attribute '.trans('Auth::customer.add.form.errors.phone_max')
        ];
        $customAttributes = [
            'fullname'  => 'Họ và tên',
            'phone'     => 'Số điện thoại'
        ];
        $validator = Validator::make($request->all(),$pattern,$messenger,$customAttributes);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $nameAvatar = '';
        if($request->hasFile('image'))
        {
        	$file = $request->file('image');
            // $result =  $this->upload->doUploadmd5('storage/customer/thumb/', $file, md5(date('Y-m-d H:i:s')), [], true);
            $source_path = '/user/thumb';
            $result = $this->upload->doUpload($source_path, $file, '', [], true);
            $img = User::find(Auth::user()->id)->avatar;
            if(isset($img) && (file_exists($source_path."/".$img) == '1'))
              {
                unlink($source_path."/".$img);
              }
            $nameAvatar = $result['name'];
        }
       
        $id_user = Auth::user()->id;
        $user = $this->user->get_user($id_user)->editUserCustomer((object)array_merge($request->all(),['image'=> @$nameAvatar]));
        
        if($user==null){
            return redirect()->back();
        }
        $user = $this->user->get_user($id_user);
        return redirect()->route('profile-customer',['user'=>$user])->with([
                                                'message'=>'Thay đổi thông tin thành công',
        ]);
    }
    public function getOrdersCustomer()
    {
        $id_user = Auth::user()->id;
        $orders_user = $this->order->get_order_user($id_user);
        //dd($orders_user);
        return view('Auth::web.orders',compact('orders_user'));
    }
    public function getOrderDetailCustommer($order_id)
    {
        //$orderItems = $this->orderItem->getOrderItems($order_id);
        $order = $this->order->get_order($order_id);
        if(empty($order)){
            return redirect('/');
        }
        if($order->user_id != Auth::id()){
            return redirect('/');
        }
        //dd($order->items);
        return view('Auth::web.order_detail',compact('order'));
    }
    public function getEditPasswordCustomer()
    {
        return view('Auth::web.change_password');
    }
    public function postEditPasswordCustomer(Request $request)
    {
        $pattern = [
            'password' => 'required|min:6',
            're_password' => 'required|same:password',
        ];
        $messenger = [
            'password.required'     => ':attribute '.trans('Auth::customer.add.form.errors.required'),
            'password.min'          => ':attribute '.trans('Auth::customer.add.form.errors.password_min'),
            're_password.required'  => ':attribute '.trans('Auth::customer.add.form.errors.required'),
            're_password.same'      => ':attribute '.trans('Auth::customer.add.form.errors.re_password_same'),
        ];
        $customAttributes = [
            'password'        => 'Mật khẩu mới',
            're_password'     => 'Nhập lại mật khẩu và'
        ];
        $validator = Validator::make($request->all(),$pattern,$messenger,$customAttributes);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $id_user = Auth::user()->id;
        $user = $this->user->get_user($id_user);
        $user->password=bcrypt($request->password);
        $user->save();
        if($user==null){
            return redirect()->back();
        }
        $user = $this->user->get_user($id_user);
        return redirect()->route('change-password')->with([
                                                'message'=>'Thay đổi thông tin thành công',
        ]);
    }
    public function getAddressCustomer()
    {
        $user_id = Auth::user()->id;
        $shippings = Shipping::where('user_id',$user_id)->get();
        return view('Auth::web.address',compact('shippings'));
    }
    public function getAddAddressCustomer()
    {
        $states = State::all();
        return view('Auth::web.add_address',compact('states'));
    }
    public function postAddAddressCustomer(Request $request)
    {
        //dd($request->all());
        $pattern = [
            'name'          => 'required',
            'phone'         => 'required|max:11|min:10',
            'address'       => 'required',
            'state_id'      => 'required',
            'district_id'   => 'required',
            'ward_id'       => 'required'
        ];
        $messenger = [
            'required'  =>  ':attribute '.trans('Auth::customer.add.form.errors.required'),
            'phone.min'       =>  ':attribute '.trans('Auth::customer.add.form.errors.phone_min'),
            'phone.max'       =>  ':attribute '.trans('Auth::customer.add.form.errors.phone_max')
        ];
        $customAttributes = [
            'name'  => 'Họ và tên ',
            'phone'     => 'Điện thoại ',
            'address'       => 'Địa chỉ ',
            'state_id'      => 'Tỉnh/Thành ',
            'district_id'   => 'Quận/Huyện ',
            'ward_id'       => 'Phường/Xã '
        ];
        $validator = Validator::make($request->all(),$pattern,$messenger,$customAttributes);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user_id = Auth::user()->id;
        $shipping = new Shipping();
        $data = array_merge($request->all(),['user_id'=>$user_id]);
        $shipping->save_shipping($data);
        return  redirect()->route('address-customer')->with(['message'=>'Thêm địa chỉ thành công!']);
    }
    public function getEditAddressCustomer($id, Request $request)
    {
        $request->session()->put('id_addressEdit', $id);

        $shipping = Shipping::find($id);
        if(empty($shipping)){
            return  redirect()->route('address-customer');
        }
        if($shipping->user_id != Auth::id()){
            return  redirect()->route('address-customer');
        }
        $states     = State::all();
        $districts  = District::where('state_id', $shipping->state_id)->get();
        $wards      = Ward::where('district_id',$shipping->district_id)->get();
        return view('Auth::web.edit_address',compact('shipping','states','districts','wards'));
    }
    public function postEditAddressCustomer(Request $request)
    {
        $id_addressEdit = $request->session()->pull('id_addressEdit', 'default');
        //dd($request->all());
        $pattern = [
            'name'          => 'required',
            'phone'         => 'required|max:11|min:10',
            'address'       => 'required',
            'state_id'      => 'required',
            'district_id'   => 'required',
            'ward_id'       => 'required'
        ];
        $messenger = [
            'required'  =>  ':attribute '.trans('Auth::customer.add.form.errors.required'),
            'phone.min'       =>  ':attribute '.trans('Auth::customer.add.form.errors.phone_min'),
            'phone.max'       =>  ':attribute '.trans('Auth::customer.add.form.errors.phone_max')
        ];
        $customAttributes = [
            'name'  => 'Họ và tên ',
            'phone'     => 'Điện thoại ',
            'address'       => 'Địa chỉ ',
            'state_id'      => 'Tỉnh/Thành ',
            'district_id'   => 'Quận/Huyện ',
            'ward_id'       => 'Phường/Xã '
        ];
        $validator = Validator::make($request->all(),$pattern,$messenger,$customAttributes);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $shipping = Shipping::find($request->id);
        if(empty($shipping)){
            return  redirect()->route('address-customer')->with('error','Địa chỉ giao hàng không tồn tại!');
        }
        if(($shipping->user_id != Auth::id())||($request->id != $id_addressEdit)){
            return  redirect()->route('address-customer')->with('error','Địa chỉ giao hàng không chính xác!');
        }
        $shipping->edit_shipping($request->all());
        return redirect()->route('address-customer')->with(['message'=>'Sửa địa chỉ thành công!']);
    }

    public function listFeedback(Request $request){
        $filters = [
            'email'  => @$request->get('email'),
            'id'     => @$request->get('id'),
            'status' => @$request->get('status'),
            'type' => @$request->get('type')
        ];
        if(!empty($request->type)){
            $feedbacks = $this->feedback->get_feedbacks(['limit' => 30,'type' => $request->type]);

        }else{
            $feedbacks = $this->feedback->get_feedbacks(['limit' => 30]);

        }


        return view('Auth::admin.feedback', [
            'filter'    => get_auth_filters($filters),
            'feedbacks' => $feedbacks,
        ]);
    } 
    
    public function registerReciveInfo(Request $request){
        $filters = [
            'email' => @$request->get('email'),
            'id'    => @$request->get('id'),
        ];

        $mails = $this->reciveMail->get_mails(['limit' => 12]);

        return view('Auth::admin.recive_info', [
            'filter' => get_auth_filters($filters),
            'mails'  => $mails,
        ]);
    } 
    
    public function profilePoint(){
        $user = Auth::user();
        $points = $this->pointuser->get_points(['user_id' => Auth::id()]);
        return view('Auth::web.point',compact('user','points'));  
    }

    public function cancelOrder(Request $request){
        $input = $request->except('_token');
        $order = $this->order->get_order($input['id_order']);
       
        foreach($order->items as $item){
            $product = $this->product->find($item->product_id);
            $productUpdate = [
                'qty'  => $item->amount + $product->qty,
                'sold' => $product->sold - $item->amount,
            ];
            
            $product->update($productUpdate);
        }

        $orderUpdate = [
            'status' => "CAN",
        ];

        $order->update($orderUpdate);
        return redirect()->route('orders-customer')->with('success', 'Hủy đơn đặt hàng thành công!');
    }
    public function withlist(){
        $datas = $this->productlove->get_productloves([
            'UserId' => Auth::id(),
            'limit'  => 2
        ]);
        return view('Auth::web.withlist',compact('datas'));
    }

    public function sendmailBirthday(Request $request){
        // die('<p style="color:red">************** DIE HERE **************</p>');
        $filters = [
            'email' => @$request->get('email'),
            'id'    => @$request->get('id'),
        ];
            
        $mails = $this->mailLog->getMailLogs(['limit' => 12]);
            
        return view('Auth::admin.sendmail_birthday', [
            'filter' => get_auth_filters($filters),
            'mails'  => $mails,
        ]);
    }
  
    

}