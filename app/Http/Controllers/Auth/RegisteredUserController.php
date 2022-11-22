<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Controllers\Controller;
use App\Models\User;

use Inertia\Inertia;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request)
    {
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'username'  => $request->username,
            'password'  => $request->password,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
