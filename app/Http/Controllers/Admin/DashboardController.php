<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Kontak;
use App\Models\StatistikPengunjung;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik umum
        $totalBerita = Berita::count();
        $totalBeritaPublished = Berita::where('status', 1)->count();
        $totalGaleri = Galeri::count();
        $totalKontakMasuk = Kontak::where('status', 0)->count();

        // Berita terbaru
        $beritaTerbaru = Berita::latest()->take(5)->get();

        // Kontak masuk terbaru
        $kontakTerbaru = Kontak::latest()->take(5)->get();

        // Data untuk chart pengunjung (Real data)
        $last7Days = collect();
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $last7Days->put($date, [
                'tanggal' => now()->subDays($i)->format('d/m'),
                'pengunjung' => 0,
                'page_views' => 0
            ]);
        }

        $realStats = StatistikPengunjung::where('tanggal', '>=', now()->subDays(6)->toDateString())
            ->orderBy('tanggal', 'asc')
            ->get();

        foreach ($realStats as $stat) {
            $dateString = $stat->tanggal->format('Y-m-d');
            if ($last7Days->has($dateString)) {
                $last7Days->put($dateString, [
                    'tanggal' => $stat->tanggal->format('d/m'),
                    'pengunjung' => $stat->jumlah_pengunjung,
                    'page_views' => $stat->page_views
                ]);
            }
        }

        $chartData = $last7Days->values();

        // Total pengunjung bulan ini
        $totalPengunjungBulanIni = StatistikPengunjung::bulanIni()->sum('jumlah_pengunjung');

        return view('admin.dashboard', compact(
            'totalBerita',
            'totalBeritaPublished',
            'totalGaleri',
            'totalKontakMasuk',
            'beritaTerbaru',
            'kontakTerbaru',
            'chartData',
            'totalPengunjungBulanIni'
        ));
    }
}
