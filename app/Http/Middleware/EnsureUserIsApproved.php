<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsApproved
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->isOng()) {
            $ong = $user->ong;

            if (!$ong || $ong->isPendente()) {
                return redirect()->route('ong.aguardando-aprovacao');
            }

            if ($ong->isRecusada()) {
                return redirect()->route('ong.recusada');
            }
        }

        return $next($request);
    }
}
