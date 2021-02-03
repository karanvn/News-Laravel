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

class EvaluateController extends SiteController
{
    function __construct()
    {
        $this->evaluate = new Evaluate();
        $this->image = new EvaluateImage();
        $this->up = new Upload();
    }

    function list(Request $request){
        $number = 10;
        $request->request->add(['limit' =>$number]); 
        $data = $this->evaluate->get_evatuates($request->all());
        return view('Evaluate::listadmin',[
            'datas' => $data,
            'status' =>@$request->status,
            'id' =>@$request->id
        ]);
    }
    function editevaluate($id){
        $data = $this->evaluate->get_evatuates(['id' => $id])[0];
        if($data==null){
            return redirect()->back();
        }
        $data->changestatus();
        return redirect()->back();
    }
    function editreviewproduct($id){
      $data = $this->evaluate->get_evatuates(['id' => $id])[0];
        if($data->review == 'A'){
            $data->review = 'D';
        }else{
            $data->review = 'A';
        }
        $data->save();
        return redirect()->back()->with(['success' => 'Đã chỉnh sửa thành công']);
    }
}