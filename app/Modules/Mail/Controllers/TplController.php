<?php


namespace App\Modules\Mail\Controllers;

use App\Http\Controllers\SiteController;
use App\Libraries\Upload;
use App\Modules\Mail\Models\Block;
use Illuminate\Support\Facades\App;

use App\Modules\Mail\Models\Tpl;


class TplController extends SiteController
{
    function __construct()
    {
        $this->block = new Block();
        $this->tpl = new Tpl();
        $this->upload = new Upload();
        $source_path = config('product.image.product.source'). 'mail';
        $thumb_path = config('product.image.product.thumb'). 'mail';
        $this->upload->doDirectory($source_path);
        $this->upload->doDirectory($thumb_path);
    }

    function index() {
        $templates = $this->tpl->get_templates(['orderBy' => ['name', 'asc']]);
        return view('Mail::tpl.index', ['templates' => $templates]);
    }

    function add(){
        $blocks = $this->block->get_blocks(['status' => 'A', 'orderBy' => ['name', 'asc']]);
        return view('Mail::tpl.action', ['blocks' => $blocks]);
    }

    function edit(Tpl $tpl){
        $blocks = $this->block->get_blocks(['status' => 'A', 'orderBy' => ['name', 'asc']]);
        return view('Mail::tpl.action', ['tpl' => $tpl, 'blocks' => $blocks]);
    }
}
