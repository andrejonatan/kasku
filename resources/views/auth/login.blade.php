<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - KASKU</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="antialiased min-h-screen flex items-center justify-center relative overflow-hidden" style="background-color: #020617;">

    {{-- Background Glows --}}
    <div class="hero-glow -top-20 -left-40"></div>
    <div class="hero-glow-gold top-1/3 -right-20"></div>

    <div class="w-full max-w-[420px] px-6 relative z-10 animate-fade-in-up">
        
        {{-- Logo --}}
        <div class="flex justify-center mb-8">
            <a href="/" class="flex items-center gap-3">
                <img src="{{ asset('images/logo_kas.png') }}" alt="KASKU Logo" class="h-16 w-auto">
            </a>
        </div>

        <div class="glass-card rounded-2xl p-8 w-full shadow-2xl">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-white mb-2">Selamat Datang Kembali</h1>
                <p class="text-kasku-muted text-sm">Masuk ke Portal Anggota KASKU</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-500/10 border border-red-500/50 rounded-lg p-4 mb-6">
                    <div class="flex items-center gap-3 text-red-400 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <span>{{ $errors->first() }}</span>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="username" class="block text-sm font-medium text-kasku-muted mb-1.5">Username / Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-kasku-muted"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </div>
                        <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus class="search-input w-full pl-10" placeholder="Masukkan username atau email">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-kasku-muted mb-1.5">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-kasku-muted"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </div>
                        <input id="password" type="password" name="password" required class="search-input w-full pl-10" placeholder="••••••••">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="btn-primary w-full justify-center py-3">
                        Masuk
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center text-sm text-kasku-muted">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-kasku-accent hover:text-kasku-accent-light transition-colors font-medium">Daftar sekarang</a>
            </div>
            
            <div class="mt-4 text-center text-xs text-kasku-muted/60">
                <a href="/admin/login" class="hover:text-kasku-muted transition-colors">Masuk sebagai Admin/Bendahara</a>
            </div>
        </div>
    </div>

</body>
</html>
