<?php

namespace App\Modules\Policy\Controllers;

use App\Http\Controllers\SiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

use App\Libraries\Upload;
use App\Modules\Policy\Models\Policy;
use App\Modules\Log\Libraries\LibActivityLog;

class AjaxController extends SiteController
{
    function processPolicy(Request $request) {
        $inputs = $request->except(['_token']);
        $upload = new Upload();
        $hasFile = $request->hasFile('image') ? true : false;
        $id = !empty($inputs['id']) ? $inputs['id'] : 0;
        $prefix_errors_trans = 'Policy::policy.add.form.errors.';
        $prefix_success_trans = 'Policy::policy.add.form.success.';

        $conditions = [
            'name' => 'required',
        ];

        $messages = [
            'name.required'  => trans($prefix_errors_trans . 'name')
        ];

        if ($hasFile) {
            $conditions['image'] = 'mimes:jpeg,png,jpg|max:1024';
            $messages['image']   = trans($prefix_errors_trans . 'image');
        }

        $validator = Validator::make($request->all(),
            $conditions,
            $messages
        );

        $passes = $validator->passes();
        $policy = !empty($id) ? Policy::where('id', $id)->first() : new Policy();
        $object = clone $policy;
        $toastr = trans($prefix_errors_trans. 'header');

        if($passes){
            $toastr = !empty($id) ? trans($prefix_success_trans . 'edit') : trans($prefix_success_trans . 'add');
            $user_id = Auth::user()->id;
            if(empty($id))
                $policy->user_id = $user_id;
            foreach($inputs as $key => $val){
                $policy->$key = $val;
            }
            $policy->save();

            if ($hasFile) {
                $file = $request->image;
                $image_path    = get_policy_path_image();
                $policy->image = $upload->doUpload($image_path, $file, md5($policy->id), [250, 250]);
                $policy->save();
            }

            $object->object_id = $policy->id;
            $object->user_id = $user_id;
            $object->empty = !empty($id) ? false : true;
            $log = new LibActivityLog();
            $log->policyLog([
                'object' => $object,
                'data'   => $inputs
            ]);
        }
        $errors = $validator->errors();
        return response()->json([
            'success' => $passes,
            'errors'  => $errors,
            'toastr'  => $toastr,
            'policy'  => $policy,
            'inputs'  => $inputs
        ]);
    }
}
