<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class TrackVisitsMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jangan eksekusi kalau tabel belum ada
        if (!Schema::hasTable('visits')) {
            return $next($request);
        }

        $ip = $request->ip();

        $lastVisit = Visit::where('ip_address', $ip)
            ->where('created_at', '>', Carbon::now()->subMinutes(30))
            ->first();

        if (!$lastVisit) {
            Visit::create([
                'ip_address' => $ip,
                'user_agent' => $request->userAgent(),
            ]);
        }

        return $next($request);
    }
}
