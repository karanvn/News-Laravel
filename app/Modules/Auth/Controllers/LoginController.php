<?php


namespace App\Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\PasswordReset;
use Illuminate\Support\Facades\App;
use App\Modules\Product\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Modules\Blog\Models\BlogCategory;
use App\User;

class LoginController extends Controller
{
    protected $loginPath = '/login';

    public function __construct()
    {
        
        $this->middleware('guest')->except('logout');
        $this->password = new PasswordReset();
        $this->blogCategory = new BlogCategory();
        $blogCategories = $this->blogCategory->get_categories();
        view()->share('blogCategories',$blogCategories);
    }

    function login() {
        return view('Auth::auth.login');
    }

    function reset(Request $request) {

        $token = @$request->token;
        if(!empty($token)){
            $prefix_errors_trans = 'Auth::auth.password.errors.';
            $password = $this->password->get_password_reset($token);
            if(empty($password)){
                return redirect()->route('Reset')->with('message', trans($prefix_errors_trans.'token_not_found'));
            }else{
                $expire = $password->created_at;
                if(strtotime($expire) < time()){
                    return redirect()->route('Reset')->with('message', trans($prefix_errors_trans.'token_expire'));
                }else{
                    return view('Auth::auth.password', ['token' => $token]);
                }
            }
        }else{
            return view('Auth::auth.forget', ['token' => '']);
        }
    }
    function ResetCustomerGet(Request $request) {

        $token = @$request->token;
        if(!empty($token)){
            $prefix_errors_trans = 'Auth::auth.password.errors.';
            $password = $this->password->get_password_reset($token);
            if(empty($password)){
                return redirect()->route('resetCustomer')->with('message', trans($prefix_errors_trans.'token_not_found'));
            }else{
                $expire = $password->created_at;
                if(strtotime($expire) < time()){
                    return redirect()->route('resetCustomer')->with('message', trans($prefix_errors_trans.'token_expire'));
                }else{
                    return view('Auth::customer.page.forget', ['token' => $token]);
                }
            }
        }else{
            return view('Auth::auth.forgetcustomer', ['token' => '']);
        }
    }

    function logout(){
        Auth::logout();
        return redirect()->back();
    }

    // khu vuc ng dung
    function loginmember(){
        return view('Auth::auth.loginmember');
    }
    function loginmemberpost(Request $request){
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            return redirect('/')->with('success',trans("Auth::auth.login.msg_login_true"));
        }else{
            return redirect()->back()->withErrors(['cantlogin'=> trans("Auth::auth.login.msg_login_fail")])->withInput();
        }
    }
    function logoutmember(){
        Auth::logout();
        Session::flush();
        return redirect()->back();
    }
    function resetCustomer(){
        if(Auth::check()){
            return redirect()->back();
        }else{
            return view('Auth::auth.forgetcustomer');
        }
    }
}
