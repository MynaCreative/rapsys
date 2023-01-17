<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\User;
use Rappasoft\LaravelAuthenticationLog\Models\AuthenticationLog;

use Inertia\Inertia;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $users = User::pluck('id');
        $usersOnline = [];
        foreach($users as $user) {
            if (Cache::tags('user-online')->has('user-is-online-' . $user)){
                $usersOnline[] = $user;
            }
        }
        $authentications = AuthenticationLog::whereNotNull('login_at')->whereNotNull('logout_at')
        ->select("*")
        ->selectRaw('TIMESTAMPDIFF(SECOND, login_at, logout_at) as duration')
        ->get()
        ->avg('duration');
        return Inertia::render("Dashboard", [
            'references' => [
                'total_user' => count($users),
                'total_login' => AuthenticationLog::count(),
                'login_duration' => [
                    'minute' => (int) Carbon::createFromTimestamp($authentications)->format('m'),
                    'second' => (int) Carbon::createFromTimestamp($authentications)->format('s'),
                ],
                'online' => $usersOnline
            ]
        ]);
    }
}
