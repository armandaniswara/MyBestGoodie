<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'My Best Goodie')</title>

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet" />

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

    @stack('styles')
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <img src="{{ asset('images/5.png') }}" alt="logo" width="150" />
            </a>
            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active fw-semibold' : '' }}"
                           href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#produk">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#tentang">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#kontak">Contact Us</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="nav-link btn btn-wa-nav px-3 text-white"
                           href="https://wa.me/{{ config('app.whatsapp_number') }}?text={{ urlencode('Halo Admin, saya ingin bertanya tentang produk goodie bag custom') }}"
                           target="_blank">
                            💬 WhatsApp
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Konten Halaman --}}
    @yield('content')

    {{-- Tombol WhatsApp Floating --}}
    <div class="wa-floating-container">
        <a href="https://wa.me/{{ config('app.whatsapp_number') }}?text={{ urlencode('Halo Admin, saya ingin bertanya tentang produk goodie bag custom') }}"
           class="wa-bubble-link" target="_blank" rel="noopener">
            <div class="wa-bubble">
                <span class="wa-text-top">Ingin Custom Goodiebag?</span>
                <span class="wa-text-bottom">WhatsApp Sekarang </span>
            </div>
        </a>
        <a href="https://wa.me/{{ config('app.whatsapp_number') }}?text={{ urlencode('Halo Admin, saya ingin bertanya tentang produk goodie bag custom') }}"
           class="wa-icon-main" target="_blank" rel="noopener">
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/>
            </svg>
        </a>
    </div>

    {{-- Footer --}}
    <footer class="py-5" style="background-color: #6d6d6d; border-top: 1px solid #dee2e6; color: #ffff;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 mb-4 mb-md-0">
                    <img src="{{ asset('images/4.png') }}" alt="logo" width="100" />
                    <p class="mt-3 text-white-50 small">
                        Spesialis goodie bag custom berkualitas premium untuk segala kebutuhan event Anda.
                    </p>
                </div>
                <div class="col-md-8">
                    <div class="row justify-content-md-end text-md-end text-start">
                        <div class="col-lg-4 mb-3">
                            <h6 class="fw-bold">Contact Us</h6>
                            <a href="tel:+{{ config('app.whatsapp_number') }}"
                               class="text-decoration-none d-block mb-1 text-white">
                                +{{ config('app.whatsapp_number') }}
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <h6 class="fw-bold">Follow & Connect</h6>
                            <div class="d-flex justify-content-md-end gap-3 mt-2">
                                <a href="https://wa.me/{{ config('app.whatsapp_number') }}"
                                   target="_blank" class="social-icon">WA</a>
                                <a href="https://instagram.com/mybestgoodie"
                                   target="_blank" class="social-icon">IG</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4" />
            <div class="text-center text-muted small">
                &copy; {{ date('Y') }} My Best Goodie. All Rights Reserved.
            </div>
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Custom JS --}}
    <script src="{{ asset('js/script.js') }}"></script>

    @stack('scripts')
</body>
</html>
