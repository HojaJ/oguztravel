<?php

namespace App\Console\Commands;

use App\Jobs\BirthdayEmailJob;
use App\Mail\DynamicMessage;
use App\Models\BirthdayMessage;
use App\Models\Email;
use App\Models\Person;
use App\Models\SMS;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class BirthdayCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'birthday:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Birthday email';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        SMS::where('type','birthday')->delete();
        $sms_tm =  BirthdayMessage::where('name','=', 'Birthday TM')->first();
        $sms_ru =  BirthdayMessage::orWhere('name','=', 'Birthday RU')->first();
        $email = Email::where('name','=','Birthday EN')->first();
        $today=now();
        $persons = Person::select('phone','lang','email')->whereMonth('date_of_birth',$today->month)
            ->whereDay('date_of_birth',$today->day)->get();
        foreach ($persons as $phone){
            $to = null;
            if(Str::startsWith($phone->phone,'+993')){
                $to = $phone->phone;
            } else if(Str::startsWith($phone->phone,'993')){
                $to = '+'. $phone->phone;
            }else if(Str::startsWith($phone->phone,'86')){
                $to = '+993'. substr($phone->phone,1);
            }else{
                \Mail::mailer('private')->to($phone->email)->send(new DynamicMessage($email->html));
                continue;
            }
            if($to){
                $content = $sms_ru->content;
                if($phone->lang === 'tm'){
                    $content = $sms_tm->content;
                }
                SMS::create([
                    'type' => 'birthday',
                    'to' => $to,
                    'uuid'=> uuid_create(),
                    'content' => $content,
                ]);
            }
        }
        return Command::SUCCESS;
    }
}
