<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if ( $request->route()->uri == 'api/auth/email/verify/{id}/{hash}' ) {
            $id = $request->route('id');
            $hash = $request->route('hash');
            $expires = $request->expires;
            $signature = $request->signature;

            return env('APP_URL_CLI').'/auth/login/verify/'.$id.'/'.$hash.'?expires='.$expires.'&signature='.$signature;
        }

        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
