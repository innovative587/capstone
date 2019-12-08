<?php

namespace App\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;
use Auth;

use Closure;

class Ownerlogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $auth;
    public function __construct(Guard $auth){
        $this->auth = $auth;
    }
    public function handle($request, Closure $next)
    {
        if(!Auth::check()){
            abort(403,'Unauthorized action');
        }if($this->auth->getUser()->admin == 0){
            abort(403,'Unauthorized action');
        }
        return $next($request);
    }
}
