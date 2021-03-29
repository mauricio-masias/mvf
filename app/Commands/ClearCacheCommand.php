<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Illuminate\Support\Facades\Cache;


class ClearCacheCommand extends Command
{
    
    protected $signature = 'clear {--flush}';
    protected $description = 'Clears cached feed';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if($this->option('flush')){
            Cache::flush();
        }else{
            Cache::forget('user_name');
            Cache::forget('user_feed');
        }
    }

    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
