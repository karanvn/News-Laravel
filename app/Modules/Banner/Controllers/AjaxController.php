<?php


namespace App\Modules\Banner\Controllers;

use App\Http\Controllers\SiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Libraries\Upload;
use App\Modules\Product\Models\Category;
use  App\Modules\Blog\Models\BlogCategory;
use App\Modules\Banner\Models\Banner;
use WebPConvert\WebPConvert;
use App\Modules\Log\Libraries\LibActivityLog;
use App\Modules\Product\Models\Collection;



class AjaxController extends SiteController
{
    function __construct()
    {
        $this->banner = new Banner();
        $this->log = new LibActivityLog();
        $this->Category = new Category();
        $this->BlogCategory = new BlogCategory();
        $this->collection = new Collection();
    }
    function processBanner(Request $request) {
        $inputs = $request->except(['_token']);
        $upload = new Upload();
        $hasFile = $request->hasFile('avatar') ? true : false;
        $id = !empty($inputs['id']) ? $inputs['id'] : 0;
        $type = $inputs['type'];
        $published_start = strtotime($inputs['published_start']);
        $published_end = strtotime($inputs['published_end']);
        $prefix_errors_trans = 'Banner::banner.add.form.errors.';
        $prefix_success_trans = 'Banner::banner.add.form.success.';

        $conditions = [
            'name' => 'required'
        ];

        $messages = [
            'name.required'  => trans($prefix_errors_trans . 'name')
        ];

        if($published_start > $published_end){
            $conditions['published_start'] = 'required';
            $messages['published_start.required'] = trans($prefix_errors_trans . 'published_start');

            $conditions['published_end'] = 'required|';
            $messages['published_end.required'] = trans($prefix_errors_trans . 'published_end');
        }

        if($type == 'CATEGORY'){
            $conditions['object_id'] = 'required|exists:categories,id';
        }elseif($type == 'PRODUCT'){
            $conditions['object_id'] = 'required|exists:products,product_id';
        }

        if (empty($id)) {
            $conditions['avatar'] = 'required|mimes:jpeg,png,jpg|max:1024';
            $messages['avatar.required'] = trans($prefix_errors_trans . 'avatar');
        }

        $validator = Validator::make($request->all(),
            $conditions,
            $messages
        );

        $passes = $validator->passes();
        $banner = !empty($id) ? $this->banner->get_banner($id) : new Banner();
        $object = clone $banner;
        $toastr = trans($prefix_errors_trans. 'header');

        if($passes){
            $toastr = !empty($id) ? trans($prefix_success_trans . 'edit') : trans($prefix_success_trans . 'add');
            $user_id = Auth::user()->id;
            if(empty($id))
                $banner->user_id = Auth::user()->id;

                $dateNow = date('Y-m-d H:i:s');
                $dateNow = substr($dateNow,0, 14);
                $dateInputB =  substr($inputs['published_end'],0, 14);
                if($dateNow == $dateInputB){
                    $inputs['published_end'] = date('Y-m-d H:i:s',strtotime("06/10/2030 19:00:02"));
                }
            foreach($inputs as $key => $val){
                $banner->$key = $val;
            }
            if(!empty($request->showhome)){
                $banner->showhome = $request->showhome;
            }

            if(empty($id))
                $banner->position = 0;

            $banner->save();
            
            if ($hasFile) {
                $file = $request->avatar;
                $image_path = get_banner_path_image();
                $banner->avatar = $upload->doUpload($image_path, $file, md5($banner->id), []);
                $banner->save();


                // webp image banner
                $strrposImg = strrpos($banner->avatar,'.');
                $nameImg = substr($banner->avatar, 0, $strrposImg);
                $options = [];
    
                  // webp img
                $sourceWebp = 'storage/'.$image_path.'/'.$banner->avatar;
                $destination ='storage/'.$image_path.'/'.$nameImg.'.webp';
                WebPConvert::convert($sourceWebp, $destination, $options);
            }

            $object->obj_id = $banner->id;
            $object->user_id = $user_id;
            $object->empty = !empty($id) ? false : true;
            $this->log->bannerLog([
                'object' => $object,
                'data' => $inputs
            ]);

        }
        $errors = $validator->errors();
        return response()->json([
            'success' => $passes,
            'errors' => $errors,
            'toastr' => $toastr,
            'banner' => $banner,
            'inputs' => $inputs
        ]);
    }
    function objectAddBanner($id=''){
        $datas = '';
        if($id=='CATEGORY'){
            $datas = $this->Category->get_categories(['status' =>'A']);
        }
        if($id=='CATEGORYBLOG'){
            $datas = $this->BlogCategory->get_categories(['status' =>'A']);
        }
        if($id=='COLLECTION'){
            $datas =  $this->collection->get_collections(['status' =>'A']);
        }
        return response()->json([
            'html' =>  view('Banner::banner.objectAddBanner',['datas' => $datas,'type' => $id])->render()
        ]);

    }

    function processSortBanner(Request $request) {
        $inputs = $request->except(['_token']);
        $ids = @$inputs['ids'];
        if(!empty($ids)){
            foreach($ids as $index => $id){
                $banner = $this->banner->get_banner($id) ;
                if($banner){
                    $banner->position = $index + 1;
                    $banner->save();
                }
            }
            return response()->json([
                'success' => true,
                'ids' => $ids
            ]);
        }
    }
}
