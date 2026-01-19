<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 3 berita terbaru yang sudah dipublish
        $beritaTerbaru = Berita::published()
                             ->latest()
                             ->take(3)
                             ->get();
        
        return view('home', compact('beritaTerbaru'));
    }
}
