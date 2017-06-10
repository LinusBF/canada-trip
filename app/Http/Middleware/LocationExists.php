<?php

namespace App\Http\Middleware;

use Closure;
use App\Location;

class LocationExists
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
	    $locations = Location::all();

	    if (count($locations) < 1){
		    return redirect()->route('home');
	    }

	    return $next($request);
    }
}
