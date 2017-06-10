<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class UserExists
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
		$users = User::all();

		if (count($users) > 0){
			return redirect('/');
		}

		return $next($request);
	}
}
