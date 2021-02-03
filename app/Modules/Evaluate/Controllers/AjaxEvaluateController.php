<?php


namespace App\Modules\Evaluate\Controllers;

use App\Http\Controllers\SiteController;
use Symfony\Component\HttpFoundation\Request;

use Spatie\Permission\Models\Role;
use App\Libraries\Upload;
use Spatie\Permission\Models\Permission;
use App\Modules\Evaluate\Models\Evaluate;
use App\Modules\Evaluate\Models\EvaluateImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


use Config;

class AjaxEvaluateController extends SiteController
{
    function __construct()
    {
        $this->evaluate = new Evaluate();
        $this->image = new EvaluateImage();
        $this->up = new Upload();
    }
    function add(Request $request){
       $pattern = [
        'product_id' => 'required',
        'star' => 'required|min:1|max:5|numeric',
        'name' => 'required',
        'email' => 'required|email'
     ];
     $messenger = [
        'required' =>  ':attribute '.trans('Evaluate::evaluate.add.form.errors.required'),
        'email' =>  trans('Evaluate::evaluate.add.form.errors.email'),
     ];
     $customName = [
        'product_id' => trans('Evaluate::evaluate.add.form.errors.product_id'),
        'star' =>  trans('Evaluate::evaluate.add.form.errors.star'),
        'name' =>  trans('Evaluate::evaluate.add.form.errors.name'),
        'email' => 'Email'
     ];

     $validator = Validator::make($request->all(),$pattern,$messenger,$customName);
      if ($validator->fails()) {
        return response()->json([
            'status'    =>false, 
            'content'      => trans("Evaluate::evaluate.add.form.errors.title")
        ]);
      }
    $checkemail = $this->evaluate->get_evatuates(['productid' => $request->product_id, 'email' => $request->email]);
    if(count($checkemail)>0){
            return response()->json([
                'status'    =>false, 
                'content'      => trans("Evaluate::evaluate.add.form.errors.emailed")
            ]);
    }
      $saveEvaluate = $this->evaluate->add_evaluate($request);
      
      if(!empty(@$request->image)){
       
        foreach ($request->image as $value) {
            $source_path = '/evaluate/source';
            $result  = $this->up->doUploadmd5($source_path, $value, md5($saveEvaluate), [], true);

            $source_path = '/evaluate/thumb';
            $resultTwo  = $this->up->doUploadmd5($source_path, $value, md5($saveEvaluate), [300, 300], true);

            $this->image = new EvaluateImage();
            $this->image->evaluate_id = $saveEvaluate;
            $this->image->image = $result['name'];
            $this->image->save();
        }
      }
      
      return response()->json([
        'status'    =>true, 
        'content'   => trans("Evaluate::evaluate.add.form.success.title")
    ]);
    }
    function addRaitingAdmin(Request $request){
      $conditions = [
          'name' => 'required',
          'email' => 'required',
          'content' => 'required',
          'star' => 'required'
      ];

      $messages = [
          'name.required'  => 'Xin vui lòng nhập tên',
          'email.required'  => 'Xin vui lòng nhập email',
          'content.required'  => 'Xin vui lòng nhập nội dung',
          'star.required'  => 'Xin vui lòng nhập số sao'
      ];
      $validator = Validator::make($request->all(),
          $conditions,
          $messages
      );
      $passes = $validator->passes();
      $toastr = 'Rất tiếc';
      if($passes){
      $toastr = 'Thành công';
      // thêm sp con thuộc nó
      $saveEvaluate = $this->evaluate->add_evaluate($request);

      }
      $errors = $validator->errors();
      return response()->json([
          'success' => $passes,
          'errors' => $errors,
          'toastr' => $toastr,
          'route' => route("listvaluate")
      ]);

  }
}