<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pembayaran Berhasil - KASKU</title>
    <meta name="description" content="Konfirmasi pembayaran berhasil.">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        @keyframes checkmark-draw {
            from { stroke-dashoffset: 100; }
            to   { stroke-dashoffset: 0;   }
        }
        @keyframes circle-expand {
            from { transform: scale(0); opacity: 0; }
            to   { transform: scale(1); opacity: 1; }
        }
        @keyframes fade-up {
            from { transform: translateY(20px); opacity: 0; }
            to   { transform: translateY(0);    opacity: 1; }
        }
        .success-circle {
            animation: circle-expand 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
        }
        .checkmark-path {
            stroke-dasharray: 100;
            stroke-dashoffset: 100;
            animation: checkmark-draw 0.6s ease 0.4s both;
        }
        .success-card {
            animation: fade-up 0.6s ease 0.2s both;
        }
        .success-content {
            animation: fade-up 0.6s ease 0.5s both;
        }
        .success-actions {
            animation: fade-up 0.6s ease 0.7s both;
        }
        .particle {
            position: absolute;
            border-radius: 50%;
            animation: float-particle 3s ease infinite;
        }
        @keyframes float-particle {
            0%, 100% { transform: translateY(0) scale(1); opacity: 0.6; }
            50%       { transform: translateY(-20px) scale(1.2); opacity: 1; }
        }
    </style>
</head>
<body class="antialiased min-h-screen flex items-center justify-center relative overflow-hidden" style="background-color: #020617;">

    {{-- Background Glows --}}
    <div class="hero-glow -top-20 -left-40"></div>
    <div class="hero-glow-gold top-1/3 -right-20"></div>

    {{-- Floating particles --}}
    <div class="particle w-2 h-2 bg-green-400/50" style="top:15%;left:10%;animation-delay:0s;"></div>
    <div class="particle w-1.5 h-1.5 bg-kasku-accent/40" style="top:25%;right:15%;animation-delay:0.5s;"></div>
    <div class="particle w-3 h-3 bg-green-300/30" style="top:60%;left:8%;animation-delay:1s;"></div>
    <div class="particle w-1 h-1 bg-blue-400/60" style="bottom:20%;right:10%;animation-delay:1.5s;"></div>
    <div class="particle w-2 h-2 bg-kasku-accent/50" style="bottom:35%;left:20%;animation-delay:0.8s;"></div>

    <div class="w-full max-w-md px-6 py-12 relative z-10">

        {{-- Logo --}}
        <div class="flex justify-center mb-10">
            <a href="/">
                <img src="{{ asset('images/logo_kas.png') }}" alt="KASKU Logo" class="h-12 w-auto">
            </a>
        </div>

        <div class="glass-card rounded-2xl p-10 text-center shadow-2xl success-card">

            {{-- Success Icon --}}
            <div class="flex justify-center mb-6">
                <div class="relative">
                    {{-- Outer glow ring --}}
                    <div class="w-28 h-28 rounded-full absolute -inset-2 opacity-20 blur-xl" style="background: radial-gradient(circle, #4ade80, transparent);"></div>
                    {{-- Circle --}}
                    <div class="w-24 h-24 rounded-full flex items-center justify-center success-circle" style="background: linear-gradient(135deg, rgba(74,222,128,0.2), rgba(21,128,61,0.1)); border: 2px solid rgba(74,222,128,0.5);">
                        <svg width="48" height="48" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="checkmark-path" d="M12 26L21 35L38 16" stroke="#4ade80" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Text --}}
            <div class="success-content">
                <h1 class="text-2xl font-extrabold text-white mb-2">Pembayaran Berhasil!</h1>
                <p class="text-kasku-muted text-sm leading-relaxed max-w-xs mx-auto">
                    @if(session('status'))
                        {{ session('status') }}
                    @else
                        Pembayaran Anda telah berhasil dicatat. Terima kasih telah membayar tepat waktu.
                    @endif
                </p>
            </div>

            {{-- Divider --}}
            <div class="border-t border-white/10 my-8"></div>

            {{-- Info box --}}
            <div class="bg-green-500/10 border border-green-500/20 rounded-xl p-4 mb-8">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-green-500/20 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4ade80" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <div class="text-left">
                        <p class="text-green-400 text-sm font-semibold">Pembayaran Tercatat</p>
                        <p class="text-green-400/70 text-xs mt-0.5">Data pembayaran Anda telah tersimpan di sistem.</p>
                    </div>
                </div>
            </div>

            {{-- Action buttons --}}
            <div class="flex flex-col gap-3 success-actions">
                <a href="{{ url('/') }}" id="btn-back-home" class="btn-gold w-full justify-center py-3 text-sm font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    Kembali ke Beranda
                </a>
                <a href="{{ route('profile') }}" id="btn-view-profile" class="btn-outline w-full justify-center py-3 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Lihat Profil Saya
                </a>
            </div>

            {{-- Pay again links --}}
            <div class="mt-6 flex justify-center gap-4 text-xs text-kasku-muted">
                <a href="{{ route('payment.kas') }}" class="hover:text-kasku-accent transition-colors">Bayar Kas Lagi</a>
                <span class="text-white/20">|</span>
                <a href="{{ route('payment.tour') }}" class="hover:text-kasku-accent transition-colors">Bayar Study Tour Lagi</a>
            </div>
        </div>
    </div>

</body>
</html>
