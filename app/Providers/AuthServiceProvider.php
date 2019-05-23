<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.
        Auth::viaRequest('password-login', function ($request) {
            if ($request->input('email') && $request->input('password')) {
                $matchedUser = User::where('email', $request->input('email'))->first();
                if ($matchedUser) {
                    if (Hash::check($request->input('password'), $matchedUser->password)) {
                        return $matchedUser;
                    } else {
                        return null;
                    }
                } else {
                    return null;
                }
            }
        });
    }
}
