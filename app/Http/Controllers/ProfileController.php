<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;
use Browser;

class ProfileController extends Controller
{

    private $module = 'General';
    private $page = 'Profile';

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
        return Inertia::render("{$this->module}/{$this->page}/Index", [
            'authentications'=> auth()->user()->authentications->take(10)->map(function ($item) {
                return [
                    'location' => $item->location,
                    'ip_address' => $item->ip_address,
                    'login_at' => $item->login_at,
                    'logout_at' => $item->logout_at,
                    'login_successful' => $item->login_successful,
                    'user_agent' => Browser::parse($item->user_agent)
                ];
            }),
        ]);
    }
}
