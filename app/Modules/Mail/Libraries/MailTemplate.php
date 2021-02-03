<?php

namespace App\Modules\Mail\Libraries;

use App\Modules\Mail\Models\Tpl;
use DOMDocument;
use DOMXPath;
use Illuminate\Support\Facades\Mail;

class MailTemplate
{
    function __construct()
    {
        $this->tpl = new Tpl();
    }

    public function sendMail($data)
    {
        if(!empty($data)){
            $type = @$data['type'];
            $tpl = $this->tpl->get_by_type_template($type);
            if($tpl){
                $subject = $tpl->subject;
                $blocks = $tpl->blocks()->get();
                if(count($blocks) > 0){
                    $html = "";
                    foreach ($blocks as $block) {
                        $html .= str_ireplace(array("\r", "\n", '\r', '\n', "\t", '\t'), '', $block->html);
                    }
                    $data['html'] = $html;
                    $data['subject'] = $subject;
                    $data['summary'] = $tpl->summary;
                    if($type == 'ORDER_CREATE'){
                        $data_send = $this->send_order($data);
                    }elseif(in_array($type, ['USER_CREATE', 'USER_FORGOT_PASSWORD'])){
                        $data_send = $this->send_user($data);
                    }elseif($type == 'FEEDBACK_CUSTOMER'){
                        $data_send = $this->send_feedback_user($data);
                    }elseif($type == 'RECIVE_INFO'){
                        $data_send = $this->send_register_info_user($data);
                    }elseif($type == 'HAPPY_BIRTHDAY'){
                        $data_send = $this->send_happy_birthday($data);
                    }
                    return $this->sendTemplate($data_send);
                }
            }
            return false;
        }
        return false;
    }

    public function sendTemplate($params){
        Mail::send([], [], function($message) use($params) {
            $message->from('info@ghebancong.com', 'EVASHOPPING');
            $message->to(@$params['to']);
            if(!empty(@$params['bcc']))
                $message->bcc($params['bcc']);
            $message->subject(@$params['subject']);
            $message->setBody(@$params['body'], 'text/html');
        });
        if( count(Mail::failures()) > 0 ) {
            return false;
         } else {
             return true;
         }
    }

    public function send_order($data){
        $order = $data['object'];
        $items= view('Mail::block.html.order_item', [
            'order' => $order
        ])->render();
        $user = $order->user()->first();
        $s_address = $order->s_address .', '. @$order->ward()->get()->first()->name .', '. @$order->district()->get()->first()->name .', '. @$order->state()->get()->first()->name;
        $html = str_replace(array(
            '[order.order_id]',
            '[order.name]',
            '[order.payment]',
            '[order.s_name]',
            '[order.s_address]',
            '[order.s_phone]',
            '[order.created_at]',
            '[order.items]'
        ), array(
            @$order->order_id,
            !empty($user) ? $user->name : '',
            @get_order_payments()[@$order->payment_id],
            @$order->s_name,
            $s_address,
            @$order->s_phone,
            @$order->created_at,
            $items
        ), $data['html']);

        $subject = str_replace(array(
            '[order.order_id]',
        ), array(
            fm_zeros(@$order->order_id, 6),
        ), $data['subject']);

        return [
            'subject' => $subject,
            'body' => $html,
            'to' => $order->email
        ];
    }

    public function send_user($data){
        $user = $data['object'];
        $html = str_replace(array(
            '[user.name]',
            '[user.email]',
            '[user.phone]',
            '[user.url]'
        ), array(
            @$user->name,
            @$user->email,
            @$user->phone,
            @$user->url
        ), $data['html']);

        $subject = str_replace(array(
            '[user.name]',
        ), array(
            @$user->name,
        ), $data['subject']);

        return [
            'subject' => $subject,
            'body' => $html,
            'to' => $user->email
        ];
    }
    
    public function send_feedback_user($data){
        $user = $data['object'];
        $html = str_replace(array(
            '[user.fullname]',
            '[user.content]',
            '[user.email]',
            '[user.phone]',
        ), array(
            @$user->fullname,
            @$user->content,
            @$user->email,
            @$user->phone,
        ), $data['html']);

        $subject = str_replace(array(
            '[user.fullname]',
        ), array(
            @$user->fullname,
        ), $data['subject']);

        return [
            'subject' => $subject,
            'body' => $html,
            // 'to' => $user->email
            'to' => 'duc.ntd@gmail.com'
        ];
    }
    
    public function send_register_info_user($data){
        $user = $data['object'];
        $html = str_replace(array(
            '[user.email]',
        ), array(
            @$user->email,
        ), $data['html']);

        $subject = str_replace(array(
            '[user.email]',
        ), array(
            @$user->email,
        ), $data['subject']);

        return [
            'subject' => $subject,
            'body'    => $html,
            'to'      => $user->email
        ];
    }
    
    public function send_happy_birthday($data){
        $user = $data['object'];
        $html = str_replace(array(
            '[user.email]',
            '[user.name]',
        ), array(
            @$user->email,
            @$user->name,
        ), $data['html']);

        $subject = str_replace(array(
            '[user.email]',
            '[user.name]',
        ), array(
            @$user->email,
            @$user->name,
        ), $data['subject']);

        return [
            'subject' => $subject,
            'body'    => $html,
            'to'      => $user->email
        ];
    }

}
