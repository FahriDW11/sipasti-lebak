<!DOCTYPE html>
<html lang="id" data-theme="mytheme">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SIPENTA — Sistem Informasi Pemantauan Tahanan</title>

    {{-- DaisyUI + Tailwind --}}
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet" />

    <style>
        /* ── Custom Theme ── */
        [data-theme="mytheme"] {
            --color-base-100: #0d1117;
            --color-base-200: #161b22;
            --color-base-300: #1e2530;
            --color-base-content: #cdd9e5;
            --color-primary: #e8a020;
            --color-primary-content: #0d1117;
            --color-secondary: #2d4263;
            --color-accent: #c0392b;
            --color-neutral: #1e2530;
            --color-neutral-content: #cdd9e5;
            --color-info: #3a7bd5;
            --color-success: #2ecc71;
            --color-warning: #f39c12;
            --color-error: #e74c3c;
        }

        :root {
            --font-display: 'Bebas Neue', sans-serif;
            --font-body: 'DM Sans', sans-serif;
        }

        * { font-family: var(--font-body); }

        h1, h2, h3, .font-display { font-family: var(--font-display); }

        /* ── Noise texture overlay ── */
        body {
            background-color: #0d1117;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
            opacity: 0.4;
        }

        /* ── Diagonal accent bar ── */
        .diagonal-bar {
            position: absolute;
            width: 3px;
            height: 120px;
            background: linear-gradient(to bottom, #e8a020, transparent);
            transform: rotate(15deg);
        }

        /* ── Hero grid background ── */
        .hero-grid {
            background-image:
                linear-gradient(rgba(232, 160, 32, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(232, 160, 32, 0.04) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        /* ── Glow orbs ── */
        .glow-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            pointer-events: none;
        }

        .glow-amber {
            width: 500px;
            height: 500px;
            background: rgba(232, 160, 32, 0.12);
            top: -100px;
            right: -150px;
        }

        .glow-blue {
            width: 400px;
            height: 400px;
            background: rgba(45, 66, 99, 0.25);
            bottom: -80px;
            left: -100px;
        }

        /* ── Search input focus glow ── */
        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(232, 160, 32, 0.25), 0 0 30px rgba(232, 160, 32, 0.1);
            outline: none;
        }

        /* ── Vertical ticker ── */
        .ticker-wrap {
            overflow: hidden;
            height: 28px;
        }

        .ticker-inner {
            animation: ticker-up 12s linear infinite;
        }

        @keyframes ticker-up {
            0%   { transform: translateY(0); }
            100% { transform: translateY(-50%); }
        }

        /* ── Stagger fade-in ── */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeUp 0.7s ease forwards;
        }
        .fade-in:nth-child(1) { animation-delay: 0.1s; }
        .fade-in:nth-child(2) { animation-delay: 0.25s; }
        .fade-in:nth-child(3) { animation-delay: 0.4s; }
        .fade-in:nth-child(4) { animation-delay: 0.55s; }

        @keyframes fadeUp {
            to { opacity: 1; transform: translateY(0); }
        }

        /* ── Stat card hover ── */
        .stat-card {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(232, 160, 32, 0.12);
        }

        /* ── Search button pulse ── */
        .search-btn {
            position: relative;
            overflow: hidden;
        }
        .search-btn::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(255,255,255,0.15);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }
        .search-btn:hover::after {
            transform: scaleX(1);
        }

        /* ── Divider ornament ── */
        .divider-ornament::before,
        .divider-ornament::after {
            background-color: rgba(232, 160, 32, 0.25) !important;
        }

        /* ── Badge pulse ── */
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }
        .pulse-dot {
            animation: pulse-dot 1.8s ease-in-out infinite;
        }
    </style>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        amber: { DEFAULT: '#e8a020' },
                        navy:  { DEFAULT: '#2d4263' },
                    }
                }
            }
        }
    </script>
</head>

<body class="min-h-screen text-base-content">

{{-- ════════════════════════════════════════
     NAVBAR
════════════════════════════════════════ --}}
<div class="navbar bg-base-100/80 backdrop-blur-md border-b border-white/5 sticky top-0 z-50 px-6">
    <div class="navbar-start gap-3">
        {{-- Logo mark --}}
        <div class="flex items-center gap-2">
            <div class="relative w-9 h-9">
                <div class="w-full h-full bg-[#e8a020] rotate-12 rounded-sm absolute"></div>
                <div class="w-full h-full bg-base-200 rounded-sm absolute flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#e8a020]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
            </div>
            <span class="font-display text-xl tracking-widest text-white">SIPENTA</span>
        </div>
    </div>

    <div class="navbar-center hidden md:flex">
        <ul class="menu menu-horizontal gap-1 text-sm font-medium">
            <li><a href="#" class="rounded-lg hover:bg-white/5 hover:text-[#e8a020] transition-colors">Beranda</a></li>
            <li><a href="#" class="rounded-lg hover:bg-white/5 hover:text-[#e8a020] transition-colors">Cara Pencarian</a></li>
            <li><a href="#" class="rounded-lg hover:bg-white/5 hover:text-[#e8a020] transition-colors">Kontak</a></li>
        </ul>
    </div>

    <div class="navbar-end gap-3">
        <div class="flex items-center gap-2 text-xs text-base-content/50">
            <span class="w-2 h-2 rounded-full bg-success pulse-dot inline-block"></span>
            Sistem Aktif
        </div>
        <a href="#" class="btn btn-sm btn-outline border-[#e8a020]/40 text-[#e8a020] hover:bg-[#e8a020] hover:text-base-100 transition-all">
            Masuk
        </a>
    </div>
</div>


{{-- ════════════════════════════════════════
     HERO
════════════════════════════════════════ --}}
<section class="relative min-h-[88vh] flex items-center hero-grid overflow-hidden">

    {{-- Glow orbs --}}
    <div class="glow-orb glow-amber"></div>
    <div class="glow-orb glow-blue"></div>

    {{-- Decorative vertical lines --}}
    <div class="diagonal-bar absolute left-16 top-20 opacity-60"></div>
    <div class="diagonal-bar absolute right-32 bottom-28 opacity-30 rotate-[-15deg]"></div>

    {{-- Left accent column --}}
    <div class="absolute left-0 top-0 h-full w-1 bg-gradient-to-b from-transparent via-[#e8a020]/30 to-transparent hidden xl:block"></div>

    <div class="container mx-auto px-6 py-24 relative z-10">
        <div class="max-w-3xl mx-auto text-center">

            {{-- Eyebrow badge --}}
            <div class="fade-in inline-flex items-center gap-2 mb-8">
                <div class="badge badge-outline border-[#e8a020]/40 text-[#e8a020] gap-2 px-4 py-3 text-xs font-medium tracking-widest uppercase">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#e8a020] pulse-dot"></span>
                    Pemantauan Resmi
                </div>
            </div>

            {{-- Headline --}}
            <h1 class="fade-in font-display text-6xl md:text-8xl leading-none tracking-wide text-white mb-4">
                SISTEM INFORMASI<br/>
                <span class="text-[#e8a020]">TAHANAN</span>
            </h1>

            {{-- Subheadline --}}
            <p class="fade-in text-base-content/60 text-lg md:text-xl max-w-xl mx-auto mb-12 leading-relaxed font-light">
                Pantau kegiatan dan perkembangan tahanan secara transparan.<br/>
                Informasi terpercaya untuk keluarga yang peduli.
            </p>

            {{-- ── SEARCH BAR ── --}}
            <div class="fade-in w-full max-w-2xl mx-auto">
                <form action="{{ route('tahanan.search') }}" method="GET">
                    @csrf
                    <div class="relative flex items-stretch gap-0 rounded-2xl overflow-hidden border border-white/10 bg-base-200/60 backdrop-blur-sm shadow-2xl focus-within:border-[#e8a020]/40 transition-all duration-300">

                        {{-- Search icon --}}
                        <div class="flex items-center pl-5 pr-3 text-base-content/40">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                            </svg>
                        </div>

                        {{-- Input --}}
                        <input
                            type="text"
                            name="nama"
                            id="search-nama"
                            placeholder="Masukkan nama lengkap tahanan…"
                            value="{{ request('nama') }}"
                            class="search-input flex-1 bg-transparent py-5 pr-4 text-white placeholder-base-content/30 text-base focus:outline-none"
                            autocomplete="off"
                        />

                        {{-- Divider --}}
                        <div class="my-3 w-px bg-white/10"></div>

                        {{-- Button --}}
                        <button type="submit" class="search-btn m-2 btn bg-[#e8a020] hover:bg-[#e8a020]/90 border-none text-base-100 font-semibold tracking-wide px-8 rounded-xl text-sm transition-all">
                            Cari Tahanan
                        </button>
                    </div>

                    {{-- Helper text --}}
                    <p class="mt-4 text-xs text-base-content/35 tracking-wide">
                        Contoh pencarian: <span class="text-base-content/55 italic">Budi Santoso</span> &nbsp;·&nbsp; <span class="text-base-content/55 italic">Ahmad Fauzi</span>
                    </p>
                </form>
            </div>
            {{-- ── END SEARCH BAR ── --}}

        </div>
    </div>

    {{-- Bottom fade --}}
    <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-base-100 to-transparent pointer-events-none"></div>
</section>


{{-- ════════════════════════════════════════
     STAT CARDS
════════════════════════════════════════ --}}
<section class="relative z-10 -mt-8 pb-20">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-4xl mx-auto">

            {{-- Stat 1 --}}
            <div class="stat-card card bg-base-200 border border-white/5 p-6 rounded-2xl">
                <div class="flex items-start justify-between mb-3">
                    <span class="text-xs text-base-content/40 uppercase tracking-widest">Total Tahanan</span>
                    <div class="w-8 h-8 rounded-lg bg-[#e8a020]/10 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#e8a020]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="font-display text-4xl text-white tracking-wide">1.248</div>
                <div class="text-xs text-success mt-1 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                    3.2% dari bulan lalu
                </div>
            </div>

            {{-- Stat 2 --}}
            <div class="stat-card card bg-base-200 border border-white/5 p-6 rounded-2xl">
                <div class="flex items-start justify-between mb-3">
                    <span class="text-xs text-base-content/40 uppercase tracking-widest">Kegiatan Tercatat</span>
                    <div class="w-8 h-8 rounded-lg bg-info/10 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-info" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                </div>
                <div class="font-display text-4xl text-white tracking-wide">8.493</div>
                <div class="text-xs text-base-content/40 mt-1">Data diperbarui setiap hari</div>
            </div>

            {{-- Stat 3 --}}
            <div class="stat-card card bg-base-200 border border-white/5 p-6 rounded-2xl">
                <div class="flex items-start justify-between mb-3">
                    <span class="text-xs text-base-content/40 uppercase tracking-widest">Pencarian Hari Ini</span>
                    <div class="w-8 h-8 rounded-lg bg-success/10 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="font-display text-4xl text-white tracking-wide">342</div>
                <div class="text-xs text-base-content/40 mt-1 flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-success pulse-dot inline-block"></span>
                    Realtime
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ════════════════════════════════════════
     HOW IT WORKS
════════════════════════════════════════ --}}
<section class="py-20 border-t border-white/5 relative overflow-hidden">
    <div class="glow-orb w-96 h-96 bg-[#2d4263]/20 absolute -right-40 top-10 blur-[100px] pointer-events-none"></div>

    <div class="container mx-auto px-6 max-w-5xl relative z-10">

        <div class="text-center mb-16">
            <p class="text-xs text-[#e8a020] tracking-[0.3em] uppercase mb-3">Panduan</p>
            <h2 class="font-display text-4xl md:text-5xl text-white tracking-wide">CARA PENGGUNAAN</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">

            {{-- Connector line (desktop) --}}
            <div class="hidden md:block absolute top-8 left-1/6 right-1/6 h-px bg-gradient-to-r from-transparent via-[#e8a020]/20 to-transparent" style="left:16.66%;right:16.66%"></div>

            {{-- Step 1 --}}
            <div class="flex flex-col items-center text-center gap-4">
                <div class="relative">
                    <div class="w-16 h-16 rounded-2xl bg-base-200 border border-white/10 flex items-center justify-center z-10 relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-[#e8a020]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                        </svg>
                    </div>
                    <div class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-[#e8a020] text-base-100 font-display text-sm flex items-center justify-center">1</div>
                </div>
                <h3 class="font-semibold text-white text-base">Masukkan Nama</h3>
                <p class="text-sm text-base-content/50 leading-relaxed">Ketik nama lengkap tahanan yang ingin Anda cari pada kolom pencarian di atas.</p>
            </div>

            {{-- Step 2 --}}
            <div class="flex flex-col items-center text-center gap-4">
                <div class="relative">
                    <div class="w-16 h-16 rounded-2xl bg-base-200 border border-white/10 flex items-center justify-center z-10 relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-[#e8a020]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-[#e8a020] text-base-100 font-display text-sm flex items-center justify-center">2</div>
                </div>
                <h3 class="font-semibold text-white text-base">Pilih Tahanan</h3>
                <p class="text-sm text-base-content/50 leading-relaxed">Pilih tahanan yang sesuai dari daftar hasil pencarian yang ditampilkan sistem.</p>
            </div>

            {{-- Step 3 --}}
            <div class="flex flex-col items-center text-center gap-4">
                <div class="relative">
                    <div class="w-16 h-16 rounded-2xl bg-base-200 border border-white/10 flex items-center justify-center z-10 relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-[#e8a020]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <div class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-[#e8a020] text-base-100 font-display text-sm flex items-center justify-center">3</div>
                </div>
                <h3 class="font-semibold text-white text-base">Lihat Kegiatan</h3>
                <p class="text-sm text-base-content/50 leading-relaxed">Pantau seluruh kegiatan, jadwal, dan perkembangan tahanan secara lengkap dan transparan.</p>
            </div>
        </div>
    </div>
</section>


{{-- ════════════════════════════════════════
     INFO BANNER
════════════════════════════════════════ --}}
<section class="py-6 border-t border-white/5">
    <div class="container mx-auto px-6 max-w-5xl">
        <div class="alert bg-[#e8a020]/8 border border-[#e8a020]/20 rounded-2xl flex-col sm:flex-row gap-4 items-start sm:items-center px-6 py-5">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#e8a020] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div class="flex-1">
                <p class="font-medium text-white text-sm">Akses Terbatas untuk Keluarga</p>
                <p class="text-xs text-base-content/50 mt-0.5">Layanan ini hanya menampilkan informasi kegiatan resmi. Data bersifat rahasia dan hanya dapat diakses oleh keluarga yang telah terverifikasi.</p>
            </div>
            <a href="#" class="btn btn-sm btn-ghost text-[#e8a020] border border-[#e8a020]/30 hover:bg-[#e8a020]/10 text-xs whitespace-nowrap rounded-xl">
                Pelajari Lebih
            </a>
        </div>
    </div>
</section>


{{-- ════════════════════════════════════════
     FOOTER
════════════════════════════════════════ --}}
<footer class="border-t border-white/5 mt-12 py-10">
    <div class="container mx-auto px-6 max-w-5xl">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">

            {{-- Logo --}}
            <div class="flex items-center gap-3">
                <div class="relative w-8 h-8">
                    <div class="w-full h-full bg-[#e8a020] rotate-12 rounded-sm absolute opacity-60"></div>
                    <div class="w-full h-full bg-base-200 rounded-sm absolute flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#e8a020]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <div class="font-display text-lg tracking-widest text-white">SIPENTA</div>
                    <div class="text-xs text-base-content/35">Sistem Informasi Pemantauan Tahanan</div>
                </div>
            </div>

            {{-- Links --}}
            <div class="flex items-center gap-6 text-xs text-base-content/40">
                <a href="#" class="hover:text-[#e8a020] transition-colors">Kebijakan Privasi</a>
                <a href="#" class="hover:text-[#e8a020] transition-colors">Syarat & Ketentuan</a>
                <a href="#" class="hover:text-[#e8a020] transition-colors">Kontak</a>
            </div>

            {{-- Copyright --}}
            <p class="text-xs text-base-content/25">
                &copy; {{ date('Y') }} Kementerian Hukum & HAM
            </p>
        </div>
    </div>
</footer>

</body>
</html>
