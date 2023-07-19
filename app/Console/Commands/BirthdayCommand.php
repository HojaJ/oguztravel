<?php

namespace App\Console\Commands;

use App\Jobs\BirthdayEmailJob;
use App\Models\Person;
use Illuminate\Console\Command;

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
        $today=now();
        $persons = Person::whereMonth('date_of_birth',$today->month)
            ->whereDay('date_of_birth',$today->day)->get();
        foreach ($persons as $person){
            dispatch(new BirthdayEmailJob($person->email,$person));
        }
        \Artisan::call('queue:work --stop-when-empty', []);
        return Command::SUCCESS;
    }
}
