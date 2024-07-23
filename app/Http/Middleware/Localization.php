<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class Localization
 *
 * @package App\Http\Middleware
 */
class Localization
{
    /**
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next) : mixed
    {
        if ($request->hasHeader('X-Localization')) {
            app()->setLocale(
                $request->header('X-Localization')
            );
        }

        return $next($request);
    }
}
