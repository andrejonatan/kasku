<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KASKU - Sistem Monitoring Keuangan Kelas</title>
    <meta name="description" content="Aplikasi manajemen kas kelas untuk mengelola iuran, transaksi, pembayaran, dan laporan keuangan secara digital.">
    <meta name="keywords" content="kas kelas, manajemen keuangan, iuran kelas, pembayaran kas, laporan keuangan">
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Lucide Icons CDN --}}
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="antialiased" x-data="landingPage()" x-init="init()">

    {{-- ═══════════════════════════════════════════
         NAVBAR
         ═══════════════════════════════════════════ --}}
    <nav class="navbar fixed top-0 left-0 right-0 z-50" :class="{ 'scrolled': scrolled }" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">
                {{-- Logo --}}
                <a href="/" class="flex items-center gap-3 shrink-0">
                    <img src="{{ asset('images/logo_kas.png') }}" alt="KASKU Logo" class="h-9 w-auto">
                </a>

                {{-- Desktop Navigation --}}
                <div class="hidden lg:flex items-center gap-8">
                    <a href="#home" class="nav-link active">Home</a>
                    <a href="#fitur" class="nav-link">Fitur</a>
                    <a href="#monitoring" class="nav-link">Monitoring Kas</a>
                    <a href="#laporan" class="nav-link">Laporan</a>
                    <a href="#kontak" class="nav-link">Kontak</a>
                </div>

                {{-- CTA Buttons --}}
                <div class="hidden lg:flex items-center gap-3">
                    @auth
                        <a href="{{ route('profile') }}" class="relative group block shrink-0" title="Profil">
                            @if(auth()->user()->foto_profil)
                                <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" alt="{{ auth()->user()->nama_user }}" class="w-10 h-10 rounded-full object-cover border border-kasku-accent/50 hover:border-kasku-accent transition-all duration-300">
                            @else
                                <div class="w-10 h-10 rounded-full bg-[#11122b] border border-kasku-accent/30 flex items-center justify-center text-kasku-accent font-semibold hover:border-kasku-accent transition-all duration-300 text-sm">
                                    {{ strtoupper(substr(auth()->user()->nama_user, 0, 1)) }}
                                </div>
                            @endif
                        </a>
                        <a href="/admin" class="btn-gold text-xs py-1.5 px-3.5">
                            <span>Admin</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="btn-outline text-xs py-1.5 px-3.5 border-red-500/40 hover:border-red-400 hover:text-red-400 hover:bg-red-500/10 cursor-pointer">
                                <span>Logout</span>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn-outline text-sm py-2 px-5">
                            <span>Login</span>
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-gold text-sm py-2 px-5">
                                <span>Daftar</span>
                            </a>
                        @endif
                    @endauth
                </div>

                {{-- Mobile Menu Button --}}
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden text-kasku-muted hover:text-kasku-accent transition-colors p-2 cursor-pointer" aria-label="Toggle menu">
                    <svg x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-cloak>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div class="mobile-menu fixed top-16 right-0 bottom-0 w-72 bg-kasku-surface/95 backdrop-blur-xl border-l border-kasku-border z-40 p-6 lg:hidden"
             :class="{ 'open': mobileMenuOpen }"
             @click.outside="mobileMenuOpen = false"
             x-cloak>
            <div class="flex flex-col gap-4 mb-8">
                <a href="#home" @click="mobileMenuOpen = false" class="nav-link text-lg py-2">Home</a>
                <a href="#fitur" @click="mobileMenuOpen = false" class="nav-link text-lg py-2">Fitur</a>
                <a href="#monitoring" @click="mobileMenuOpen = false" class="nav-link text-lg py-2">Monitoring Kas</a>
                <a href="#laporan" @click="mobileMenuOpen = false" class="nav-link text-lg py-2">Laporan</a>
                <a href="#kontak" @click="mobileMenuOpen = false" class="nav-link text-lg py-2">Kontak</a>
            </div>
            <div class="flex flex-col gap-3 pt-6 border-t border-kasku-border">
                @auth
                    <a href="/admin" class="btn-gold text-sm py-2.5 px-5 text-center">Admin</a>
                    <a href="{{ route('profile') }}" class="flex items-center gap-3 justify-center py-2.5 px-5 text-center btn-outline text-sm">
                        @if(auth()->user()->foto_profil)
                            <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" alt="{{ auth()->user()->nama_user }}" class="w-8 h-8 rounded-full object-cover">
                        @else
                            <div class="w-8 h-8 rounded-full bg-kasku-accent/20 flex items-center justify-center text-kasku-accent font-semibold text-xs">
                                {{ strtoupper(substr(auth()->user()->nama_user, 0, 1)) }}
                            </div>
                        @endif
                        <span>Profil</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-outline text-sm py-2.5 px-5 w-full border-red-500/40 hover:border-red-400 hover:text-red-400 cursor-pointer">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-outline text-sm py-2.5 px-5 text-center">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-gold text-sm py-2.5 px-5 text-center">Daftar</a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    {{-- ═══════════════════════════════════════════
         HERO SECTION
         ═══════════════════════════════════════════ --}}
    <section id="home" class="relative min-h-screen flex items-center pt-20 overflow-hidden">
        {{-- Background Glows --}}
        <div class="hero-glow -top-20 -left-40"></div>
        <div class="hero-glow-gold top-1/3 -right-20"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32 w-full">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                {{-- Text Content --}}
                <div class="text-center lg:text-left">
                    <div class="section-label animate-fade-in-up">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3.332.649-4.5 1.71A5.5 5.5 0 0 0 7.5 3 5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                        Sistem Manajemen Kas Kelas
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight tracking-tight mb-6" style="animation: fade-in-up 0.8s ease 0.1s both;">
                        Kelola Keuangan<br>
                        Kas Kelas dengan<br>
                        <span class="gradient-text">Lebih Mudah</span>
                    </h1>

                    <p class="text-lg text-kasku-muted max-w-xl mx-auto lg:mx-0 mb-8 leading-relaxed" style="animation: fade-in-up 0.8s ease 0.2s both;">
                        Pantau pembayaran kas, kelola tabungan study tour, dan lihat laporan keuangan kelas secara real-time dalam satu platform.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start" style="animation: fade-in-up 0.8s ease 0.3s both;">
                        @auth
                            @if(auth()->user()->jabatan && auth()->user()->jabatan->nama_jabatan === 'Admin')
                                <a href="/admin" class="btn-gold text-base py-3 px-8">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                                    <span>Dashboard Admin</span>
                                </a>
                            @endif
                            <a href="{{ route('payment.kas') }}" class="btn-gold text-base py-3 px-8">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                                <span>Bayar Kas</span>
                            </a>
                            <a href="{{ route('payment.tour') }}" class="btn-outline text-base py-3 px-8">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 20a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                <span>Study Tour</span>
                            </a>
                        @else
                            <a href="{{ Route::has('register') ? route('register') : '#' }}" class="btn-gold text-base py-3 px-8">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                <span>Mulai Sekarang</span>
                            </a>
                            <a href="{{ route('login') }}" class="btn-outline text-base py-3 px-8">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                                <span>Login</span>
                            </a>
                        @endauth
                    </div>

                </div>

                {{-- Dashboard Mockup --}}
                <div class="mockup-container hidden lg:block" style="animation: fade-in-up 0.8s ease 0.4s both;">
                    <img src="{{ asset('images/dashboard_mockup.png') }}" alt="KASKU Dashboard Preview" class="mockup-image w-full">
                    <div class="absolute -bottom-4 -left-4 w-48 h-48 bg-gradient-to-br from-kasku-primary/20 to-transparent rounded-full blur-3xl"></div>
                </div>
            </div>
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-kasku-muted animate-bounce">
            <span class="text-xs tracking-widest uppercase">Scroll</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════
         STATISTIK KAS KELAS
         ═══════════════════════════════════════════ --}}
    <section class="relative py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
                {{-- Stat 1 --}}
                <div class="stat-card reveal" x-intersect.once="$el.classList.add('visible')">
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <div class="stat-number" x-data="{ count: 0, target: 36 }" x-intersect.once="let i = setInterval(() => { count++; if(count >= target) { count = target; clearInterval(i); }}, 50)">
                        <span x-text="count">0</span>
                    </div>
                    <p class="text-kasku-muted text-sm mt-2">Total Anggota</p>
                </div>

                {{-- Stat 2 --}}
                <div class="stat-card reveal reveal-delay-1" x-intersect.once="$el.classList.add('visible')">
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    </div>
                    <div class="stat-number" x-data="{ count: 0, target: 5400000 }" x-intersect.once="let i = setInterval(() => { count += 120000; if(count >= target) { count = target; clearInterval(i); }}, 30)">
                        Rp <span x-text="new Intl.NumberFormat('id-ID').format(count)">0</span>
                    </div>
                    <p class="text-kasku-muted text-sm mt-2">Total Pemasukan Kas</p>
                </div>

                {{-- Stat 3 --}}
                <div class="stat-card reveal reveal-delay-2" x-intersect.once="$el.classList.add('visible')">
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 20a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><path d="M12 11v5"/><path d="M10 13h4"/></svg>
                    </div>
                    <div class="stat-number" x-data="{ count: 0, target: 3200000 }" x-intersect.once="let i = setInterval(() => { count += 80000; if(count >= target) { count = target; clearInterval(i); }}, 30)">
                        Rp <span x-text="new Intl.NumberFormat('id-ID').format(count)">0</span>
                    </div>
                    <p class="text-kasku-muted text-sm mt-2">Tabungan Study Tour</p>
                </div>

                {{-- Stat 4 --}}
                <div class="stat-card reveal reveal-delay-3" x-intersect.once="$el.classList.add('visible')">
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <div class="stat-number" x-data="{ count: 0, target: 87 }" x-intersect.once="let i = setInterval(() => { count += 2; if(count >= target) { count = target; clearInterval(i); }}, 40)">
                        <span x-text="count">0</span>%
                    </div>
                    <p class="text-kasku-muted text-sm mt-2">Pembayaran Lunas</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════
         FITUR UTAMA
         ═══════════════════════════════════════════ --}}
    <section id="fitur" class="relative py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 reveal" x-intersect.once="$el.classList.add('visible')">
                <div class="section-label mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                    Fitur Utama
                </div>
                <h2 class="section-title text-kasku-text mt-4">
                    Semua yang Anda Butuhkan<br>
                    <span class="gradient-text">dalam Satu Platform</span>
                </h2>
                <p class="section-subtitle mt-4">
                    KASKU menyediakan fitur lengkap untuk mengelola keuangan kas kelas secara efisien dan transparan.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- Feature 1 --}}
                <div class="glass-card rounded-xl p-6 reveal" x-intersect.once="$el.classList.add('visible')">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-kasku-text mb-2">Monitoring Real-time</h3>
                    <p class="text-kasku-muted text-sm leading-relaxed">Pantau status pembayaran kas dan tabungan study tour secara real-time dengan data yang selalu ter-update.</p>
                </div>

                {{-- Feature 2 --}}
                <div class="glass-card rounded-xl p-6 reveal reveal-delay-1" x-intersect.once="$el.classList.add('visible')">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-kasku-text mb-2">Pembayaran Kas Bulanan</h3>
                    <p class="text-kasku-muted text-sm leading-relaxed">Bayar iuran kas bulanan dengan mudah. Pilih periode pembayaran dan selesaikan transaksi secara digital.</p>
                </div>

                {{-- Feature 3 --}}
                <div class="glass-card rounded-xl p-6 reveal reveal-delay-2" x-intersect.once="$el.classList.add('visible')">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 20a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><path d="M12 11v5"/><path d="M10 13h4"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-kasku-text mb-2">Tabungan Study Tour</h3>
                    <p class="text-kasku-muted text-sm leading-relaxed">Kelola tabungan study tour kelas dengan target yang jelas dan progres yang dapat dipantau setiap saat.</p>
                </div>

                {{-- Feature 4 --}}
                <div class="glass-card rounded-xl p-6 reveal reveal-delay-1" x-intersect.once="$el.classList.add('visible')">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.376 3.622a1 1 0 0 1 3.002 3.002L7.368 18.635a2 2 0 0 1-.855.506l-2.872.838a.5.5 0 0 1-.62-.62l.838-2.872a2 2 0 0 1 .506-.854z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-kasku-text mb-2">Riwayat Pembayaran</h3>
                    <p class="text-kasku-muted text-sm leading-relaxed">Akses riwayat lengkap semua pembayaran yang pernah dilakukan, lengkap dengan tanggal, nominal, dan status.</p>
                </div>

                {{-- Feature 5 --}}
                <div class="glass-card rounded-xl p-6 reveal reveal-delay-2" x-intersect.once="$el.classList.add('visible')">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 18v-4"/><path d="M14 18v-2"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-kasku-text mb-2">Laporan Keuangan</h3>
                    <p class="text-kasku-muted text-sm leading-relaxed">Lihat laporan pemasukan dan pengeluaran kas kelas secara detail dengan visualisasi grafik yang mudah dipahami.</p>
                </div>

                {{-- Feature 6 --}}
                <div class="glass-card rounded-xl p-6 reveal reveal-delay-3" x-intersect.once="$el.classList.add('visible')">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-kasku-text mb-2">Status Pembayaran</h3>
                    <p class="text-kasku-muted text-sm leading-relaxed">Cek status pembayaran setiap anggota kelas secara transparan. Lunas atau belum lunas, semuanya tercatat rapi.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════
         MONITORING KAS (Preview Table)
         ═══════════════════════════════════════════ --}}
    <section id="monitoring" class="relative py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 reveal" x-intersect.once="$el.classList.add('visible')">
                <div class="section-label mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
                    Monitoring Kas
                </div>
                <h2 class="section-title text-kasku-text mt-4">
                    Pantau Pembayaran<br>
                    <span class="gradient-text">Setiap Anggota</span>
                </h2>
                <p class="section-subtitle mt-4">
                    Data kas kelas ditampilkan secara transparan dengan tabel monitoring yang mudah dibaca.
                </p>
            </div>

            <div class="table-container reveal" x-intersect.once="$el.classList.add('visible')">
            @php
                use App\Models\AkunUser;
                use App\Models\Periode;
                use App\Models\PembayaranIuran;
                use App\Models\Transaksi;
                
                $students = collect();
                $periods = collect();
                $totalPemasukan = 0;
                $totalPengeluaran = 0;
                
                try {
                    if (\Illuminate\Support\Facades\Schema::hasTable('akun_user')) {
                        $students = AkunUser::all();
                    }
                    if (\Illuminate\Support\Facades\Schema::hasTable('periode')) {
                        $monthOrder = ['Januari'=>1,'Februari'=>2,'Maret'=>3,'April'=>4,'Mei'=>5,'Juni'=>6,
                                       'Juli'=>7,'Agustus'=>8,'September'=>9,'Oktober'=>10,'November'=>11,'Desember'=>12];
                        $periods = Periode::all()->sortBy(function($p) use ($monthOrder) {
                            return (($p->tahun ?? 2026) * 100) + ($monthOrder[$p->bulan] ?? 0);
                        })->values();
                    }
                    if (\Illuminate\Support\Facades\Schema::hasTable('pembayaran_iuran')) {
                        $totalPemasukan += PembayaranIuran::where('status_bayar', 'Lunas')->sum('jumlah_bayar');
                    }
                    if (\Illuminate\Support\Facades\Schema::hasTable('transaksi')) {
                        $totalPemasukan += Transaksi::where('jenis_transaksi', 'Pemasukan')->sum('jumlah');
                        $totalPengeluaran += Transaksi::where('jenis_transaksi', 'Pengeluaran')->sum('jumlah');
                    }
                } catch (\Throwable $e) {}
                $saldo = max(0, $totalPemasukan - $totalPengeluaran);
            @endphp

            {{-- Table Controls --}}
            <div class="flex flex-col md:flex-row gap-4 p-4 lg:p-6 border-b border-kasku-border">
                <div class="relative flex-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-3 top-1/2 -translate-y-1/2 text-kasku-muted"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    <input type="text" placeholder="Cari anggota..." class="search-input" id="search-member" oninput="updateLandingMonitoringTable()">
                </div>
                <div class="flex gap-3">
                    <select class="filter-select" id="filter-period" onchange="updateLandingMonitoringTable()">
                        <option value="">Semua Periode</option>
                        @foreach($periods as $p)
                            <option value="{{ $p->id_periode }}">{{ $p->bulan }} {{ $p->tahun }}</option>
                        @endforeach
                    </select>
                    <select class="filter-select" id="filter-type" onchange="updateLandingMonitoringTable()">
                        <option value="">Semua Jenis</option>
                        <option value="1">Kas Bulanan</option>
                        <option value="2">Tabungan Study Tour</option>
                    </select>
                </div>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="table-header text-kasku-muted text-left">
                            <th class="py-3 px-4 lg:px-6 font-semibold">Nama Anggota</th>
                            <th class="py-3 px-4 lg:px-6 font-semibold">Kas Bulanan</th>
                            <th class="py-3 px-4 lg:px-6 font-semibold">Tabungan Study Tour</th>
                            <th class="py-3 px-4 lg:px-6 font-semibold">Total Pembayaran</th>
                            <th class="py-3 px-4 lg:px-6 font-semibold">Sisa Tagihan</th>
                            <th class="py-3 px-4 lg:px-6 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                        @php
                            $payments = $student->pembayaranIuran()->where('status_bayar', 'Lunas')->get()->map(function($p) {
                                return [
                                    'id_iuran' => $p->id_iuran,
                                    'id_periode' => $p->id_periode,
                                    'jumlah_bayar' => (float)$p->jumlah_bayar,
                                ];
                            });
                        @endphp
                        <tr class="table-row landing-monitoring-row" 
                            data-name="{{ strtolower($student->nama_user) }}"
                            data-payments='@json($payments)'>
                            <td class="py-3 px-4 lg:px-6 text-kasku-text font-medium">{{ $student->nama_user }}</td>
                            <td class="py-3 px-4 lg:px-6 text-kasku-muted cell-kas">Rp 0</td>
                            <td class="py-3 px-4 lg:px-6 text-kasku-muted cell-tour">Rp 0</td>
                            <td class="py-3 px-4 lg:px-6 text-kasku-text cell-total">Rp 0</td>
                            <td class="py-3 px-4 lg:px-6 cell-sisa">Rp 0</td>
                            <td class="py-3 px-4 lg:px-6 cell-status">
                                <span class="badge-belum">Belum Lunas</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-kasku-muted">Belum ada data anggota.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Table Footer --}}
            <div class="p-4 lg:p-6 border-t border-kasku-border flex items-center justify-between text-sm text-kasku-muted">
                <span id="landing-display-count">Menampilkan 0 dari 0 anggota</span>
                <a href="{{ route('monitoring.kas') }}" class="text-kasku-accent hover:text-kasku-accent-light transition-colors font-medium">
                    Lihat Selengkapnya →
                </a>
            </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════
         LAPORAN KEUANGAN
         ═══════════════════════════════════════════ --}}
    <section id="laporan" class="relative py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 reveal" x-intersect.once="$el.classList.add('visible')">
                <div class="section-label mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/></svg>
                    Laporan Keuangan
                </div>
                <h2 class="section-title text-kasku-text mt-4">
                    Laporan Transparan<br>
                    <span class="gradient-text">& Mudah Dipahami</span>
                </h2>
                <p class="section-subtitle mt-4">
                    Pantau pemasukan dan pengeluaran kas kelas dengan laporan yang akurat dan visualisasi yang informatif.
                </p>
            </div>

            @php
                $laporanPemasukan = 0;
                $laporanPengeluaran = 0;
                $recentTransactions = collect();
                $recentPayments = collect();
                try {
                    if (\Illuminate\Support\Facades\Schema::hasTable('pembayaran_iuran')) {
                        $laporanPemasukan += \App\Models\PembayaranIuran::where('status_bayar','Lunas')->sum('jumlah_bayar');
                        $recentPayments = \App\Models\PembayaranIuran::with(['jenisIuran','user'])->where('status_bayar','Lunas')->latest('tanggal_bayar')->take(3)->get();
                    }
                    if (\Illuminate\Support\Facades\Schema::hasTable('transaksi')) {
                        $laporanPemasukan += \App\Models\Transaksi::where('jenis_transaksi','Pemasukan')->sum('jumlah');
                        $laporanPengeluaran += \App\Models\Transaksi::where('jenis_transaksi','Pengeluaran')->sum('jumlah');
                        $recentTransactions = \App\Models\Transaksi::with('kategori')->latest('tanggal_transaksi')->take(3)->get();
                    }
                } catch (\Throwable $e) {}
                $laporanSaldo = max(0, $laporanPemasukan - $laporanPengeluaran);
            @endphp

            <div class="grid lg:grid-cols-3 gap-6 mb-8">
                {{-- Pemasukan --}}
                <div class="report-card reveal" x-intersect.once="$el.classList.add('visible')">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-lg bg-green-500/15 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4ADE80" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14"/><path d="m19 12-7 7-7-7"/></svg>
                        </div>
                        <span class="text-kasku-muted text-sm">Total Pemasukan</span>
                    </div>
                    <p class="text-2xl font-bold text-green-400">Rp {{ number_format($laporanPemasukan, 0, ',', '.') }}</p>
                    <p class="text-xs text-green-400/60 mt-1">Iuran kas + tabungan study tour</p>
                </div>

                {{-- Pengeluaran --}}
                <div class="report-card reveal reveal-delay-1" x-intersect.once="$el.classList.add('visible')">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-lg bg-red-500/15 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F87171" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19V5"/><path d="m5 12 7-7 7 7"/></svg>
                        </div>
                        <span class="text-kasku-muted text-sm">Total Pengeluaran</span>
                    </div>
                    <p class="text-2xl font-bold text-red-400">Rp {{ number_format($laporanPengeluaran, 0, ',', '.') }}</p>
                    <p class="text-xs text-red-400/60 mt-1">Pengeluaran operasional kelas</p>
                </div>

                {{-- Saldo --}}
                <div class="report-card reveal reveal-delay-2" x-intersect.once="$el.classList.add('visible')">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-lg bg-kasku-gold-glow flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#DCC070" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                        </div>
                        <span class="text-kasku-muted text-sm">Saldo Kas Saat Ini</span>
                    </div>
                    <p class="text-2xl font-bold gradient-text">Rp {{ number_format($laporanSaldo, 0, ',', '.') }}</p>
                    <p class="text-xs text-kasku-accent/60 mt-1">{{ $laporanSaldo > 0 ? 'Kas dalam kondisi sehat' : 'Cek laporan kas' }}</p>
                </div>
            </div>

            {{-- Recent Transactions (from real DB) --}}
            <div class="table-container p-6 reveal" x-intersect.once="$el.classList.add('visible')">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-kasku-text">Transaksi & Pembayaran Terbaru</h3>
                    <span class="text-xs text-kasku-muted">Data real-time</span>
                </div>

                <div class="space-y-3">
                    {{-- Recent payments from pembayaran_iuran --}}
                    @forelse($recentPayments as $pay)
                        <div class="flex items-center justify-between py-2 border-b border-white/5 last:border-0">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-green-500/15 flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4ADE80" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14"/><path d="m19 12-7 7-7-7"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm text-kasku-text font-medium">
                                        {{ optional($pay->jenisIuran)->nama_iuran ?? 'Pembayaran' }}
                                        @if($pay->user) — {{ $pay->user->nama_user }} @endif
                                    </p>
                                    <p class="text-xs text-kasku-muted">{{ \Carbon\Carbon::parse($pay->tanggal_bayar)->translatedFormat('d F Y') }}</p>
                                </div>
                            </div>
                            <span class="text-sm text-green-400 font-semibold shrink-0">+ Rp {{ number_format($pay->jumlah_bayar, 0, ',', '.') }}</span>
                        </div>
                    @empty
                        {{-- Fallback if no payments --}}
                        <p class="text-center text-kasku-muted text-sm py-4">Belum ada data pembayaran terbaru.</p>
                    @endforelse

                    {{-- Recent pengeluaran from transaksi --}}
                    @foreach($recentTransactions->where('jenis_transaksi','Pengeluaran')->take(2) as $trx)
                        <div class="flex items-center justify-between py-2 border-b border-white/5 last:border-0">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-red-500/15 flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#F87171" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19V5"/><path d="m5 12 7-7 7 7"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm text-kasku-text font-medium">{{ $trx->keterangan ?? optional($trx->kategori)->nama_kategori ?? 'Pengeluaran' }}</p>
                                    <p class="text-xs text-kasku-muted">{{ \Carbon\Carbon::parse($trx->tanggal_transaksi)->translatedFormat('d F Y') }}</p>
                                </div>
                            </div>
                            <span class="text-sm text-red-400 font-semibold shrink-0">- Rp {{ number_format($trx->jumlah, 0, ',', '.') }}</span>
                        </div>
                    @endforeach

                    @if($recentPayments->isEmpty() && $recentTransactions->isEmpty())
                        <div class="flex flex-col items-center justify-center py-8 text-kasku-muted gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="opacity-40"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/></svg>
                            <p class="text-sm">Belum ada transaksi.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════
         KONTAK
         ═══════════════════════════════════════════ --}}
    <section id="kontak" class="relative py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 reveal" x-intersect.once="$el.classList.add('visible')">
                <div class="section-label mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92Z"/></svg>
                    Kontak
                </div>
                <h2 class="section-title text-kasku-text mt-4">
                    Ada Pertanyaan?<br>
                    <span class="gradient-text">Hubungi Kami</span>
                </h2>
                <p class="section-subtitle mt-4">
                    Jika ada keluhan atau pertanyaan, jangan ragu untuk menghubungi kami.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-6 max-w-2xl mx-auto">
                {{-- Email --}}
                <div class="contact-card reveal" x-intersect.once="$el.classList.add('visible')">
                    <div class="contact-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-kasku-text mb-2">Email Admin</h3>
                    <a href="mailto:admin@kasku.app" class="text-kasku-accent hover:text-kasku-accent-light transition-colors">admin@kasku.app</a>
                </div>

                {{-- WhatsApp --}}
                <div class="contact-card reveal reveal-delay-1" x-intersect.once="$el.classList.add('visible')">
                    <div class="contact-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92Z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-kasku-text mb-2">WhatsApp Admin</h3>
                    <a href="https://wa.me/6281234567890" target="_blank" class="text-kasku-accent hover:text-kasku-accent-light transition-colors">+62 812-3456-7890</a>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════
         FOOTER
         ═══════════════════════════════════════════ --}}
    <footer class="footer py-12 lg:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-10 mb-10">
                {{-- Brand --}}
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('images/logo_kas.png') }}" alt="KASKU Logo" class="h-10 w-auto">
                    </div>
                    <p class="text-kasku-muted text-sm leading-relaxed max-w-xs">
                        KASKU membantu mengelola iuran, transaksi, pembayaran, dan laporan keuangan kas kelas secara terpusat, aman, dan efisien.
                    </p>
                </div>

                {{-- Navigation --}}
                <div>
                    <h4 class="text-sm font-semibold text-kasku-text mb-4 uppercase tracking-wider">Navigasi</h4>
                    <ul class="space-y-2">
                        <li><a href="#home" class="footer-link">Home</a></li>
                        <li><a href="#fitur" class="footer-link">Fitur</a></li>
                        <li><a href="#monitoring" class="footer-link">Monitoring Kas</a></li>
                        <li><a href="#laporan" class="footer-link">Laporan</a></li>
                        <li><a href="#kontak" class="footer-link">Kontak</a></li>
                    </ul>
                </div>

                {{-- Contact --}}
                <div>
                    <h4 class="text-sm font-semibold text-kasku-text mb-4 uppercase tracking-wider">Kontak</h4>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#DCC070" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                            <a href="mailto:admin@kasku.app" class="footer-link">admin@kasku.app</a>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#DCC070" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92Z"/></svg>
                            <a href="https://wa.me/6281234567890" target="_blank" class="footer-link">+62 812-3456-7890</a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Divider & Copyright --}}
            <div class="border-t border-kasku-border pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-sm text-kasku-muted">&copy; 2026 KASKU. All rights reserved.</p>
                <div class="flex items-center gap-1 text-xs text-kasku-muted">
                    <span>Made with</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="#DCC070" stroke="none"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3.332.649-4.5 1.71A5.5 5.5 0 0 0 7.5 3 5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                    <span>by KASKU Team</span>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function updateLandingMonitoringTable() {
            const periodId = document.getElementById('filter-period').value;
            const typeId = document.getElementById('filter-type').value;
            const searchQuery = document.getElementById('search-member').value.toLowerCase();
            const rows = document.querySelectorAll('.landing-monitoring-row');
            
            const totalPeriods = {{ $periods->count() }};
            
            let visibleCount = 0;

            rows.forEach(row => {
                const name = row.getAttribute('data-name');
                const payments = JSON.parse(row.getAttribute('data-payments') || '[]');

                // Filter payments based on selection
                let filteredPayments = payments;
                if (periodId) {
                    filteredPayments = filteredPayments.filter(p => p.id_periode == periodId);
                }
                if (typeId) {
                    filteredPayments = filteredPayments.filter(p => p.id_iuran == typeId);
                }

                // Calculate paid values
                const kasPaid = filteredPayments.filter(p => p.id_iuran == 1).reduce((sum, p) => sum + p.jumlah_bayar, 0);
                const tourPaid = filteredPayments.filter(p => p.id_iuran == 2).reduce((sum, p) => sum + p.jumlah_bayar, 0);
                const totalPaid = kasPaid + tourPaid;

                // Calculate targets
                let targetKas = 0;
                let targetTour = 0;

                if (periodId) {
                    if (!typeId || typeId == 1) targetKas = 10000;
                    if (!typeId || typeId == 2) targetTour = 50000;
                } else {
                    if (!typeId || typeId == 1) targetKas = totalPeriods * 10000;
                    if (!typeId || typeId == 2) targetTour = totalPeriods * 50000;
                }

                const target = targetKas + targetTour;
                const sisa = Math.max(0, target - totalPaid);
                const status = sisa <= 0 ? 'Lunas' : 'Belum Lunas';

                // Update DOM cells
                row.querySelector('.cell-kas').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(kasPaid);
                row.querySelector('.cell-tour').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(tourPaid);
                row.querySelector('.cell-total').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalPaid);
                
                const sisaCell = row.querySelector('.cell-sisa');
                sisaCell.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(sisa);
                if (sisa > 0) {
                    sisaCell.className = 'py-3 px-4 lg:px-6 text-red-400 cell-sisa';
                } else {
                    sisaCell.className = 'py-3 px-4 lg:px-6 text-kasku-muted cell-sisa';
                }

                const statusCell = row.querySelector('.cell-status');
                if (status === 'Lunas') {
                    statusCell.innerHTML = '<span class="badge-lunas">Lunas</span>';
                } else {
                    statusCell.innerHTML = '<span class="badge-belum">Belum Lunas</span>';
                }

                // Search filtering
                const nameMatch = name.includes(searchQuery);
                if (nameMatch) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Update display count text
            const countText = document.getElementById('landing-display-count');
            if (countText) {
                countText.textContent = `Menampilkan ${visibleCount} dari ${rows.length} anggota`;
            }
        }

        // Run once on load to initialize correct values
        document.addEventListener('DOMContentLoaded', () => {
            // Set default filter values to Jan / Kas Bulanan if desired or keep all
            document.getElementById('filter-period').value = "1"; // Set to Januari 2026 by default
            document.getElementById('filter-type').value = "1"; // Set to Kas Bulanan by default
            updateLandingMonitoringTable();
        });
    </script>
</body>
</html>
