@extends('layouts.app')

@section('title', $berita->judul . ' - Berita - Inspektorat Kota Tasikmalaya')

@push('styles')
<style>
    .article-header {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        color: white;
        padding: 4rem 0;
    }

    .breadcrumb {
        margin-bottom: 2rem;
        opacity: 0.9;
    }

    .breadcrumb a {
        color: white;
        text-decoration: none;
        opacity: 0.8;
        transition: opacity 0.3s ease;
    }

    .breadcrumb a:hover {
        opacity: 1;
    }

    .breadcrumb span {
        margin: 0 0.5rem;
        opacity: 0.6;
    }

    .article-category {
        display: inline-block;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 1rem;
        backdrop-filter: blur(10px);
    }

    .article-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 2rem;
        line-height: 1.2;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .article-meta {
        display: flex;
        align-items: center;
        gap: 2rem;
        font-size: 1rem;
        opacity: 0.9;
        margin-bottom: 1rem;
    }

    .article-meta i {
        margin-right: 0.5rem;
    }

    .article-content {
        padding: 4rem 0;
        background: #f8f9fa;
    }

    .article-container {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .back-to-news {
        margin-top: 0;
        margin-bottom: 2.5rem;
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #1e40af;
        text-decoration: none;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border: 2px solid #1e40af;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .back-btn:hover {
        background: #1e40af;
        color: white;
        transform: translateX(-5px);
    }

    .article-image {
        width: 100%;
        height: 400px;
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3rem;
        position: relative;
        overflow: hidden;
    }

    .article-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .article-body {
        padding: 3rem;
    }

    .article-body h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .article-body .meta {
        display: flex;
        align-items: center;
        gap: 2rem;
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #eee;
    }

    .article-body .meta i {
        margin-right: 0.5rem;
        color: #1e40af;
    }

    .article-body .content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #333;
        text-align: justify;
    }

    .article-body .content p {
        margin-bottom: 1.5rem;
    }



    .related-news {
        padding: 4rem 0;
        background: white;
    }

    .related-title {
        text-align: center;
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 3rem;
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }

    .related-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
    }

    .related-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        color: inherit;
        text-decoration: none;
    }

    .related-image {
        height: 200px;
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
    }

    .related-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .related-content {
        padding: 1.5rem;
    }

    .related-content h4 {
        font-size: 1.2rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }

    .related-date {
        color: #1e40af;
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .related-excerpt {
        color: #666;
        font-size: 0.9rem;
        line-height: 1.6;
    }

    @media (max-width: 768px) {
        .article-title {
            font-size: 2rem;
        }
        
        .article-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        
        .article-body {
            padding: 2rem;
        }
        

    }
</style>
@endpush

@section('content')
<!-- Article Header -->
<section class="article-header">
    <div class="container">
        <!-- Breadcrumb -->
        <nav class="breadcrumb" data-aos="fade-up">
            <a href="{{ route('home') }}">Beranda</a>
            <span>/</span>
            <a href="{{ route('berita.index') }}">Berita</a>
            <span>/</span>
            <span>{{ Str::limit($berita->judul, 50) }}</span>
        </nav>

        <div class="row align-items-center">
            <div class="col-12">
                <div class="article-category" data-aos="fade-up" data-aos-delay="100">
                    Berita
                </div>
                <h1 class="article-title" data-aos="fade-up" data-aos-delay="200">
                    {{ $berita->judul }}
                </h1>
                <div class="article-meta" data-aos="fade-up" data-aos-delay="300">
                    <div>
                        <i class="fas fa-calendar"></i>
                        {{ $berita->created_at->format('d F Y') }}
                    </div>

                    <div>
                        <i class="fas fa-clock"></i>
                        {{ $berita->created_at->format('H:i') }} WIB
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Article Content -->
<section class="article-content">
    <div class="container">
        <!-- Back Button -->
        <div class="back-to-news" data-aos="fade-up">
            <a href="{{ route('berita.index') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i> Kembali ke Berita
            </a>
        </div>

        <div class="article-container">
            <!-- Article Image -->
            <div class="article-image" data-aos="fade-up" data-aos-delay="100">
                @if($berita->gambar)
                    <img src="{{ asset('images/berita/' . $berita->gambar) }}" alt="{{ $berita->judul }}">
                @else
                    <i class="fas fa-newspaper"></i>
                @endif
            </div>

            <!-- Article Body -->
            <div class="article-body" data-aos="fade-up" data-aos-delay="200">
                <h1>{{ $berita->judul }}</h1>
                
                <div class="meta">
                    <div><i class="fas fa-calendar"></i>{{ $berita->created_at->format('d F Y, H:i') }} WIB</div>

                </div>

                <div class="content-body">
                    {!! $berita->konten !!}
                </div>


            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });
</script>
@endpush