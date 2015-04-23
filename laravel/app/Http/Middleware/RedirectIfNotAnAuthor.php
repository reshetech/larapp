<?php namespace App\Http\Middleware;

use Closure;

class RedirectIfNotAnAuthor {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        if($request->user() && $request->user()->isAuthor())
        {
            return $next($request);
        }

        return redirect("/blog");
	}

}
