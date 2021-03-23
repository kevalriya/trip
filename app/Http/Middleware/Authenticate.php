<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;
use Closure;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
     protected $guards = [];

 public function handle($request, Closure $next, ...$guards)
    {
        $this->guards = $guards;

        return parent::handle($request, $next, ...$guards);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if (array_first($this->guards) === 'admin') {
                return route('admin.login');
            }
            return route('login');
        }
    }
}
