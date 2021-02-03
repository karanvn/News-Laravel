<?php

namespace App\Modules\Log\Libraries;

use App\Modules\Auth\Models\Shipping;
use App\Modules\Banner\Models\Banner;
use Illuminate\Support\Str;
use App\Modules\Branch\Models\Branch;
use App\Modules\Location\Models\District;
use App\Modules\Location\Models\State;
use App\Modules\Location\Models\Ward;
use Illuminate\Support\Facades\Storage;
use App\Modules\Log\Models\ActivityLog;
use App\Modules\Rule\Models\Rule;
use App\Modules\Rule\Models\MRole;
use App\Modules\Rule\Models\MPermission;
use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class LibActivityLog
{
    function __construct()
    {
        $this->permission = new MPermission();
        $this->role       = new MRole();
        $this->rule       = new Rule();
        $this->branch     = new Branch();
        $this->state      = new State();
        $this->district   = new District();
        $this->ward       = new Ward();
    }

    function objectLogs($log){
        $type = $log->type;
        $object_id = $log->object_id;
        $sub_id = @$log->sub_id;
        $results = [];
        if(!empty($type) && !empty($object_id)){
            switch($type){
                case 'ORDER':
                    $results['route'] = route('OrderEdit', [$object_id.'#tab-history']);
                    $results['title'] = ' #ĐH'.fm_zeros($object_id, 6);
                break;

                case 'PRODUCT':
                   
                break;

                case 'CATEGORY':
              
                break;

                case 'BRANCH':
                    $model = new Branch();
                    $branch = $model->get_branch($object_id);
                    $results['route'] = route('BranchEdit', [$object_id]);
                    $results['title'] = !empty($branch) ? $branch->name : fm_zeros($object_id, 6);
                break;
            
                case 'FEATURE':
                 
                break;

                case 'CUSTOMER':
                    $model = empty($sub_id) ? new User() : new Shipping();
                    $user = empty($sub_id) ? $model->get_user($object_id) : $model->get_shipping($sub_id);
                    $results['route'] = route('CustomerEdit', [$object_id, 'history']);
                    $results['title'] = !empty($user) ? $user->name : fm_zeros($object_id, 6);
                break;

                case 'ADMIN':
                    $model = new User();
                    $admin = $model->get_user($object_id);
                    $results['route'] = route('AdminEdit', [$object_id, 'history']);
                    $results['title'] = !empty($admin) ? $admin->name : fm_zeros($object_id, 6);
                break;

                case 'BANNER':
                    $model = new Banner();
                    $banner = $model->get_banner($object_id);
                    $results['route'] = route('BannerEdit', [$object_id]);
                    $results['title'] = !empty($banner) ? $banner->name : fm_zeros($object_id, 6);
                break;

                case 'RULE':
                    $model = new Rule();
                    $rule = $model->get_rule($object_id);
                    $results['route'] = route('RuleEdit', [$object_id]);
                    $results['title'] = !empty($rule) ? $rule->name : fm_zeros($object_id, 6);
                break;

                case 'PERMISSION':
                    $model = new MPermission();
                    $permission = $model->get_permission($object_id);
                    $results['route'] = route('PermissionEdit', [$object_id]);
                    $results['title'] = !empty($permission) ? $permission->name : fm_zeros($object_id, 6);
                break;

                case 'ROLE':
                    $model = new MRole();
                    $role = $model->get_role($object_id);
                    $results['route'] = route('RoleEdit', [$object_id]);
                    $results['title'] = !empty($role) ? $role->name : fm_zeros($object_id, 6);
                break;
            }
        }

        return $results;
    }

    function customerLog($params = []){
        $data = $params['data'];
        $object = $params['object'];
        $statuses = get_log_statuses();
        $genders = get_log_genders();
        $titles = get_log_titles()['customer'];
        $data_logs = [];
        foreach($data as $key => $value){
            if(isset($titles[$key])){
                $title = $titles[$key];
                if($object->empty){
                    $action = 'create_customer';
                    if($key == 'status'){
                        $data_logs[$title] = $statuses[$value];
                    }elseif($key == 'gender'){
                        $data_logs[$title] = $genders[$value];
                    }else{
                        $data_logs[$title] = $value;
                    }
                }else{
                    $action = 'update_customer';
                    if(@$object->$key != $value){
                        if($key == 'status'){
                            $data_logs[$title] = @$statuses[$object->$key] . ' -> ' . @$statuses[$value];
                        }elseif($key == 'gender'){
                            $data_logs[$title] = @$genders[$object->$key] . ' -> ' . @$genders[$value];
                        }else{
                            $data_logs[$title] = $object->$key . ' -> ' . $value;
                        }
                    }
                }
            }
        }

        if(!empty($data_logs)){
            $actLog = new ActivityLog();
            $actLog->type = 'CUSTOMER';
            $actLog->action = $action;
            $actLog->object_id = $object->object_id;
            $actLog->user_id = $object->user_id;
            $actLog->sub_id = 0;
            $actLog->data = serialize($data_logs);
            $actLog->save();
        }

    }


    function adminLog($params = []){
        $data = $params['data'];
        $object = $params['object'];
        $statuses = get_log_statuses();
        $genders = get_log_genders();
        $titles = get_log_titles()['admin'];
        $data_logs = [];
        foreach($data as $key => $value){
            if(isset($titles[$key])){
                $title = $titles[$key];
                if($object->empty){
                    $action = 'create_admin';
                    if($key == 'status'){
                        $data_logs[$title] = $statuses[$value];
                    }elseif($key == 'gender'){
                        $data_logs[$title] = $genders[$value];
                    }else{
                        $data_logs[$title] = $value;
                    }
                }else{
                    $action = 'update_admin';
                    if(@$object->$key != $value){
                        if($key == 'status'){
                            $data_logs[$title] = @$statuses[$object->$key] . ' -> ' . @$statuses[$value];
                        }elseif($key == 'gender'){
                            $data_logs[$title] = @$genders[$object->$key] . ' -> ' . @$genders[$value];
                        }else{
                            $data_logs[$title] = $object->$key . ' -> ' . $value;
                        }
                    }
                }
            }
        }

        if(!empty($data_logs)){
            $actLog = new ActivityLog();
            $actLog->type = 'ADMIN';
            $actLog->action = $action;
            $actLog->object_id = $object->object_id;
            $actLog->user_id = $object->user_id;
            $actLog->sub_id = 0;
            $actLog->data = serialize($data_logs);
            $actLog->save();
        }

    }


    function shippingLog($params = []){
        $data = $params['data'];
        $object = $params['object'];
        $statuses = get_log_statuses();
        $titles = get_log_titles()['shipping'];
        $data_logs = [];
        foreach($data as $key => $value){
            if(isset($titles[$key])){
                $title = $titles[$key];
                if($object->empty){
                    $action = 'create_shipping';
                    if($key == 'status'){
                        $data_logs[$title] = $statuses[$value];
                    }elseif($key == 'state_id'){
                        $data_logs[$title] = @$this->state->get_state($value)->name;
                    }elseif($key == 'district_id'){
                        $data_logs[$title] = @$this->district->get_district($value)->name;
                    }elseif($key == 'ward_id'){
                        $data_logs[$title] = @$this->ward->get_ward($value)->name;
                    }else{
                        $data_logs[$title] = $value;
                    }
                }else{
                    $action = 'update_shipping';
                    if(@$object->$key != $value){
                        if($key == 'status'){
                            $data_logs[$title] = @$statuses[$object->$key] . ' -> ' . @$statuses[$value];
                        }elseif($key == 'state_id'){
                            $before_state = @$object->state()->first()->name;
                            $after_state = @$this->state->get_state($value)->name;
                            $data_logs[$title] = $before_state .' -> '. $after_state;
                        }elseif($key == 'district_id'){
                            $before_district = @$object->district()->first()->name;
                            $after_district = @$this->district->get_district($value)->name;
                            $data_logs[$title] = $before_district .' -> '. $after_district;
                        }elseif($key == 'ward_id'){
                            $before_ward = @$object->ward()->first()->name;
                            $after_ward = @$this->ward->get_ward($value)->name;
                            $data_logs[$title] = $before_ward .' -> '. $after_ward;
                        }else{
                            $data_logs[$title] = $object->$key . ' -> ' . $value;
                        }
                    }
                }
            }
        }

        if(!empty($data_logs)){
            $actLog = new ActivityLog();
            $actLog->type = 'CUSTOMER';
            $actLog->action = $action;
            $actLog->object_id = $object->object_id;
            $actLog->user_id = $object->user_id;
            $actLog->sub_id = $object->sub_id;
            $actLog->data = serialize($data_logs);
            $actLog->save();
        }

    }

    function ruleLog($params = []){
        $data = $params['data'];
        $object = $params['object'];
        $statuses = get_log_statuses();
        $titles = get_log_titles()['rule'];
        $data_logs = [];
        foreach($data as $key => $value){
            if(isset($titles[$key])){
                $title = $titles[$key];
                if($object->empty){
                    if($key == 'status'){
                        $data_logs[$title] = $statuses[$value];
                    }else{
                        $data_logs[$title] = $value;
                    }
                }else{
                    if(@$object->$key != $value){
                        if($key == 'status'){
                            $data_logs[$title] = @$statuses[$object->$key] . ' -> ' . @$statuses[$value];
                        }else{
                            $data_logs[$title] = $object->$key . ' -> ' . $value;
                        }
                    }
                }
            }
        }

        if(!empty($data_logs)){
            $actLog = new ActivityLog();
            $actLog->type = 'RULE';
            $actLog->action = $object->empty ? 'create_rule' : 'update_rule';
            $actLog->object_id = $object->object_id;
            $actLog->user_id = $object->user_id;
            $actLog->data = serialize($data_logs);
            $actLog->save();
        }
    }


    function roleLog($params = []){
        $data = $params['data'];
        $role = $params['object'];
        $titles = get_log_titles()['role'];
        $data_logs = [];
        $has_permission = false;
        $permissions = [];
        foreach($data as $key => $value){
            if(isset($titles[$key])){
                $title = $titles[$key];
                if($role->empty){
                    if($key == 'permission_ids'){
                        $permission_ids = $value;
                        $add_permissions = [];
                        foreach($permission_ids as $permission_id){
                            $permission = $this->permission->get_permission($permission_id);
                            if($permission){
                                $add_permissions[] = $permission->name;
                            }
                        }
                        $data_logs[$title] = $titles['add_permission'] . ' : ' . implode(', ', $add_permissions);
                    }else{
                        if($key == 'rule_id'){
                            $rule = new Rule();
                            $rule = $this->rule->get_rule($value);
                            $data_logs[$title] = @$rule->name;
                        }else{
                            $data_logs[$title] = $value;
                        }
                    }
                }else{
                    $permissions = $role->permissions()->get();
                    if($key == 'permission_ids'){
                        $has_permission = false;
                        $permission_ids = $value;
                        $del_permissions = [];
                        $add_permissions = [];
                        if(count($permissions) > 0){
                            foreach($permissions as $permission){
                                if(in_array($permission->id, $permission_ids)){
                                    $index = array_search($permission->id, $permission_ids);
                                    if($index >= 0)
                                        unset($permission_ids[$index]);
                                }else{
                                    $del_permissions[] = $permission->name;
                                }
                            }
                            if(!empty($permission_ids)){
                                foreach($permission_ids as $permission_id){
                                    $permission = $this->permission->get_permission($permission_id);
                                    if($permission){
                                        $add_permissions[] = $permission->name;
                                    }
                                }
                            }

                            $all_permissions = [];
                            if(!empty($add_permissions)){
                                $all_permissions[] = $titles['add_permission'] . ' : ' . implode(', ', $add_permissions);
                            }
                            if(!empty($del_permissions)){
                                $all_permissions[] = $titles['del_permission'] . ' : ' . implode(', ', $del_permissions);
                            }
                            if(!empty($all_permissions))
                                $data_logs[$title] = implode(' | ', $all_permissions);

                        }else{
                            foreach($permission_ids as $permission_id){
                                $permission = $this->permission->get_permission($permission_id);
                                if($permission){
                                    $add_permissions[] = $permission->name;
                                }
                            }
                            $data_logs[$title] = $titles['add_permission'] . ' : ' . implode(', ', $add_permissions);
                        }

                    }else{

                        $has_permission = true;
                        if(@$role->$key != $value){
                            if($key == 'rule_id'){
                                $rule = new Rule();
                                $before = $role->rule()->get()->first();
                                $after = $rule->get_rule($value);
                                $data_logs[$title] = @$before->name . ' -> ' . $after->name;
                            }else{
                                $data_logs[$title] = $role->$key . ' -> ' . $value;
                            }
                        }
                    }
                }
            }
        }

        if($has_permission){
            if(count($permissions) > 0){
                $title = $titles['permission_ids'];
                $del_permissions = [];
                foreach($permissions as $permission){
                    $del_permissions[] = $permission->name;
                }
                $data_logs[$title] = $titles['del_permission'] . ' : ' . implode(', ', $del_permissions);
            }
        }

        if(!empty($data_logs)){
            $actLog = new ActivityLog();
            $actLog->type = 'ROLE';
            $actLog->action = $role->empty ? 'create_role' : 'update_role';
            $actLog->object_id = $role->object_id;
            $actLog->user_id = $role->user_id;
            $actLog->data = serialize($data_logs);
            $actLog->save();
        }
    }


    function permissionLog($params = []){
        $data = $params['data'];
        $permission = $params['object'];
        $data_logs = [];
        $titles = get_log_titles()['permission'];
        if($permission->empty){
            foreach($data as $key => $value){
                $title = @$titles[$key];
                if(!empty($title))
                    $data_logs[$title] = $value;
            }
        }

        if(!empty($data_logs)){
            $actLog = new ActivityLog();
            $actLog->type = 'PERMISSION';
            $actLog->action = $permission->empty ? 'create_permission' : 'update_permission';
            $actLog->object_id = $permission->object_id;
            $actLog->user_id = $permission->user_id;
            $actLog->data = serialize($data_logs);
            $actLog->save();
        }

    }


    function bannerLog($params = []){
        $data = $params['data'];
        $banner = $params['object'];
        $statuses = get_log_statuses();
        $titles = get_log_titles()['banner'];
        $data_logs = [];
        foreach($data as $key => $value){
            if(isset($titles[$key])){
                $title = $titles[$key];
                if($banner->empty){
                    if($key == 'status'){
                        $data_logs[$title] = $statuses[$value];
                    }else{
                        $data_logs[$title] = $value;
                    }
                }else{
                    if(@$banner->$key != $value){
                        if($key == 'status'){
                            $data_logs[$title] = @$statuses[$banner->$key] . ' -> ' . @$statuses[$value];
                        }else{
                            $data_logs[$title] = $banner->$key . ' -> ' . $value;
                        }
                    }
                }
            }
        }

        if(!empty($data_logs)){
            $actLog = new ActivityLog();
            $actLog->type = 'BANNER';
            $actLog->action = $banner->empty ? 'create_banner' : 'update_banner';
            $actLog->object_id = $banner->obj_id;
            $actLog->user_id = $banner->user_id;
            $actLog->data = serialize($data_logs);
            $actLog->save();
        }

    }


    function branchLog($params = []){
        $data = $params['data'];
        $branch = $params['object'];
        $statuses = get_log_statuses();
        $titles = get_log_titles()['branch'];
        $data_logs = [];
        foreach($data as $key => $value){
            if(isset($titles[$key])){
                $title = $titles[$key];
                if($branch->empty){
                    if($key == 'status'){
                        $data_logs[$title] = $statuses[$value];
                    }else{
                        $data_logs[$title] = $value;
                    }
                }else{
                    if(@$branch->$key != $value){
                        if($key == 'status'){
                            $data_logs[$title] = @$statuses[$branch->$key] . ' -> ' . @$statuses[$value];
                        }else{
                            $data_logs[$title] = $branch->$key . ' -> ' . $value;
                        }
                    }
                }
            }
        }

        if(!empty($data_logs)){
            $actLog = new ActivityLog();
            $actLog->type = 'BRANCH';
            $actLog->action = $branch->empty ? 'create_branch' : 'update_branch';
            $actLog->object_id = $branch->object_id;
            $actLog->user_id = $branch->user_id;
            $actLog->data = serialize($data_logs);
            $actLog->save();
        }

    }


    function categoryLog($params = []){
        $data = $params['data'];
        $object = $params['object'];
        $statuses = get_log_statuses();
        $titles = get_log_titles()['category'];
        $data_logs = [];
        $model = new Category();
        foreach($data as $key => $value){
            if(isset($titles[$key])){
                $title = $titles[$key];
                if($object->empty){
                    $action = 'create_category';
                    if($key == 'status'){
                        $data_logs[$title] = $statuses[$value];
                    }elseif($key == 'parent_id'){
                        if(!empty($value)){
                            $category = $model->get_category($value);
                            $data_logs[$title] = @$category->name;
                        }else{
                            $data_logs[$title] = $value;
                        }
                    }else{
                        $data_logs[$title] = $value;
                    }
                }else{
                    $action = 'update_category';
                    if(@$object->$key != $value){
                        if($key == 'status'){
                            $data_logs[$title] = @$statuses[$object->$key] . ' -> ' . @$statuses[$value];
                        }elseif($key == 'parent_id'){
                            $before = $model->get_category($object->parent_id);
                            $after = $model->get_category($value);
                            $data_logs[$title] = @$before->name . ' -> ' . @$after->name;
                        }else{
                            $data_logs[$title] = $object->$key . ' -> ' . $value;
                        }
                    }
                }
            }
        }

        if(!empty($data_logs)){
            $actLog = new ActivityLog();
            $actLog->type = 'CATEGORY';
            $actLog->action = $action;
            $actLog->object_id = $object->object_id;
            $actLog->user_id = $object->user_id;
            $actLog->data = serialize($data_logs);
            $actLog->save();
        }

    }


    function featureLog($params = []){
        $data = $params['data'];
        $object = $params['object'];
        $statuses = get_log_statuses();
        $titles = get_log_titles()['feature'];
        $data_logs = [];
        $model = new Feature();
        foreach($data as $key => $value){
            if(isset($titles[$key])){
                $title = $titles[$key];
                if($object->empty){
                    $action = 'create_feature';
                    if($key == 'status'){
                        $data_logs[$title] = $statuses[$value];
                    }elseif($key == 'parent_id'){
                        if(!empty($value)){
                            $feature = $model->get_feature($value);
                            $data_logs[$title] = @$feature->name;
                        }else{
                            $data_logs[$title] = $value;
                        }
                    }else{
                        $data_logs[$title] = $value;
                    }
                }else{
                    $action = 'update_feature';
                    if(@$object->$key != $value){
                        if($key == 'status'){
                            $data_logs[$title] = @$statuses[$object->$key] . ' -> ' . @$statuses[$value];
                        }elseif($key == 'parent_id'){
                            $before = $model->get_feature($object->parent_id);
                            $after = $model->get_feature($value);
                            $data_logs[$title] = @$before->name . ' -> ' . @$after->name;
                        }else{
                            $data_logs[$title] = $object->$key . ' -> ' . $value;
                        }
                    }
                }
            }
        }

        if(!empty($data_logs)){
            $actLog = new ActivityLog();
            $actLog->type = 'FEATURE';
            $actLog->action = $action;
            $actLog->object_id = $object->object_id;
            $actLog->user_id = $object->user_id;
            $actLog->data = serialize($data_logs);
            $actLog->save();
        }

    }


    /*
    =================ORDER==========================================
    */

    function orderLog($params = []){
        $data = $params['data'];
        $object = $params['object'];
        $statuses = get_log_order_statuses();
        $data_logs = [];
        $titles = get_log_titles()['order'];
        if($object->empty){
            $action = 'create_order';
            $data_logs[$titles['name']] = @$titles['order'];
        }else{
            $action = 'update_order';
            foreach($data as $key => $value){
                $title = @$titles[$key];
                if(!empty($title) && !empty($value)){
                    if(@$object->$key != $value){
                        if($key == 'status'){
                            $data_logs[$title] = @$statuses[$object->$key] . ' -> ' . @$statuses[$value];
                        }else{
                            $data_logs[$title] = $object->$key . ' -> ' . $value;
                        }
                    }
                }
            }
        }

        if(!empty($data_logs)){
            $actLog = new ActivityLog();
            $actLog->type = 'ORDER';
            $actLog->action = $action;
            $actLog->object_id = $object->object_id;
            $actLog->sub_id = !empty($object->sub_id) ? $object->sub_id : 0;
            $actLog->user_id = $object->user_id;
            $actLog->data = serialize($data_logs);
            $actLog->save();
        }

    }

    /*
    ===================PRODUCT=========================================
    */

    function productLog($params = []){
        $data = $params['data'];
        $product = $params['object'];
        $statuses = get_log_statuses();
        $titles = get_log_titles()['product'];
        $data_logs = [];
        foreach($data as $key => $value){
            $key = str_replace("sku_", "", $key);
            if(isset($titles[$key])){
                $title = $titles[$key];
                if($product->empty){
                    $action = empty($product->parent_product_id) ? 'create_product' : 'create_child_product';
                    if($value != ""){
                        if($key == 'status'){
                            $data_logs[$title] = $statuses[$value];
                        }elseif($key == 'branch_id'){
                            $branch = $this->branch->get_branch($value);
                            if($branch)
                                $data_logs[$title] = $branch->name;
                        }elseif($key == 'category_ids'){
                            $categories = [];
                            foreach($value as $category_id){
                                $category = $this->category->get_category($category_id);
                                if($category){
                                    $categories[] = $category->name;
                                }
                            }
                            $data_logs[$title] = implode(', ', $categories);
                        }else{
                            $data_logs[$title] = $value;
                        }
                    }
                }else{

                    if(in_array($key, ['sell_price', 'org_price'])){
                        $value = (int)str_replace(",","",$value).'.00';
                    }

                    if(@$product->$key != $value){
                        $action = empty($product->parent_product_id) ? 'update_product' : 'update_child_product';
                        if($key == 'status'){
                            $data_logs[$title] = @$statuses[$product->$key] . ' -> ' . @$statuses[$value];
                        }elseif($key == 'branch_id'){
                            $before = $this->branch->get_branch($product->branch_id);
                            $after = $this->branch->get_branch($value);
                            $data_logs[$title] = @$before->name . ' -> ' . @$after->name;
                        }elseif($key == 'category_ids'){
                            $add_ids = [];
                            $before_ids = explode(',', $product->category_ids);
                            foreach($value as $category_id){
                                if(!in_array($category_id, $before_ids)){
                                    $add_ids[] = $category_id;
                                }else{
                                    $index = array_search($category_id, $before_ids);
                                    if($index >= 0)
                                        unset($before_ids[$index]);
                                }
                            }
                            if(!empty($add_ids)){
                                $add_names = [];
                                foreach($add_ids as $add_id){
                                    $category = $this->category->get_category($add_id);
                                    if($category){
                                        $add_names[] = $category->name;
                                    }
                                }
                                $data_logs[$titles['add_category']] = implode(', ', $add_names);
                            }

                            if(!empty($before_ids)){
                                $delete_names = [];
                                foreach($before_ids as $before_id){
                                    $category = $this->category->get_category($before_id);
                                    if($category){
                                        $delete_names[] = $category->name;
                                    }
                                }
                                $data_logs[$titles['delete_category']] = implode(', ', $delete_names);
                            }

                        }else{
                            $data_logs[$title] = $product->$key . ' -> ' . $value;
                        }
                    }
                }
            }
        }

        if(!empty($data_logs)){
            $actLog = new ActivityLog();
            $actLog->type = 'PRODUCT';
            $actLog->action = $action;
            $actLog->object_id = $product->object_id;
            $actLog->user_id = $product->user_id;
            $actLog->sub_id = !empty($product->sub_id) ? $product->sub_id : 0;
            $actLog->data = serialize($data_logs);
            $actLog->save();
        }

    }
}

