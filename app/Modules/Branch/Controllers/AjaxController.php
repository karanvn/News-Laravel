<?php


namespace App\Modules\Branch\Controllers;

use App\Http\Controllers\SiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

use App\Libraries\Upload;
use App\Modules\Branch\Models\Branch;
use App\Modules\Log\Libraries\LibActivityLog;

class AjaxController extends SiteController
{
    function processBranch(Request $request) {
        $inputs = $request->except(['_token']);
        $upload = new Upload();
        $hasFile = $request->hasFile('avatar') ? true : false;
        $id = !empty($inputs['id']) ? $inputs['id'] : 0;
        $prefix_errors_trans = 'Branch::branch.add.form.errors.';
        $prefix_success_trans = 'Branch::branch.add.form.success.';

        $conditions = [
            'name' => 'required',
        ];

        $messages = [
            'name.required'  => trans($prefix_errors_trans . 'name')
        ];

        if ($hasFile) {
            $conditions['avatar'] = 'mimes:jpeg,png,jpg|max:1024';
            $messages['avatar'] = trans($prefix_errors_trans . 'avatar');
        }

        $validator = Validator::make($request->all(),
            $conditions,
            $messages
        );

        $passes = $validator->passes();
        $branch = !empty($id) ? Branch::where('id', $id)->first() : new Branch();
        $object = clone $branch;
        $toastr = trans($prefix_errors_trans. 'header');

        if($passes){
            $toastr = !empty($id) ? trans($prefix_success_trans . 'edit') : trans($prefix_success_trans . 'add');
            $user_id = Auth::user()->id;
            if(empty($id))
                $branch->user_id = $user_id;
            foreach($inputs as $key => $val){
                $branch->$key = $val;
            }
            $branch->save();

            if ($hasFile) {
                $file = $request->avatar;
                $image_path = get_branch_path_image();
                $branch->avatar = $upload->doUpload($image_path, $file, md5($branch->id), [250, 250]);
                $branch->save();
            }

            $object->object_id = $branch->id;
            $object->user_id = $user_id;
            $object->empty = !empty($id) ? false : true;
            $log = new LibActivityLog();
            $log->branchLog([
                'object' => $object,
                'data' => $inputs
            ]);
        }
        $errors = $validator->errors();
        return response()->json([
            'success' => $passes,
            'errors' => $errors,
            'toastr' => $toastr,
            'branch' => $branch,
            'inputs' => $inputs
        ]);
    }
}
