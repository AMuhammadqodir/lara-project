<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CheckMaqom
{
    public function handle(Request $request, Closure $next, ...$maqoms)
    {
        $user = $request->session()->get('user');

        if (!$user || !in_array($user['maqom_id'], $maqoms)) {
            return redirect()->route('login')->withErrors(['login' => 'Сиз бу саҳифага кириш ҳуқуқига эга эмассиз.']);
        }

        return $next($request);
    }

}
