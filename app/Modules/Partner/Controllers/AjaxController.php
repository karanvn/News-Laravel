<?php


namespace App\Modules\Partner\Controllers;

use App\Http\Controllers\SiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

use App\Libraries\Upload;
use App\Modules\Partner\Models\Partner;


class AjaxController extends SiteController
{
    function __construct()
    {
        $this->partner = new Partner();
    }

    function processPartner(Request $request) {
        $inputs = $request->except(['_token']);
        $upload = new Upload();
        $hasFile = $request->hasFile('avatar') ? true : false;
        $id = !empty($inputs['id']) ? $inputs['id'] : 0;
        $prefix_errors_trans = 'Partner::partner.add.form.errors.';
        $prefix_success_trans = 'Partner::partner.add.form.success.';

        $page_personal = @$inputs['page'] == 'personal' ? true : false;

        $conditions = [];
        $messages = [];

        if($page_personal){
            $conditions = [
                'name' => 'required',
                'email' => 'required|email',
                'address' => 'required',
                'state_id' => 'required|numeric|gt:0',
                'district_id' => 'required',
                'ward_id' => 'required'
            ];

            $messages = [
                'name.required'  => trans($prefix_errors_trans . 'name') ,
                'email.required' => trans($prefix_errors_trans . 'email'),
                'email.email'    => trans($prefix_errors_trans . 'email_format'),
                'address.required'        => trans($prefix_errors_trans . 'address'),
                'state_id.required'    => trans($prefix_errors_trans . 'state_id'),
                'state_id.gt'  => trans($prefix_errors_trans . 'state_id'),
                'district_id.required'    => trans($prefix_errors_trans . 'district_id'),
                'ward_id.required'    => trans($prefix_errors_trans . 'ward_id')
            ];
        }

        if(empty($inputs['id']) && $page_personal){
            $conditions['email'] = 'required|email|unique:partners,email';
            $messages['email.unique'] = trans($prefix_errors_trans . 'email_exists');
        }

        if ($hasFile && $page_personal) {
            $conditions['avatar'] = 'mimes:jpeg,png,jpg|max:1024';
            $messages['avatar'] = trans($prefix_errors_trans . 'avatar');
        }

        $validator = Validator::make($request->all(),
            $conditions,
            $messages
        );

        $passes = $validator->passes();
        $partner = !empty($id) ? Partner::where('id', $id)->first() : new Partner();
        $toastr = trans($prefix_errors_trans. 'header');

        if($passes){
            $toastr = !empty($id) ? trans($prefix_success_trans . 'edit') : trans($prefix_success_trans . 'add');
            $partner->user_id = Auth::user()->id;
            foreach($inputs as $key => $val){
                if($key != 'page')
                    $partner->$key = $val;
            }
            $partner->save();

            if ($hasFile) {
                $file = $request->avatar;
                $image_path = config('partner.image.thumb');
                $partner->avatar = $upload->doUpload($image_path, $file, md5($partner->id), [250, 250]);
                $partner->save();
            }
        }
        $errors = $validator->errors();
        return response()->json([
            'success' => $passes,
            'errors' => $errors,
            'toastr' => $toastr,
            'partner' => $partner,
            'inputs' => $inputs
        ]);
    }

    function processSelectPartner(Request $request){
        $inputs = $request->except(['_token']);
        $term = $inputs['term'];
        $partner = $this->partner->get_partner($term);
        if($partner){
            $results[] = [
                'id' => $partner->id,
                'name' => $partner->name
            ];
            return response()->json([
                'success' => true,
                'results' => $results
            ]);
        }
    }

}
