<?php namespace App\Handlers\Events;

use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use App\User;
use Illuminate\Support\Facades\Auth;

class AuthLoginEventHandler {

    /**
     * Create the event handler.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  User $user
     * @param  $remember
     * @return void
     */
    public function handle(User $user, $remember)
    {
        $user = Auth::user();
        $user->last_login = Carbon::now();
        $user->save();

    }

}
