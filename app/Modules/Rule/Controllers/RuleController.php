<?php


namespace App\Modules\Rule\Controllers;

use App\Http\Controllers\SiteController;
use Symfony\Component\HttpFoundation\Request;

use App\Modules\Rule\Models\Rule;

use Config;

class RuleController extends SiteController
{

    function __construct()
    {
        $this->rule = new Rule();
    }

    function index(Request $request) {

        $filters = [
            'name' => @$request->get('name'),
            'status' => @$request->get('status')
        ];

        $params = array_merge($filters, ['limit' => 12, 'orderBy' => ['id', 'desc']]);
        $rules = $this->rule->get_rules($params);
        return view('Rule::rule.index', [
            'filters' => $filters,
            'filter' => get_rule_filters($filters),
            'rules' => $rules]);
    }

    function add(){
        return view('Rule::rule.add', []);
    }

    function edit(Rule $rule){
        return view('Rule::rule.edit', [
            'rule' => $rule]);
    }
}
