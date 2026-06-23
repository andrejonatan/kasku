<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pembayaran Tabungan Study Tour - KASKU</title>
    <meta name="description" content="Form pembayaran tabungan study tour kelas.">
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

    <div class="min-h-screen flex flex-col justify-center w-full max-w-lg mx-auto px-6 py-12 relative z-10">

        {{-- Back button --}}
        <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-kasku-muted hover:text-kasku-accent transition-colors text-sm mb-8 group">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:-translate-x-1 transition-transform"><path d="m15 18-6-6 6-6"/></svg>
            Kembali ke Beranda
        </a>

        {{-- Logo --}}
        <div class="flex justify-center mb-8">
            <a href="/" class="flex items-center gap-3">
                <img src="{{ asset('images/logo_kas.png') }}" alt="KASKU Logo" class="h-14 w-auto">
            </a>
        </div>

        <div class="glass-card rounded-2xl p-8 w-full shadow-2xl">
            {{-- Header --}}
            <div class="flex items-center gap-4 mb-8">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, rgba(220,192,112,0.2), rgba(180,140,60,0.1)); border: 1px solid rgba(220,192,112,0.3);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#DCC070" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 20a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><path d="M12 11v5"/><path d="M10 13h4"/></svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-white">Tabungan Study Tour</h1>
                    <p class="text-kasku-muted text-sm">Tabungan kegiatan study tour kelas</p>
                </div>
            </div>

            {{-- User Info Card --}}
            <div class="bg-white/5 border border-white/10 rounded-xl p-4 mb-6 flex items-center gap-4">
                @if($user->foto_profil)
                    <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="{{ $user->nama_user }}" class="w-10 h-10 rounded-full object-cover shrink-0">
                @else
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-sm shrink-0" style="background: linear-gradient(135deg, #DCC070, #B8922A);">
                        {{ strtoupper(substr($user->nama_user, 0, 2)) }}
                    </div>
                @endif
                <div>
                    <p class="text-kasku-text font-semibold text-sm">{{ $user->nama_user }}</p>
                    <p class="text-kasku-muted text-xs">NIM: {{ $user->nim }} · {{ $user->role }}</p>
                </div>
                <div class="ml-auto">
                    <span class="text-xs px-2 py-1 rounded-full border" style="background: rgba(220,192,112,0.15); color: #DCC070; border-color: rgba(220,192,112,0.3);">Terautentikasi</span>
                </div>
            </div>

            {{-- Iuran Info --}}
            @if($iuran)
            <div class="rounded-xl p-4 mb-6" style="background: rgba(220,192,112,0.1); border: 1px solid rgba(220,192,112,0.3);">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-semibold text-sm" style="color: #DCC070;">{{ $iuran->nama_iuran }}</p>
                        <p class="text-kasku-muted text-xs mt-0.5">{{ $iuran->keterangan }}</p>
                    </div>
                    <p class="text-white font-bold text-lg">Rp {{ number_format($iuran->nominal, 0, ',', '.') }}</p>
                </div>
            </div>
            @endif

            {{-- Flash Message --}}
            @if (session('status'))
                <div class="bg-green-500/10 border border-green-500/50 rounded-lg p-4 mb-6 text-green-400 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Errors --}}
            @isset($errors)
                @if ($errors->any())
                    <div class="bg-red-500/10 border border-red-500/50 rounded-lg p-4 mb-6 text-red-400 text-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endisset


            <form method="POST" action="{{ route('payment.tour.post') }}" class="space-y-5">
                @csrf

                {{-- Periode --}}
                <div>
                    <label for="id_periode" class="block text-sm font-medium text-kasku-muted mb-1.5">Periode Pembayaran</label>
                    <select id="id_periode" name="id_periode" required class="filter-select w-full">
                        <option value="">-- Pilih Periode --</option>
                        @foreach($periods as $periode)
                            <option value="{{ $periode->id_periode }}" {{ old('id_periode') == $periode->id_periode ? 'selected' : '' }}>
                                {{ $periode->bulan }} {{ $periode->tahun }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Jumlah Bayar --}}
                <div>
                    <label for="amount" class="block text-sm font-medium text-kasku-muted mb-1.5">Jumlah Pembayaran (Rp)</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-kasku-muted text-sm font-medium">Rp</span>
                        <input id="amount" type="number" name="amount" step="0.01" min="0.01"
                               value="{{ old('amount', $iuran ? $iuran->nominal : '') }}"
                               required
                               class="search-input w-full pl-10"
                               placeholder="50000">
                    </div>
                    <p class="text-xs text-kasku-muted mt-1">Nominal standar: Rp {{ $iuran ? number_format($iuran->nominal, 0, ',', '.') : '0' }}</p>
                </div>

                {{-- Submit --}}
                <div class="pt-2">
                    <button type="submit" id="btn-bayar-tour" class="btn-gold w-full justify-center py-3 text-sm font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        Bayar Sekarang
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center text-xs text-kasku-muted">
                Ingin membayar Kas Bulanan?
                <a href="{{ route('payment.kas') }}" class="text-kasku-accent hover:text-kasku-accent-light transition-colors font-medium">Klik di sini</a>
            </div>
        </div>
    </div>

</body>
</html>
