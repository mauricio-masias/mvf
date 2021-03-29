<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Github\GetUserLanguageFeed;
use Illuminate\Support\Facades\Cache;

class PreferedDevLanguageCommand extends Command
{
    private $user_name;
    private $user_feed;
    private $search;
    protected $signature = 'search  {username : Input the Github username to search for}';
    protected $description = 'Search for a user and present the best guess of the Github user\'s favourite programming language';

    public function handle(GetUserLanguageFeed $search)
    {
        $this->search = $search;

        $this->task("1 - Initiate github user search", function () {
            $this->user_name = preg_replace("/\s+/", "", $this->argument('username'));
        });

        $this->task("2 - Parsing feed", function () {
            if (Cache::has('user_name')) {
                if (Cache::get('user_name') == $this->user_name) {
                    $this->info(" Using cached feed");
                    $this->user_feed = unserialize(Cache::get('user_feed'));
                    return true;
                } else {
                    Cache::forget('user_name');
                    Cache::forget('user_feed');
                    return $this->useLiveFeedThenCacheIt();
                }
            } else {
                return $this->useLiveFeedThenCacheIt();
            }
        });

        $this->task("3 - Finding user favorite programming language ", function () {
            $prefered = $this->search->findPreferedLanguage($this->user_feed, $this->user_name);
            count($prefered) > 0 ?
                $this->info(" [ " . $prefered[0] . " ]") :
                $this->info(' No language found');
            
            $this->notify('Github', 'Search finished');
        });
    }

    private function useLiveFeedThenCacheIt()
    {
        $this->info(" Using live feed");
        $this->user_feed = $this->search->getUserFeed($this->user_name);

        if(count($this->user_feed) > 1){
            Cache::forever('user_name', $this->user_name);                    
            Cache::forever('user_feed', serialize($this->user_feed));
            return true;
        }else{
            return false;
        }
    }

    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
