<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MarkNotificationAsRead
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
        if($request->has('read')) {
        $notification = Auth::user()->notifications()->where('id', $request->get('read'))->first();
        if($notification){
            $notification->markAsRead();
        }
    }
        return $next($request);
    }
}
