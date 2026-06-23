<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Saya - KASKU</title>
    <meta name="description" content="Halaman profil pengguna KASKU.">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="antialiased min-h-screen relative" style="background-color: #020617;">

    {{-- Background Glows --}}
    <div class="hero-glow -top-20 -left-40"></div>
    <div class="hero-glow-gold top-1/3 -right-20"></div>

    {{-- Navbar --}}
    <nav class="navbar fixed top-0 left-0 right-0 z-50" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="/" class="flex items-center gap-3 shrink-0">
                    <img src="{{ asset('images/logo_kas.png') }}" alt="KASKU Logo" class="h-9 w-auto">
                </a>
                <div class="flex items-center gap-3">
                    @if($user->jabatan && $user->jabatan->nama_jabatan === 'Admin')
                        <a href="/admin" class="btn-gold text-sm py-2 px-4">
                            <span>Dashboard Admin</span>
                        </a>
                    @endif
                    <a href="{{ url('/') }}" class="btn-outline text-sm py-2 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        <span>Beranda</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="btn-outline text-sm py-2 px-4 border-red-500/40 hover:border-red-400 hover:text-red-400 hover:bg-red-500/10 cursor-pointer">
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="relative z-10 pt-24 pb-16 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">

        {{-- Page Header --}}
        <div class="mb-10">
            <div class="section-label mb-4 inline-flex">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Akun Saya
            </div>
            <h1 class="text-3xl font-extrabold text-kasku-text">Profil <span class="gradient-text">Pengguna</span></h1>
            <p class="text-kasku-muted mt-2">Informasi akun dan riwayat pembayaran Anda.</p>
        </div>

        <div class="grid lg:grid-cols-3 gap-6">

            {{-- LEFT: Profile Card --}}
            <div class="lg:col-span-1 space-y-5">

                {{-- Avatar & name --}}
                <div class="glass-card rounded-2xl p-6 text-center">
                    {{-- Flash Message & Errors --}}
                    @if (session('status'))
                        <div class="bg-green-500/10 border border-green-500/30 rounded-lg p-2 mb-4 text-green-400 text-xs text-center">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="bg-red-500/10 border border-red-500/30 rounded-lg p-2 mb-4 text-red-400 text-xs text-center">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <div class="relative w-20 h-20 mx-auto mb-2 group">
                        @if($user->foto_profil)
                            <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="{{ $user->nama_user }}" class="w-20 h-20 rounded-full object-cover border-2 border-kasku-accent/50 group-hover:border-kasku-accent transition-all duration-300">
                        @else
                            <div class="w-20 h-20 rounded-full flex items-center justify-center text-white text-2xl font-extrabold transition-all duration-300" style="background: linear-gradient(135deg, #3B82F6, #DCC070);">
                                {{ strtoupper(substr($user->nama_user, 0, 2)) }}
                            </div>
                        @endif
                    </div>

                    {{-- Form to upload new photo --}}
                    <form action="{{ route('profile.photo.update') }}" method="POST" enctype="multipart/form-data" class="mb-4">
                        @csrf
                        <label for="foto_profil" class="inline-flex items-center gap-1.5 cursor-pointer text-xs text-kasku-accent hover:text-kasku-accent-light transition-colors font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                            Ubah Foto Profil
                        </label>
                        <input type="file" id="foto_profil" name="foto_profil" accept="image/*" class="hidden" onchange="this.form.submit()">
                    </form>

                    <h2 class="text-kasku-text text-xl font-bold">{{ $user->nama_user }}</h2>
                    <p class="text-kasku-muted text-sm mt-1">{{ $user->username }}</p>
                    <div class="mt-3">
                        @if($user->role === 'Admin')
                            <span class="px-3 py-1 rounded-full text-xs font-semibold" style="background: rgba(220,192,112,0.2); color: #DCC070; border: 1px solid rgba(220,192,112,0.4);">Admin</span>
                        @elseif($user->role === 'Bendahara')
                            <span class="px-3 py-1 rounded-full text-xs font-semibold" style="background: rgba(59,130,246,0.2); color: #60a5fa; border: 1px solid rgba(59,130,246,0.4);">Bendahara</span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-semibold" style="background: rgba(74,222,128,0.15); color: #4ade80; border: 1px solid rgba(74,222,128,0.3);">Anggota</span>
                        @endif
                    </div>
                </div>

                {{-- Info --}}
                <div class="glass-card rounded-2xl p-6 space-y-4">
                    <h3 class="text-kasku-text font-semibold text-sm uppercase tracking-wider mb-2">Informasi Akun</h3>

                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg shrink-0 flex items-center justify-center" style="background: rgba(59,130,246,0.15);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#60a5fa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-kasku-muted">Email</p>
                            <p class="text-kasku-text text-sm font-medium break-all">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg shrink-0 flex items-center justify-center" style="background: rgba(220,192,112,0.15);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#DCC070" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-kasku-muted">NIM</p>
                            <p class="text-kasku-text text-sm font-medium">{{ $user->nim }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg shrink-0 flex items-center justify-center" style="background: rgba(74,222,128,0.15);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4ade80" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92Z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-kasku-muted">No. HP</p>
                            <p class="text-kasku-text text-sm font-medium">{{ $user->no_hp }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg shrink-0 flex items-center justify-center" style="background: rgba(168,85,247,0.15);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#a855f7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-kasku-muted">Jabatan</p>
                            <p class="text-kasku-text text-sm font-medium">{{ optional($user->jabatan)->nama_jabatan ?? 'Tidak ada' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg shrink-0 flex items-center justify-center" style="background: rgba(251,191,36,0.15);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-kasku-muted">Jenis Kelamin</p>
                            <p class="text-kasku-text text-sm font-medium">{{ $user->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Action buttons --}}
                <div class="flex flex-col gap-3">
                    <a href="{{ route('payment.kas') }}" id="btn-pay-kas" class="btn-gold py-2.5 justify-center text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                        Bayar Kas Bulanan
                    </a>
                    <a href="{{ route('payment.tour') }}" id="btn-pay-tour" class="btn-outline py-2.5 justify-center text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 20a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                        Bayar Study Tour
                    </a>
                </div>

            </div>

            {{-- RIGHT: Payment History --}}
            <div class="lg:col-span-2">

                {{-- Summary --}}
                @php
                    $payments    = $user->pembayaranIuran()->with(['jenisIuran','periode'])->orderByDesc('tanggal_bayar')->get();
                    $totalKas    = $payments->where('id_iuran', 1)->where('status_bayar', 'Lunas')->sum('jumlah_bayar');
                    $totalTour   = $payments->where('id_iuran', 2)->where('status_bayar', 'Lunas')->sum('jumlah_bayar');
                    $totalAll    = $totalKas + $totalTour;
                @endphp
                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div class="glass-card rounded-xl p-4">
                        <p class="text-xs text-kasku-muted mb-1">Total Kas</p>
                        <p class="text-kasku-text font-bold">Rp {{ number_format($totalKas, 0, ',', '.') }}</p>
                    </div>
                    <div class="glass-card rounded-xl p-4">
                        <p class="text-xs text-kasku-muted mb-1">Total Study Tour</p>
                        <p class="text-kasku-text font-bold">Rp {{ number_format($totalTour, 0, ',', '.') }}</p>
                    </div>
                    <div class="glass-card rounded-xl p-4">
                        <p class="text-xs text-kasku-muted mb-1">Total Semua</p>
                        <p class="gradient-text font-bold">Rp {{ number_format($totalAll, 0, ',', '.') }}</p>
                    </div>
                </div>

                {{-- History table --}}
                <div class="table-container">
                    <div class="p-5 border-b border-kasku-border">
                        <h3 class="text-kasku-text font-bold">Riwayat Pembayaran</h3>
                        <p class="text-kasku-muted text-sm mt-1">Semua transaksi yang pernah Anda lakukan.</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="table-header text-kasku-muted text-left">
                                    <th class="py-3 px-4 lg:px-5 font-semibold">Jenis Iuran</th>
                                    <th class="py-3 px-4 lg:px-5 font-semibold">Periode</th>
                                    <th class="py-3 px-4 lg:px-5 font-semibold">Tanggal</th>
                                    <th class="py-3 px-4 lg:px-5 font-semibold">Jumlah</th>
                                    <th class="py-3 px-4 lg:px-5 font-semibold">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($payments as $pay)
                                    <tr class="table-row">
                                        <td class="py-3 px-4 lg:px-5 text-kasku-text font-medium">
                                            <div class="flex items-center gap-2">
                                                @if($pay->id_iuran == 1)
                                                    <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0" style="background: rgba(59,130,246,0.15);">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#60a5fa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                                                    </div>
                                                @else
                                                    <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0" style="background: rgba(220,192,112,0.15);">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#DCC070" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 20a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2"/></svg>
                                                    </div>
                                                @endif
                                                {{ optional($pay->jenisIuran)->nama_iuran ?? '-' }}
                                            </div>
                                        </td>
                                        <td class="py-3 px-4 lg:px-5 text-kasku-muted">
                                            {{ optional($pay->periode)->bulan }} {{ optional($pay->periode)->tahun }}
                                        </td>
                                        <td class="py-3 px-4 lg:px-5 text-kasku-muted">
                                            {{ \Carbon\Carbon::parse($pay->tanggal_bayar)->format('d M Y') }}
                                        </td>
                                        <td class="py-3 px-4 lg:px-5 text-kasku-text font-semibold">
                                            Rp {{ number_format($pay->jumlah_bayar, 0, ',', '.') }}
                                        </td>
                                        <td class="py-3 px-4 lg:px-5">
                                            @if($pay->status_bayar === 'Lunas')
                                                <span class="badge-lunas">Lunas</span>
                                            @else
                                                <span class="badge-belum">Belum Lunas</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-12 text-center text-kasku-muted">
                                            <div class="flex flex-col items-center gap-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="opacity-40"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                                                <p>Belum ada riwayat pembayaran.</p>
                                                <a href="{{ route('payment.kas') }}" class="text-kasku-accent hover:underline text-sm">Lakukan pembayaran pertama →</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </main>

</body>
</html>
