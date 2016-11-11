<?php

namespace App\Console;

use App\Tareas;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')->hourly();

        $schedule->call(function () {

            $today = Carbon::today()->format('Y-m-d H:i:s');
            $users = User::productivos()->get();

            foreach ($users as $user) {

                if ($user->ultimo_envio < $today) {

                    $tareas = Tareas::fromUserId($user->id)->todayOrUncompleted()->orderBy('tiempo', 'desc')->get();

                    if (count($tareas)) {
                        $data = ['user' => $user, 'tareas' => $tareas];

                        Mail::send('emails.tareas', $data, function ($message) use ($user) {
                            $subject = '[AUTO] ERP Tareas | ' . $user->name . ' ' . $user->apellidos . ' | ' . Carbon::today()->format('d-m-Y');

                            $message->from($user->email, $user->name);
                            $message->subject($subject);
                            $message->replyTo($user->email);
                            $message->to('miguel@ril.es');
                        });
                    }

                    $user->ultimo_envio = $today;
                    $user->save();
                }
            }
        })->everyMinute();
    }
}
