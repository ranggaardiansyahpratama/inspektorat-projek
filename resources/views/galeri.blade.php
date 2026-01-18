@extends('layouts.app')

@section('title', 'Galeri - Inspektorat Kota Tasikmalaya')

@push('styles')
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- AOS Animation -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


<style>
    .page-header {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        color: white;
        padding: 4rem 0;
        text-align: center;
    }
    
    .page-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }
</style>

@endpush

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container mx-auto px-4">
        <h1 class="page-title" data-aos="fade-up">Galeri</h1>
        <p class="text-xl opacity-90 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
            Dokumentasi kegiatan dan aktivitas Inspektorat Kota Tasikmalaya melalui Instagram resmi
        </p>
    </div>
</section>



<!-- Instagram Feed Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="elfsight-app-09a52699-7cf4-4582-bbbb-c57e46132d56" data-elfsight-app-lazy></div>
    </div>
</section>

@endsection

@push('scripts')
<!-- AOS Animation -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script src="https://elfsightcdn.com/platform.js" async></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS
    AOS.init({
        duration: 1000,
        once: true
    });
});
</script>
@endpush

