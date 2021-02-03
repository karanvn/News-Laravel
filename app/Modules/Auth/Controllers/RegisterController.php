<?php


namespace App\Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Modules\Mail\Libraries\MailTemplate;
use App\Modules\Blog\Models\BlogCategory;
use App\Modules\Product\Models\Category;
use Symfony\Component\HttpFoundation\Request;


class RegisterController extends Controller
{
    
    public function __construct()
    {
        $this->user = new User();
        $this->category = new Category();
        $this->blogCategory = new BlogCategory();
        $blogCategories = $this->blogCategory->get_categories();
        view()->share('blogCategories',$blogCategories);
        $menuProduct = $this->category->get_categories([
            'status' => 'A'
        ]);
        view()->share('menuProducts',$menuProduct);
    }
    function index() {
       
        return view('Auth::auth.register', []);
    }
    function registerpost(Request $request){
        // kiểm tra nhập liệu 
        $pattern = [
            'fullname' => 'required',
            'password' => 'required|min:6',
            'email' => 'required|email',
            'phone' => 'required|regex:/(0)[0-9]{9}/',
            'cpassword' => 'required|same:password',
            'agree' => 'accepted'
         ];
         $messenger = [
            'required' => ':attribute '.trans("Auth::auth.validator.required"),
            'regex' => ':attribute '.trans("Auth::auth.validator.regex"),
            'email' =>  trans("Auth::auth.validator.email"),
            'same' => ':attribute '.trans("Auth::auth.validator.same"),
            'accepted' => ':attribute '.trans("Auth::auth.validator.accepted"),
            'min' => ':attribute '.trans("Auth::auth.validator.min"),
         ];

         $customName = [
            'fullname' => trans("Auth::auth.validator.fullname"),
            'password' => trans("Auth::auth.validator.password"),
            'email' => 'email',
            'phone' => trans("Auth::auth.validator.phone"),
            'cpassword' => trans("Auth::auth.validator.cpassword"),
            'agree' => trans("Auth::auth.validator.agree")
         ];
         $validator = Validator::make($request->all(),$pattern,$messenger,$customName);
          if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
          }
        // kiểm tra xem email này đã dk đăng ký chưa
        if(User::where('email', $request->email)->count()>0){
            return redirect()->back()->withErrors(['email'=> trans("Auth::auth.validator.emailused")])->withInput();
        }
    //    tiến hành đăng ký tài khoản
     $new = $this->user-> adduser($request);
     Auth::attempt(['email'=>$request->email, 'password'=>$request->password]);
    //  gửi mail
    $mail = new MailTemplate();
    $mail->sendMail([
        'type' => 'USER_CREATE',
        'object' => User::find(Auth::id())
    ]);

         return redirect('/')->with('success',trans("Auth::auth.validator.success"));

    }
}
