<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Hanya lacak halaman publik, abaikan panel admin
        if (! $request->is('admin', 'admin/*')) {
            $ip = $request->ip();
            $date = Carbon::today()->toDateString();

            // firstOrCreate tanpa increment: setiap IP unik per hari = 1 pengunjung
            Visitor::firstOrCreate(
                ['ip_address' => $ip, 'date' => $date],
                ['hits' => 1]
            );
        }

        return $next($request);
    }
}
