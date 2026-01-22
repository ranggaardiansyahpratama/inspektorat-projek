<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\StatistikPengunjung;
use Illuminate\Support\Facades\Session;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Don't track admin panel requests if we want to focus on public traffic
        // Or keep it simple and track everything
        if (!$request->is('admin*')) {
            $today = now()->toDateString();
            
            $stats = StatistikPengunjung::firstOrCreate(
                ['tanggal' => $today],
                ['jumlah_pengunjung' => 0, 'unique_visitors' => 0, 'page_views' => 0]
            );

            $stats->increment('page_views');

            if (!Session::has('visitor_tracked_' . $today)) {
                $stats->increment('unique_visitors');
                $stats->increment('jumlah_pengunjung'); // Using this as session-based unique visitor
                Session::put('visitor_tracked_' . $today, true);
            }
        }

        return $next($request);
    }
}
