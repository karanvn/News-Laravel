<?php


namespace App\Modules\Mail\Controllers;

use App\Http\Controllers\SiteController;
use App\Libraries\Upload;
use App\Modules\Mail\Libraries\MailTemplate;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;


use App\Modules\Mail\Models\Block;
use App\Modules\Order\Models\Order;
use App\User;

class BlockController extends SiteController
{
    function __construct()
    {
        $this->block = new Block();
        $this->upload = new Upload();
        $this->order = new Order();
        $this->user = new User();
        $source_path = config('product.image.product.source'). 'mail';
        $thumb_path = config('product.image.product.thumb'). 'mail';
        $this->upload->doDirectory($source_path);
        $this->upload->doDirectory($thumb_path);
    }

    function index() {
        $blocks = $this->block->get_blocks();
        return view('Mail::block.index', ['blocks' => $blocks]);
    }

    function add(){
        return view('Mail::block.action', ['block' => false]);
    }

    function html(){
        $order_id = 45;
        $order = $this->order->get_order($order_id);
        return view('Mail::block.html.order_item', [
            'order' => $order
        ]);
    }

    function edit(Block $block){
        return view('Mail::block.action', ['block' => $block]);
    }
}
