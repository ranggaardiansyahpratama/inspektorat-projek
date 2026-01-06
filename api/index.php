<?php

// 1. Matikan limit waktu dan memori agar tidak "Closing" tiba-tiba
ini_set('memory_limit', '512M');
set_time_limit(0);

// 2. Tampilkan semua error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 3. Setup folder storage di /tmp (Vercel read-only fix)
$storagePath = '/tmp/storage';
foreach ([
    $storagePath . '/app/public',
    $storagePath . '/framework/cache/data',
    $storagePath . '/framework/sessions',
    $storagePath . '/framework/testing',
    $storagePath . '/framework/views',
    $storagePath . '/bootstrap/cache',
    $storagePath . '/logs',
] as $dir) {
    if (!is_dir($dir)) mkdir($dir, 0755, true);
}

// 4. Set Env kritis
putenv('APP_STORAGE=' . $storagePath);
$_ENV['APP_STORAGE'] = $storagePath;

// Cegah Laravel menggunakan folder storage asli di repo
putenv('VIEW_COMPILED_PATH=' . $storagePath . '/framework/views');

// 5. Jalankan Laravel
try {
    $autoload = __DIR__ . '/../vendor/autoload.php';
    if (!file_exists($autoload)) {
        die("<h1>Build Error</h1>Vendor autoload tidak ditemukan. Pastikan Anda sudah push composer.lock.");
    }
    
    require $autoload;
    
    // Cek APP_KEY
    if (empty(getenv('APP_KEY')) && empty($_ENV['APP_KEY'])) {
        echo "<h1>Konfigurasi Kurang</h1>";
        echo "<p>Anda BELUM memasukkan <b>APP_KEY</b> di Vercel Dashboard (Settings -> Environment Variables).</p>";
        echo "<p>Silakan masukkan APP_KEY dari file .env lokal Anda ke Vercel agar aplikasi bisa didekripsi.</p>";
        exit;
    }

    require __DIR__ . '/../public/index.php';
    
} catch (\Throwable $e) {
    echo "<h1>Laravel Gagal Booting (Vercel)</h1>";
    echo "<p><b>Pesan:</b> " . htmlentities($e->getMessage()) . "</p>";
    echo "<p><b>File:</b> " . $e->getFile() . " baris " . $e->getLine() . "</p>";
    echo "<hr><pre>" . $e->getTraceAsString() . "</pre>";
}
