<?php


namespace App\Modules\Location\Controllers;

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Libraries\PExcel;

use Illuminate\Support\Facades\Auth;

use App\Modules\Location\Models\State;
use App\Modules\Location\Models\District;
use App\Modules\Location\Models\Ward;
use App\Exports\ExLocation;
use Maatwebsite\Excel\Facades\Excel;
use Cart;
class AjaxController extends SiteController
{

    function __construct()
    {
        $this->state = new State();
        $this->district = new District();
        $this->ward = new Ward();
    }

    function loadStates(){
        $states = $this->state->get_states(['status' => 'A', 'orderBy' => ['name', 'asc']]);
        return response()->json([
            'success' => true,
            'data' => $states
        ]);
    }

    function loadDistricts($state_id = 0){
        if(!empty($state_id)){
            $districts = $this->district->get_districts(['status' => 'A', 'state_id' => $state_id, 'orderBy' => ['name', 'asc']]);
            return response()->json([
                'success' => true,
                'data' => $districts
            ]);
        }else{
            return response()->json([
                'success' => false,
                'data' => []
            ]);
        }
    }

    function loadWards($district_id = 0){
        if(!empty($district_id)){
            $wards = $this->ward->get_wards(['status' => 'A', 'district_id' => $district_id, 'orderBy' => ['name', 'asc']]);
            return response()->json([
                'success' => true,
                'data' => $wards
            ]);
        }else{
            return response()->json([
                'success' => false,
                'data' => []
            ]);
        }
    }

    function processState(Request $request) {
        $inputs = $request->except(['_token']);
        $state_id = !empty($inputs['state_id']) ? $inputs['state_id'] : 0;
        $prefix_errors_trans = 'Location::state.add.form.errors.';
        $prefix_success_trans = 'Location::state.add.form.success.';

        $conditions = [
            'name' => 'required'
        ];

        $messages = [
            'name.required'  => trans($prefix_errors_trans . 'name')
        ];

        $validator = Validator::make($request->all(),
            $conditions,
            $messages
        );

        $passes = $validator->passes();
        $state = !empty($state_id) ? $this->state->get_state($state_id) : new State();
        $toastr = trans($prefix_errors_trans. 'header');

        if($passes){
            $toastr = !empty($state_id) ? trans($prefix_success_trans . 'edit') : trans($prefix_success_trans . 'add');
            $state->user_id = Auth::user()->id;
            foreach($inputs as $key => $val){
                $state->$key = $val;
            }
            $state->save();
        }
        $errors = $validator->errors();
        return response()->json([
            'success' => $passes,
            'errors' => $errors,
            'toastr' => $toastr,
            'state' => $state,
            'inputs' => $inputs
        ]);
    }

    function processDistrict(Request $request) {
        $inputs = $request->except(['_token']);
        $district_id = !empty($inputs['district_id']) ? $inputs['district_id'] : 0;
        $prefix_errors_trans = 'Location::district.add.form.errors.';
        $prefix_success_trans = 'Location::district.add.form.success.';

        $conditions = [
            'name' => 'required',
            'state_id' => 'required|numeric|gt:0'
        ];

        $messages = [
            'name.required'  => trans($prefix_errors_trans . 'name'),
            'state_id.required'  => trans($prefix_errors_trans . 'state_id'),
            'state_id.gt'  => trans($prefix_errors_trans . 'state_id')
        ];

        $validator = Validator::make($request->all(),
            $conditions,
            $messages
        );

        $passes = $validator->passes();
        $district = !empty($district_id) ? $this->district->get_district($district_id) : new District();
        $toastr = trans($prefix_errors_trans. 'header');

        if($passes){
            $toastr = !empty($district_id) ? trans($prefix_success_trans . 'edit') : trans($prefix_success_trans . 'add');
            $district->user_id = Auth::user()->id;
            foreach($inputs as $key => $val){
                $district->$key = $val;
            }
            $district->save();
        }
        $errors = $validator->errors();
        return response()->json([
            'success' => $passes,
            'errors' => $errors,
            'toastr' => $toastr,
            'district' => $district,
            'inputs' => $inputs
        ]);
    }

    function processWard(Request $request) {
        $inputs = $request->except(['_token']);
        $ward_id = !empty($inputs['ward_id']) ? $inputs['ward_id'] : 0;
        $prefix_errors_trans = 'Location::ward.add.form.errors.';
        $prefix_success_trans = 'Location::ward.add.form.success.';

        $conditions = [
            'name' => 'required',
            'state_id' => 'required|numeric|gt:0',
            'district_id' => 'required|numeric|gt:0'
        ];

        $messages = [
            'name.required'  => trans($prefix_errors_trans . 'name'),
            'state_id.required'  => trans($prefix_errors_trans . 'state_id'),
            'state_id.gt'  => trans($prefix_errors_trans . 'state_id'),
            'district_id.required'  => trans($prefix_errors_trans . 'district_id'),
            'district_id.gt'  => trans($prefix_errors_trans . 'district_id')
        ];

        $validator = Validator::make($request->all(),
            $conditions,
            $messages
        );

        $passes = $validator->passes();
        $ward = !empty($ward_id) ? $this->ward->get_ward($ward_id) : new Ward();
        $toastr = trans($prefix_errors_trans. 'header');

        if($passes){
            $toastr = !empty($ward_id) ? trans($prefix_success_trans . 'edit') : trans($prefix_success_trans . 'add');
            $ward->user_id = Auth::user()->id;
            foreach($inputs as $key => $val){
                if($key != 'state_id')
                    $ward->$key = $val;
            }
            $ward->save();
        }
        $errors = $validator->errors();
        return response()->json([
            'success' => $passes,
            'errors' => $errors,
            'toastr' => $toastr,
            'ward' => $ward,
            'inputs' => $inputs
        ]);
    }
    public function shipPing($ward){
        $shipPing = '0';
        $nameLocation = '';
        if(!empty($ward)){
            $dataWard =  $this->ward->get_ward($ward);
            $nameLocation = $nameLocation.''.$dataWard->name;
            if(!empty($data->shipping)){
                $shipPing = $dataWard->shipping;
            }else{
                $dataDistric = $this->district->get_district($dataWard->district_id);
               
                if(!empty($dataDistric->shipping)){
                    $shipPing = $dataDistric->shipping;
                }else{
                    $dataStates = $this->state->get_state($dataDistric->state_id);
                    $shipPing = $dataStates->shipping;
                }
            }

            // thông tin tên địa chỉ
            $dataDistric = $this->district->get_district($dataWard->district_id);
            $nameLocation = $nameLocation.', '.$dataDistric->name;
            $dataStates = $this->state->get_state($dataDistric->state_id);
            $nameLocation = $nameLocation.', '.$dataStates->name;
        }

        // lấy tên vị tri

        // free ship
        $total = Cart::getSubTotal($totalItems = false);
        if(!empty($dataStates->free_ship) && (@$dataStates->free_ship <= $total)){
            $shipPing = '0';
        }
       


            return response()->json([
                'shipPing' => !empty($shipPing) ? $shipPing : '0',
                'nameLocation' => $nameLocation
            ]);
    }
    public function DistrictloadFilter($id){
        $districts = $this->district->get_districts([
            'status' => 'A',
            'state_id' => $id,
            'orderBy' => ['name', 'asc']
            ]);

            $html = view('Location::loadFilter.load',[
                'districts' => $districts,
                'type' => 'districts'
                ])->render();
        return response()->json([
            'data' => $html
        ]);
        
    }
    public function wardloadFilter($id){
        $wards = $this->ward->get_wards([
            'status' => 'A', 
            'district_id' => $id, 
            'orderBy' => ['name', 'asc']
            ]);
      
        $district = $this->district->get_district($id);

            $html = view('Location::loadFilter.load',[
                'wards' => $wards,
                'type' => 'wards',
                'states' => @$district->state_id
                ])->render();
        return response()->json([
            'data' => $html
        ]);
        
    }
    public function statesloadFilter(){
        $states = $this->state->get_states(['status' => 'A', 'orderBy' => ['name', 'asc']]);
        $html = view('Location::loadFilter.load',[
            'states' => $states,
            'type' => 'states'
            ])->render();
        return response()->json([
            'data' => $html
        ]);
    }
    function postExcelShip(Request $request){
        $inputs = $request->except(['_token']);

        $conditions = [
            'file_excel' => 'required|mimes:xls,xlsx'
        ];

        $messages = [
            'file_excel.required'  => 'Vụi lòng nhập file Excel',
            'file_excel.mimes'  => '-------------'
        ];

        $validator = Validator::make($request->all(),
            $conditions,
            $messages
        );

        $passes = $validator->passes();
        $toastr = 'Thất bại';
        $success = false;
        $html = '';
        $excel = new PExcel();
        if($passes){
            $success = true;
            $file = $request->file_excel;
            $objPHPExcel = $excel->load($file);
            $currentSheet = $objPHPExcel->getSheet(0);
            $allRow = $currentSheet->getHighestRow();
            $products = [];
            $total = 0;
            $total_success = 0;
            for($currentRow = 2;$currentRow <= $allRow;$currentRow++) {
                $id = (int)get_format_value($currentSheet->getCell('A' . $currentRow)->getValue());
                $ship = get_format_value($currentSheet->getCell('B' . $currentRow)->getValue());
                if($request->type == 'states'){
                    $location = $this->state->get_state($id);
                }
                if($request->type == 'districts'){
                    $location = $this->district->get_district($id);
                }
                if($request->type == 'wards'){
                    $location = $this->ward->get_ward($id);
                }
                $total += 1;
                if(!$location){
                }else{
                        $total_success += 1;
                        $cls = 'success';
                    
                    $points[] = [
                        'name' => @$location->name,
                        'id' => $id,
                        'ship'  => $ship
                    ];
                }
            } $toastr = trans('Auth::customer.point.excel.success');
            $html =  view('Location::excel.excelSee',['points' => @$points,'total_success'=> $total_success, 'total' => $total,'type' => $request->type])->render();
        }else{
            $success = false;
            $toastr = trans('Auth::customer.point.excel.false');
        }
        $errors = $validator->errors();
        return response()->json([
            'success' => $success,
            'errors' => $errors,
            'toastr' => $toastr,
            'html' => $html
        ]);
    }
    function postExcelShipCom(Request $request){
        $inputs = $request->except(['_token']);
        $ids = @$inputs['id'];
        $ships = @$inputs['ship'];
        $type = @$inputs['type'];
        if(!empty($ids)){
          
            foreach($ids as $index => $id){
                if($type == 'states'){
                    $updateShip =  $this->state->get_state($id);
               } 
               if($type == 'districts'){
                $updateShip =  $this->district->get_district($id);
                } 
                if($type == 'wards'){
                    $updateShip =  $this->ward->get_ward($id);
                }
                
                if($updateShip){
                    $updateShip->shipping = @$ships[$index];
                    $updateShip->save();
                }
            }
           }
        return response()->json([
            'success' => true,
            'toastr' => 'Cập nhật thành công'
        ]);
       
    }
    function downloadDemoExcel($type){
        
        $fileName = 'exShipDemo.xlsx'; 
   
        $datas = '';
        if($type == 'states'){
            $datas = $this->state->get_states(['status' => 'A', 'orderBy' => ['name', 'asc']]);
            foreach($datas as $data){
                $name[] = $data['name'];
                $id[] = $data['state_id'];
            }
        }
        if($type == 'districts'){
            $datas = $this->district->get_districts(['status' => 'A', 'orderBy' => ['state_id', 'asc']]);
            foreach($datas as $data){
                $dbParent = $this->state->get_state($data->state_id);
                $name[] = $data['name'].'-'.@$dbParent->name;
                $id[] = $data['district_id'];
            }
        }
        if($type == 'wards'){
            $datas = $this->ward->get_wards(['status' => 'A', 'orderBy' => ['district_id', 'asc']]);
            foreach($datas as $data){
                if(!empty($$data->district_id)){
                    $dbParent = $this->district->get_district($data->district_id);
                    if(!empty($dbParent->state_id)){
                        $dbParentTwo = $this->state->get_state($dbParent->state_id);
                    }
                    }
               
                $name[] = $data['name'].'-'.@$dbParent->name.'-'.@$dbParentTwo['name'];
                $id[] = $data['ward_id'];
            }
        }

        $datas['subName'] = $name;
        $datas['subId'] = $id;
        
        ob_end_clean(); 
        ob_start();
        return Excel::download(new ExLocation($datas), $fileName);
    }
  
}
