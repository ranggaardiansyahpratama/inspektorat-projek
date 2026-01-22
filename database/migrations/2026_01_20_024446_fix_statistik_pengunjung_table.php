<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('statistik_pengunjungs');
        Schema::dropIfExists('statistik_pengunjung');
        
        Schema::create('statistik_pengunjung', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->unique();
            $table->integer('jumlah_pengunjung')->default(0);
            $table->integer('unique_visitors')->default(0);
            $table->integer('page_views')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistik_pengunjung');
    }
};
