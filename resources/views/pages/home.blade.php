@extends('layouts.app')

@section('title', 'Home - My Best Goodie')

@section('content')

{{-- ===== HERO CAROUSEL ===== --}}
<header id="home" class="carousel text-center align-items-center">
    <div id="customCarousel" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-indicators">
            <button type="button" data-bs-target="#customCarousel"
                data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#customCarousel"
                data-bs-slide-to="1"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="overlay-dark"></div>
                <img src="{{ asset('images/Produksi.jpeg') }}" class="d-block w-100" alt="Goodie Bag Kanvas" />
                <div class="carousel-caption d-md-block text-start">
                    <h1 class="display-4 fw-bold">My Best Goodie</h1>
                    <p class="lead fs-4">for Your Best Event</p>
                    <a href="https://wa.me/{{ config('app.whatsapp_number') }}?text={{ urlencode('Halo Admin, saya ingin bertanya tentang produk goodie bag custom') }}"
                       class="btn btn-light btn-lg mt-2" target="_blank">
                        💬 Hubungi Kami
                    </a>
                </div>
            </div>

            <div class="carousel-item">
                <div class="overlay-dark"></div>
                <img src="{{ asset('images/goodiebag.png') }}" class="d-block w-100" alt="Katalog" />
                <div class="carousel-caption d-md-block">
                    <h1 class="display-4 fw-bold">My Best Goodie Catalogue</h1>
                    <a href="#produk" class="btn btn-light btn-lg">Explore Catalog</a>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button"
            data-bs-target="#customCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button"
            data-bs-target="#customCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</header>

{{-- ===== WHY CHOOSE US ===== --}}
<section class="hero1 py-5">
    <div class="container text-center py-5">
        <h2 class="text-center mb-3 fw-bold">
            Why <span style="color: #1c4d8d">Choose Us</span>
        </h2>
        <p class="lead mb-5">Kami memberikan layanan terbaik untuk kebutuhan goodie bag custom Anda</p>

        <div class="features-grid py-4">
            @foreach ($features as $feature)
            <div class="feature-card">
                <div class="icon-wrapper">
                    {!! $feature['icon'] !!}
                </div>
                <h3 class="feature-title">{{ $feature['title'] }}</h3>
                <p class="feature-desc">{{ $feature['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== PRODUCT CATALOGUE ===== --}}
<section id="produk" class="py-5">
    <div class="container">
        <h2 class="text-center mb-2 fw-bold">
            Product <span style="color: #1c4d8d">Catalogue</span>
        </h2>
        <p class="text-center text-muted mb-5">Temukan berbagai pilihan goodie bag custom berkualitas tinggi</p>

        <div class="row g-4">
            @foreach ($products as $product)
            <div class="col-md-3 col-sm-6">
                <a href="{{ route('product.detail', $product->id) }}" class="text-decoration-none text-dark">
                <div class="card h-100 shadow-sm product-card">
                    <img src="{{ $product->image }}"
                         class="card-img-top"
                         alt="{{ $product->name }}"
                         style="height: 220px; object-fit: contain; padding: 10px;"
                    />
                    <div class="card-body text-center d-flex flex-column">
                        <h5 class="card-title fw-bold">{{ $product->name }}</h5>

{{--                        <div class="mt-auto">--}}
{{--                            <a href="{{ route('whatsapp.product', ['produk' => $product['name']]) }}"--}}
{{--                               class="btn btn-whatsapp w-100 whatsapp-btn"--}}
{{--                               data-produk="{{ $product['name'] }}"--}}
{{--                               target="_blank">--}}
{{--                                💬 Pesan via WA--}}
{{--                            </a>--}}
{{--                        </div>--}}
                    </div>
                </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== ABOUT US ===== --}}
<section id="tentang" class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-4">
                    About <span style="color: #1c4d8d">My Best Goodie</span>
                </h2>
                <p class="lead text-muted">
                    Kami adalah produsen goodie bag custom yang berpengalaman, melayani berbagai kebutuhan event perusahaan, pernikahan, seminar, dan acara lainnya.
                </p>
                <ul class="list-unstyled mt-4">
                    <li class="d-flex align-items-start mb-3">
                        <div class="check-icon me-3">✓</div>
                        <div>
                            <strong>Pelayanan cepat</strong>
                            <p class="text-muted mb-0 small">Melayani pelanggan dengan respon cepat</p>
                        </div>
                    </li>
                    <li class="d-flex align-items-start mb-3">
                        <div class="check-icon me-3">✓</div>
                        <div>
                            <strong>Bahan Berkualitas Premium</strong>
                            <p class="text-muted mb-0 small">Kanvas, spunbond, dan blacu pilihan terbaik</p>
                        </div>
                    </li>
                    <li class="d-flex align-items-start mb-3">
                        <div class="check-icon me-3">✓</div>
                        <div>
                            <strong>Custom Desain Bebas</strong>
                            <p class="text-muted mb-0 small">Logo, warna, dan ukuran sesuai kebutuhan Anda</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/Produksi.jpeg') }}"
                     class="img-fluid rounded-4 shadow"
                     alt="About My Best Goodie"
                     style="width: 100%; height: 400px; object-fit: cover;" />
            </div>
        </div>
    </div>
</section>

{{-- ===== CONTACT US ===== --}}
<section id="kontak" class="py-5">
    <div class="container text-center">
        <h2 class="fw-bold mb-3">
            Contact <span style="color: #1c4d8d">Us</span>
        </h2>
        <p class="lead text-muted mb-5">Ada pertanyaan? Kami siap membantu Anda!</p>
        <div class="row justify-content-center g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-4 h-100">
                    <div class="mb-3 fs-1">📱</div>
                    <h5 class="fw-bold">WhatsApp</h5>
                    <p class="text-muted">Chat langsung dengan tim kami</p>
                    <a href="https://wa.me/{{ config('app.whatsapp_number') }}"
                       class="btn btn-whatsapp" target="_blank">
                        Chat Sekarang
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-4 h-100">
                    <div class="mb-3 fs-1">📸</div>
                    <h5 class="fw-bold">Instagram</h5>
                    <p class="text-muted">Lihat portofolio produk kami</p>
                    <a href="https://instagram.com/mybestgoodie"
                       class="btn btn-outline-primary" target="_blank">
                        @mybestgoodie
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Carousel otomatis
    const myCarousel = document.querySelector('#customCarousel');
    if (myCarousel) {
        new bootstrap.Carousel(myCarousel, {
            interval: 3000,
            touch: true,
            pause: 'hover'
        });
    }

    // Tombol WhatsApp per produk
    document.querySelectorAll('.whatsapp-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const namaProduk = this.getAttribute('data-produk');
            const pesan = `Halo Admin, saya tertarik untuk memesan produk: ${namaProduk}. Bisa tolong dibantu?`;
            const waLink = `https://wa.me/{{ config('app.whatsapp_number') }}?text=${encodeURIComponent(pesan)}`;
            window.open(waLink, '_blank');
        });
    });
</script>
@endpush
