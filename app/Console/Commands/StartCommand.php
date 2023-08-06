<?php

namespace App\Console\Commands;

use App\Models\Person;
use http\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class StartCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $clients = Person::get();
        foreach ($clients as $client){
            $lang = 'en';
            if(Str::startsWith($client->phone,'+993') || Str::startsWith($client->phone,'993') || Str::startsWith($client->phone,'86')){
                $lang = 'ru';
            }
            $client->update([
               'lang' => $lang
            ]);
        }
    }
}
