@extends('layouts.app')

@section('content')
{{-- ════════════════════════════════════════
     NAVBAR
════════════════════════════════════════ --}}
<div class="bg-gradient-to-b from-[#1a1a1a] to-[#111111] min-h-screen">
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
            <span class="font-display text-xl tracking-widest text-white">{{ env('APP_NAME') }}</span>
        </div>
    </div>

    <div class="navbar-center hidden md:flex">
        <ul class="menu menu-horizontal gap-1 text-sm font-medium">
            <li><a href="/" class="rounded-lg hover:bg-white/5 hover:text-[#e8a020] transition-colors">Beranda</a></li>
            <li><a href="/#steps" class="rounded-lg hover:bg-white/5 hover:text-[#e8a020] transition-colors">Cara Pencarian</a></li>
            <li><a href="/#contact" class="rounded-lg hover:bg-white/5 hover:text-[#e8a020] transition-colors">Kontak</a></li>
        </ul>
    </div>

    <div class="navbar-end gap-3">
        <div class="flex items-center gap-2 text-xs text-base-content/50">
            <span class="w-2 h-2 rounded-full bg-success pulse-dot inline-block"></span>
            Sistem Aktif
        </div>
        <a href="{{ route('login') }}" class="btn btn-sm btn-outline border-[#e8a020]/40 text-[#e8a020] hover:bg-[#e8a020] hover:text-base-100 transition-all">
            Masuk
        </a>
    </div>
</div>

<!-- content -->
<div class="container mx-auto px-6 max-w-5xl">
    <h1 class="font-display text-3xl text-white mt-8 mb-4">Statistik Kegiatan Tahanan</h1>

<!-- data napi -->
 <!-- foto -->
 @if($napi->photo)
    <div class="flex justify-center mb-4">
        <img src="{{ asset('storage/' . $napi->photo) }}" alt="Foto Tahanan" class="w-32 h-32 object-cover rounded-lg border border-base-content/5">
    </div>
 @endif
 <table class="table w-full max-w-lg mx-auto">
    <tr>
        <th>Nama Tahanan</th>
        <td>{{ $napi->nama }}</td>
    </tr>
    <tr>
        <th>Nama Ayah</th>
        <td>{{ $napi->nama_ayah }}</td>
    </tr>
    <tr>
        <th>Jenis Kelamin</th>
        <td>{{ $napi->jenis_kelamin_format }}</td>
    </tr>
    <tr>
        <th>Tanggal Lahir</th>
        <td>{{ $napi->tgl_lahir_format }}</td>
    </tr>
 </table>


@include('layouts.components.chart', [
    'chartId' => 'logKegiatan-chart',
    'chartTitle' => 'Statistik Kegiatan Tahanan Tahun ' . date('Y'),
    'chartData' => $chartData
])

<!-- list log kegiatan -->
<div class="mt-8">
    <h2 class="font-display text-2xl text-white mb-4">Log Kegiatan Tahanan</h2>
    <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100 w-full">
        <table class="table">
            <tr>
                <th>Tanggal</th>
                <th>Kegiatan</th>
                <th>Catatan</th>
            </tr>
            @forelse($logKegiatan as $log)
            <tr>
                <td>{{ $log->tanggal_format }}</td>
                <td>{{ $log->kegiatan->nama }}</td>
                <td>{{ $log->catatan }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center text-base-content/50">Tidak ada log kegiatan untuk narapidana ini.</td>
            </tr>
            @endforelse
        </table>
    </div>
</div>


</div>




{{-- ════════════════════════════════════════
     FOOTER
════════════════════════════════════════ --}}
<footer class="border-t border-white/5 mt-12 py-10 self-end">
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
                    <div class="font-display text-lg tracking-widest text-white">SIPASTI RANGKASBITUNG</div>
                    <div class="text-xs text-base-content/35">Sistem Informasi Pemasyarakatan dan Status Tahanan Indonesia Rangkasbitung</div>
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
                &copy; {{ date('Y') }} kementerian imigrasi dan pemasyarakatan. All rights reserved.
            </p>
        </div>
    </div>
</footer>
</div>


<script>
    // ganti theme
        document.documentElement.setAttribute('data-theme', 'mytheme');
</script>
@endsection
