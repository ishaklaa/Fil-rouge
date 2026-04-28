<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class roleAndStatusCheck
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {

        if (!Auth::check()) {
            return redirect()->route('login.show');
        }
        $user = Auth::user();
        if ($user->status !== 'active') {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login.show')->with('error', 'Votre compte est désactivé.');
        }
        if (!$user->role || !in_array($user->role->name, $roles)) {
            return redirect()->back()->with('error', 'Vous n\'avez pas les permissions nécessaires.');
        }
        return $next($request);
    }
}
