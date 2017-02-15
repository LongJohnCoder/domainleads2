<?php

namespace App\Console;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use \Route;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        
        $schedule->call(function () {
            try{
                //2017-02-06 ===>> small date

                \Log::info('calling scheduler');
                date_default_timezone_set('Asia/Kolkata');
                $date = date('Y-m-d',time());

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'http://domainleads2.dev/importExeclfromCron/'.$date);
                curl_setopt($ch, CURLOPT_HEADER, FALSE);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                $head = curl_exec($ch); 

                $result = json_decode($head,true);

                \Log::info('from schedule ++++++>> STATUS : '.$result['status']);
                \Log::info($result);
            }
            catch(\Exception $e)
            {
                Log::info('from catch block'.$e);
            }

            \Log::info('::time::');
           
        })->dailyAt('23:30');
        \Log::info(date('Y-m-d',time()));
       
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
