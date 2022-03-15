<?php

namespace App\Http\Middleware;

use Closure;
use App\Sso\Broker;

class AttachBroker
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $broker = app(Broker::class);
        $redirect = $broker->attach(true);
        if ($redirect) {
            return $redirect;
        }
        return $next($request);
    }
}