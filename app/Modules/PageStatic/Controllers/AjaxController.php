<?php


namespace App\Modules\PageStatic\Controllers;

use App\Http\Controllers\SiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Libraries\Upload;
use App\Libraries\Func;
use App\Modules\PageStatic\Models\PageStatic;
use App\Modules\Log\Libraries\LibActivityLog;


class AjaxController extends SiteController
{
    function __construct()
    {
        $this->pageStatic = new PageStatic();
        $this->log = new LibActivityLog();
    }
    function processPageStatic(Request $request) {
        $inputs      = $request->except(['_token']);
        $upload      = new Upload();
        $storageFile = new Func();
        $hasFile = $request->hasFile('image') ? true : false;
        $id = !empty($inputs['id']) ? $inputs['id'] : 0;
        $published_start = strtotime($inputs['published_start']);
        $published_end = strtotime($inputs['published_end']);
        $prefix_errors_trans = 'PageStatic::page_static.add.form.errors.';
        $prefix_success_trans = 'PageStatic::page_static.add.form.success.';

        $conditions = [
            'title' => 'required'
        ];

        $messages = [
            'title.required'  => trans($prefix_errors_trans . 'title')
        ];

        if($published_start > $published_end){
            $conditions['published_start'] = 'required';
            $messages['published_start.required'] = trans($prefix_errors_trans . 'published_start');

            $conditions['published_end'] = 'required|';
            $messages['published_end.required'] = trans($prefix_errors_trans . 'published_end');
        }

        if (empty($id)) {
            $conditions['image'] = 'required|mimes:jpeg,png,jpg|max:1024';
            $messages['image.required'] = trans($prefix_errors_trans . 'image');
        }

        $validator = Validator::make($request->all(),
            $conditions,
            $messages
        );

        $passes = $validator->passes();
        $page = !empty($id) ? $this->pageStatic->get_page($id) : new PageStatic();
        $object = clone $page;
        $toastr = trans($prefix_errors_trans. 'header');

        if($passes){
            $toastr = !empty($id) ? trans($prefix_success_trans . 'edit') : trans($prefix_success_trans . 'add');
            $user_id = Auth::user()->id;
            if(empty($id))
                $page->user_id = Auth::user()->id;
            foreach($inputs as $key => $val){
                $page->$key = $val;
            }

            if ($hasFile) {
                $file = $request->image;
                $image_path = get_page_static_path_image();
                $page->image = $upload->doUpload($image_path, $file, md5($page->id), []);
                $page->save();
            }
            
            $page->save();

            $link_file = $page->slug.'.html';
            $rootPath  = get_path_page_static_html();
            File::isDirectory($rootPath) or File::makeDirectory($rootPath, 0777, true, true);
            $storageFile->storageFile($page->content, $rootPath, $link_file);

        }
        $errors = $validator->errors();
        return response()->json([
            'success' => $passes,
            'errors'  => $errors,
            'toastr'  => $toastr,
            'page'    => $page,
            'inputs'  => $inputs
        ]);
    }

    function processSortBanner(Request $request) {
        $inputs = $request->except(['_token']);
        $ids = @$inputs['ids'];
        if(!empty($ids)){
            foreach($ids as $index => $id){
                $banner = $this->pageStatic->get_banner($id) ;
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
