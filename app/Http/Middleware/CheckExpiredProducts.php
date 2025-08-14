<?php

namespace App\Http\Middleware;

use App\Models\Product\Product;
use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class CheckExpiredProducts
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $expiredProducts = Product::whereDate('exp_date', '<', now())->get();

        if ($expiredProducts->isNotEmpty()) {
            $expiredProductsCount = $expiredProducts->count();
        }
        return $next($request);
    }
}
