<?php


namespace App\Modules\Mail\Controllers;

use App\Http\Controllers\SiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Modules\Mail\Models\Block;
use App\Modules\Mail\Models\BlockTpl;
use App\Modules\Mail\Models\Tpl;

class AjaxMailController extends SiteController
{
    function __construct()
    {
        $this->block = new Block();
        $this->tpl = new Tpl();
        $this->block_tpl = new BlockTpl();
    }

    function processBlock(Request $request) {
        $inputs = $request->except(['_token']);
        $block_id = !empty($inputs['block_id']) ? $inputs['block_id'] : 0;
        $prefix_errors_trans = 'Mail::mail.block.add.form.errors.';
        $prefix_success_trans = 'Mail::mail.block.add.form.success.';

        $conditions = [
            'name' => 'required',
            'html' => 'required'
        ];

        $messages = [
            'name.required'  => trans($prefix_errors_trans . 'name') ,
            'html.required'  => trans($prefix_errors_trans . 'html') ,
        ];

        $validator = Validator::make($inputs,
            $conditions,
            $messages
        );

        $passes = $validator->passes();
        $block = !empty($block_id) ? $this->block->get_block($block_id) : $this->block;
        $toastr = trans($prefix_errors_trans. 'header');

        if($passes){
            $toastr = !empty($block_id) ? trans($prefix_success_trans . 'edit') : trans($prefix_success_trans . 'add');
            if(empty($block_id))
                $block->user_id = $this->get_auth()->id;

            foreach($inputs as $key => $val){
                $block->$key = $val;
            }

            $block->save();
            //$this->storageFile($block->html, $block->file_name);
        }
        $errors = $validator->errors();
        return response()->json([
            'success' => $passes,
            'errors' => $errors,
            'toastr' => $toastr,
            'block' => $block,
            'inputs' => $inputs
        ]);
    }


    function processTpl(Request $request) {
        $inputs = $request->except(['_token']);
        $tpl_id = !empty($inputs['tpl_id']) ? $inputs['tpl_id'] : 0;
        $prefix_errors_trans = 'Mail::mail.tpl.add.form.errors.';
        $prefix_success_trans = 'Mail::mail.tpl.add.form.success.';
        $block_ids = @$inputs['block_ids'];
        $type = @$inputs['type'];

        $conditions = [
            'name' => 'required',
            'subject' => 'required',
        ];

        $messages = [
            'name.required'  => trans($prefix_errors_trans . 'name') ,
            'subject.required'  => trans($prefix_errors_trans . 'subject') ,
        ];

        if(empty($block_ids)){
            $conditions['block-ids'] = 'required';
            $messages['block-ids.required'] = trans($prefix_errors_trans . 'block-ids');
        }

        $flag_type = 0;
        $tpl = $this->tpl->get_by_type_template($type);
        if(empty($tpl_id)){
            if(!empty($tpl)){
                $flag_type ++;
            }
        }else{
            if(!empty($tpl) && $tpl->tpl_id != $tpl_id){
                $flag_type ++;
            }
        }

        if($flag_type > 0){
            $conditions['type'] = 'required';
            $messages['type.required'] = trans($prefix_errors_trans . 'type');
            $inputs['type'] = "";
        }

        $validator = Validator::make($inputs,
            $conditions,
            $messages
        );

        $passes = $validator->passes();
        $tpl = !empty($tpl_id) ? $this->tpl->get_template($tpl_id) : $this->tpl;
        $toastr = trans($prefix_errors_trans. 'header');

        if($passes){
            $toastr = !empty($id) ? trans($prefix_success_trans . 'edit') : trans($prefix_success_trans . 'add');
            if(empty($tpl_id))
                $tpl->user_id = $this->get_auth()->id;

            foreach($inputs as $key => $val){
                if($key != 'block_ids')
                    $tpl->$key = $val;
            }

            $tpl->save();

            $block_ids = array_filter($block_ids);
            $this->block_tpl->delete(['tpl_id' => $tpl->tpl_id]);
            foreach($block_ids as $block_id){
                $blockTpl = new BlockTpl();
                $blockTpl->block_id = $block_id;
                $blockTpl->tpl_id = $tpl->tpl_id;
                $blockTpl->save();
            }
        }
        $errors = $validator->errors();
        return response()->json([
            'success' => $passes,
            'errors' => $errors,
            'toastr' => $toastr,
            'tpl' => $tpl,
            'inputs' => $inputs
        ]);
    }

    function processTplAddBlock(Block $block){
        if($block){
            $html = view('Mail::tpl.item', ['block' => $block])->render();
            return response()->json([
                'success' => true,
                'html' => $html
            ]);
        }
    }

    function storageFile($html, $file_name){
        $rootPath = get_path_html();
        if(!empty($file_name)){
            $client = Storage::createLocalDriver(['root' => $rootPath]);
            $client->put($file_name, $html);
        }
    }
}
