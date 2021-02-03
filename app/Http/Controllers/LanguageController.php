<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    function index($lange) {
        $icons = config('lang.icon_lang');
        if(in_array($lange, array('en', 'vi'))){
            session(['site_lang' => $lange, 'icon_lang' => $icons[$lange]]);
        }
        return redirect()->back();
    }
}
