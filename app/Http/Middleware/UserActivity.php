<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Cache;
use App\Models\User;
use App\Models\Userakses;
use Illuminate\Http\Request;

class UserActivity
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
        if (Auth::check()) {
            $expiresAt = now()->addMinutes(2); /* keep online for 2 min */
            Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);
  
            /* last seen */
            $user = User::where('id', Auth::user()->id)->update(['last_seen' => now()]);
            $tanggal = date('d-m-Y');
            $userakses = Userakses::where('user_id', Auth::user()->id)->where('tanggal', $tanggal)->first();
            
            if ($userakses == null) {
                # code...
                Userakses::create([
                    'user_id'=>Auth::user()->id,
                    'role'=>Auth::user()->role,
                    'tanggal'=>$tanggal
                ]);
            }

        }

        return $next($request);
    }
}
