<?php

namespace App\Http\Middleware;

use Session;
use Closure;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Session::exists('admin_status'))
        {
            return $next($request);
        }
        return redirect('/admin/masuk')->with('error','Mohon Maaf Silahkan Masuk Terlebih Dahulu');
    }
}
