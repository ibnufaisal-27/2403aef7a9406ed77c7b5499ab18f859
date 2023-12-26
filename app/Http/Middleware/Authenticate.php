<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{

    protected function redirectTo($request)
    {
        // if (! $request->expectsJson()) {
        //     return route('login');
        // }

        if(empty($request->header('Authorization'))){
            header('HTTP/1.0 401');
            echo 'Unauthorization';
            die();
        }
    }
}
