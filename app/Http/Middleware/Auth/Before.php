<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Session;
use Response;

class Before {

    public function handle($request, Closure $next) {
        if (empty(Session::get('user_id'))) {
            return Response::json([
                ['status' => 'NG'],
                ['errors' => array("message" => array("login is needed."))]
            ], 401);
        }

        return $next($request);
    }
}