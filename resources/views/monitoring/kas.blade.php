<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Monitoring Kas Kelas - KASKU</title>
    <meta name="description" content="Lihat data pembayaran kas dan study tour seluruh anggota kelas.">
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
                    @auth
                        <a href="{{ route('profile') }}" class="btn-outline text-sm py-2 px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            <span>Profil</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="btn-outline text-sm py-2 px-4 border-red-500/40 hover:border-red-400 hover:text-red-400 hover:bg-red-500/10 cursor-pointer">
                                <span>Logout</span>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn-outline text-sm py-2 px-4">Login</a>
                    @endauth
                    <a href="{{ url('/') }}" class="btn-outline text-sm py-2 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        <span>Beranda</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="relative z-10 pt-24 pb-16 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">

        {{-- Page Header --}}
        <div class="mb-10">
            <div class="section-label mb-4 inline-flex">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
                Monitoring Kas
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-kasku-text leading-tight">
                Data Pembayaran <span class="gradient-text">Seluruh Anggota</span>
            </h1>
            <p class="text-kasku-muted mt-3 text-base max-w-xl">
                Pantau status pembayaran kas dan tabungan study tour semua anggota kelas secara transparan.
            </p>
        </div>

        {{-- Summary Cards --}}
        @php
            $totalKas   = $monitoringData->sum('kas_paid');
            $totalTour  = $monitoringData->sum('tour_paid');
            $totalLunas = $monitoringData->where('status', 'Lunas')->count();
            $totalAll   = $monitoringData->count();
        @endphp
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
            <div class="stat-card">
                <div class="stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div class="stat-number text-3xl">{{ $totalAll }}</div>
                <p class="text-kasku-muted text-sm mt-1">Total Anggota</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
                <div class="stat-number text-2xl">Rp {{ number_format($totalKas, 0, ',', '.') }}</div>
                <p class="text-kasku-muted text-sm mt-1">Total Kas Terkumpul</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 20a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><path d="M12 11v5"/><path d="M10 13h4"/></svg>
                </div>
                <div class="stat-number text-2xl">Rp {{ number_format($totalTour, 0, ',', '.') }}</div>
                <p class="text-kasku-muted text-sm mt-1">Total Study Tour</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
                <div class="stat-number text-3xl">{{ $totalAll > 0 ? round($totalLunas/$totalAll*100) : 0 }}%</div>
                <p class="text-kasku-muted text-sm mt-1">Anggota Lunas</p>
            </div>
        </div>

        {{-- Table --}}
        <div class="table-container">
            {{-- Table Controls --}}
            <div class="flex flex-col md:flex-row gap-4 p-4 lg:p-6 border-b border-kasku-border">
                <div class="relative flex-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-3 top-1/2 -translate-y-1/2 text-kasku-muted"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    <input type="text" id="search-member-all" placeholder="Cari nama anggota..." class="search-input pl-10 w-full" oninput="filterTable(this.value)">
                </div>
                <div class="flex gap-3">
                    <select class="filter-select" id="filter-status" onchange="filterByStatus(this.value)">
                        <option value="">Semua Status</option>
                        <option value="Lunas">Lunas</option>
                        <option value="Belum Lunas">Belum Lunas</option>
                    </select>
                </div>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm" id="monitoring-table">
                    <thead>
                        <tr class="table-header text-kasku-muted text-left">
                            <th class="py-3 px-4 lg:px-6 font-semibold">#</th>
                            <th class="py-3 px-4 lg:px-6 font-semibold">Nama Anggota</th>
                            <th class="py-3 px-4 lg:px-6 font-semibold">Kas Bulanan</th>
                            <th class="py-3 px-4 lg:px-6 font-semibold">Tabungan Study Tour</th>
                            <th class="py-3 px-4 lg:px-6 font-semibold">Total Pembayaran</th>
                            <th class="py-3 px-4 lg:px-6 font-semibold">Sisa Tagihan</th>
                            <th class="py-3 px-4 lg:px-6 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody id="monitoring-tbody">
                        @forelse($monitoringData as $i => $data)
                            <tr class="table-row monitoring-row" data-name="{{ strtolower($data['nama']) }}" data-status="{{ $data['status'] }}">
                                <td class="py-3 px-4 lg:px-6 text-kasku-muted">{{ $i + 1 }}</td>
                                <td class="py-3 px-4 lg:px-6 text-kasku-text font-medium">
                                    <div class="flex items-center gap-3">
                                        @if($data['foto_profil'])
                                            <img src="{{ asset('storage/' . $data['foto_profil']) }}" alt="{{ $data['nama'] }}" class="w-8 h-8 rounded-full object-cover shrink-0">
                                        @else
                                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold text-white shrink-0" style="background: linear-gradient(135deg, #3B82F6, #1d4ed8);">
                                                {{ strtoupper(substr($data['nama'], 0, 2)) }}
                                            </div>
                                        @endif
                                        {{ $data['nama'] }}
                                    </div>
                                </td>
                                <td class="py-3 px-4 lg:px-6 text-kasku-muted">Rp {{ number_format($data['kas_paid'], 0, ',', '.') }}</td>
                                <td class="py-3 px-4 lg:px-6 text-kasku-muted">Rp {{ number_format($data['tour_paid'], 0, ',', '.') }}</td>
                                <td class="py-3 px-4 lg:px-6 text-kasku-text font-semibold">Rp {{ number_format($data['total_paid'], 0, ',', '.') }}</td>
                                <td class="py-3 px-4 lg:px-6 {{ $data['sisa_tagihan'] > 0 ? 'text-red-400' : 'text-kasku-muted' }}">
                                    Rp {{ number_format($data['sisa_tagihan'], 0, ',', '.') }}
                                </td>
                                <td class="py-3 px-4 lg:px-6">
                                    @if($data['status'] === 'Lunas')
                                        <span class="badge-lunas">Lunas</span>
                                    @else
                                        <span class="badge-belum">Belum Lunas</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-kasku-muted">
                                    <div class="flex flex-col items-center gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="opacity-40"><circle cx="12" cy="12" r="10"/><path d="M12 8v4"/><path d="M12 16h.01"/></svg>
                                        <p>Belum ada data pembayaran.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Table Footer --}}
            <div class="p-4 lg:p-6 border-t border-kasku-border flex items-center justify-between text-sm text-kasku-muted">
                <span>Menampilkan <span id="row-count">{{ $monitoringData->count() }}</span> dari {{ $monitoringData->count() }} anggota</span>
                <a href="{{ url('/') }}#monitoring" class="text-kasku-accent hover:text-kasku-accent-light transition-colors font-medium">
                    ← Kembali ke Beranda
                </a>
            </div>
        </div>
    </main>

    <script>
        function filterTable(query) {
            const rows = document.querySelectorAll('.monitoring-row');
            const statusFilter = document.getElementById('filter-status').value;
            let visible = 0;
            rows.forEach(row => {
                const name   = row.getAttribute('data-name');
                const status = row.getAttribute('data-status');
                const matchName   = name.includes(query.toLowerCase());
                const matchStatus = !statusFilter || status === statusFilter;
                if (matchName && matchStatus) { row.style.display = ''; visible++; }
                else { row.style.display = 'none'; }
            });
            document.getElementById('row-count').textContent = visible;
        }
        function filterByStatus(status) {
            const query = document.getElementById('search-member-all').value;
            const rows  = document.querySelectorAll('.monitoring-row');
            let visible = 0;
            rows.forEach(row => {
                const name   = row.getAttribute('data-name');
                const s      = row.getAttribute('data-status');
                const matchName   = name.includes(query.toLowerCase());
                const matchStatus = !status || s === status;
                if (matchName && matchStatus) { row.style.display = ''; visible++; }
                else { row.style.display = 'none'; }
            });
            document.getElementById('row-count').textContent = visible;
        }
    </script>

</body>
</html>
