<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - KASKU</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="antialiased min-h-screen flex items-center justify-center relative py-12 px-4" style="background-color: #020617;">

    {{-- Background Glows --}}
    <div class="hero-glow top-0 -left-40"></div>
    <div class="hero-glow-gold bottom-0 -right-20"></div>

    <div class="w-full max-w-[420px] px-6 relative z-10 animate-fade-in-up">
        
        {{-- Logo --}}
        <div class="flex justify-center mb-8">
            <a href="/" class="flex items-center gap-3">
                <img src="{{ asset('images/logo_kas.png') }}" alt="KASKU Logo" class="h-16 w-auto">
            </a>
        </div>

        <div class="glass-card rounded-2xl p-8 shadow-2xl">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-white mb-2">Buat Akun KASKU</h1>
                <p class="text-kasku-muted text-sm">Bergabung untuk mengelola kas kelas dengan mudah</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-500/10 border border-red-500/50 rounded-lg p-4 mb-6">
                    <ul class="list-disc list-inside text-red-400 text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div class="space-y-4">
                    {{-- Nama User --}}
                    <div>
                        <label for="nama_user" class="block text-sm font-medium text-kasku-muted mb-1.5">Nama Lengkap</label>
                        <input id="nama_user" type="text" name="nama_user" value="{{ old('nama_user') }}" required autofocus class="search-input w-full" placeholder="Cth: Ahmad Rizky">
                    </div>

                    {{-- Username --}}
                    <div>
                        <label for="username" class="block text-sm font-medium text-kasku-muted mb-1.5">Username</label>
                        <input id="username" type="text" name="username" value="{{ old('username') }}" required class="search-input w-full" placeholder="Cth: ahmadrizky">
                    </div>

                    {{-- NIM --}}
                    <div>
                        <label for="nim" class="block text-sm font-medium text-kasku-muted mb-1.5">NIM / NIS</label>
                        <input id="nim" type="text" name="nim" value="{{ old('nim') }}" required class="search-input w-full" placeholder="Nomor Induk Siswa/Mahasiswa">
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-kasku-muted mb-1.5">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required class="search-input w-full" placeholder="Cth: ahmad@example.com">
                    </div>

                    {{-- No HP --}}
                    <div>
                        <label for="no_hp" class="block text-sm font-medium text-kasku-muted mb-1.5">Nomor HP</label>
                        <input id="no_hp" type="text" name="no_hp" value="{{ old('no_hp') }}" required class="search-input w-full" placeholder="Cth: 081234567890">
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-medium text-kasku-muted mb-1.5">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" required class="filter-select w-full bg-[#11122b] border-[#003291]/20">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm font-medium text-kasku-muted mb-1.5">Password</label>
                        <input id="password" type="password" name="password" required class="search-input w-full" placeholder="Minimal 8 karakter">
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-kasku-muted mb-1.5">Konfirmasi Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required class="search-input w-full" placeholder="Ulangi password">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="btn-primary w-full justify-center py-3">
                        Daftar Akun
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center text-sm text-kasku-muted">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-kasku-accent hover:text-kasku-accent-light transition-colors font-medium">Masuk di sini</a>
            </div>
        </div>
    </div>

</body>
</html>
