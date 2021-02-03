<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Modules\Mail\Libraries\MailTemplate;
use App\Modules\Mail\Models\MailLog;
use Carbon;

class MailBirthdayCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->user    = new User();
        $this->mailLog = new MailLog();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(){

        $i = 0;
        // $users = User::whereMonth('bod', '=', date('m'))->whereDay('bod', '=', date('d'))->whereYear('bod', '=', date('y'))->get();  
        $users = User::whereMonth('bod', '=', date('m'))->whereDay('bod', '=', date('d'))->get();  
        
        foreach($users as $user){
            $currentTime = Carbon\Carbon::now();
            // $users = MailLog::whereYear('bod', date('Y', $user->bod));  
            // $compareYear = MailLog::whereYear('bod', '<>', date('Y', strtotime($user->bod)))->get();  
            $compareYear = MailLog::where('bod', $user->bod)->get();  
            $mailCompare = $this->mailLog->getMailLog($user->id);  // get info user has birthday now
            if(empty($mailCompare) || (!empty($compareYear) && !empty($mailCompare))){ // nếu tồn tại đk này thì save vào đb <=> truong hop không ton
                $dataMailLog      = new MailLog();
                $dataMailLog->bod  = $user->bod;
                $dataMailLog->name  = $user->name;
                $dataMailLog->email  = $user->email;
                $dataMailLog->status  = 1;        // send successfully
                $dataMailLog->user_id  = $user->id;
                $dataMailLog->created_at= $currentTime;
                $dataMailLog->save();
                $mail = new MailTemplate();
                $mail->sendMail([
                    'type'   => 'HAPPY_BIRTHDAY',
                    'object' => $user
                ]);
                if (count(Mail::failures()) > 0) {
                    $dataMailLog      = new MailLog();
                    $dataMailLog->bod  = $user->bod;
                    $dataMailLog->name  = $user->name;
                    $dataMailLog->email  = $user->email;
                    $dataMailLog->status  = 2;      // send failures
                    $dataMailLog->user_id  = $user->id;
                    $dataMailLog->created_at= $currentTime;
                    $dataMailLog->save();
                }
                $i++; 
            }
        }

        $this->info($i.' Birthday messages sent successfully!');
    }
}
