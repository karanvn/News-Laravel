<?php


namespace App\Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class ForgetController extends Controller
{
    function index() {
        return view('Auth::auth.forget', []);
    }
}
