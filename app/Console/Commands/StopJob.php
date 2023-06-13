<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class StopJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stop:job';

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
        $process = new Process(['pgrep', '-f', 'php artisan ' ]);
        $process->run();

        $pid = $process->getOutput();
        $pid = trim($pid);

        $process = new Process(['kill', '-9', $pid]);
        $process->run();

        return $process->isSuccessful();
    }
}
