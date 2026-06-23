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

@error('tglahir')
    <div class="alert alert-error shadow-lg mb-4">
        <x-lucide-x-circle class="w-4 lg:w-6 text-white" />
        <span>{{ $message }}</span>
    </div>
@enderror

<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100 w-full max-w-5xl mx-auto my-6">
    <table class="table">
        <tr>
            <th>Foto</th>
            <th>Nama</th>
            <th>Aksi</th>
        </tr>
        @forelse($napis as $napi)
        <tr>
            <td>
                <div class="avatar">
                    <div class="w-16 rounded">
                        <img src="{{ $napi->photo ? asset('storage/' . $napi->photo) : asset('storage/images/default-avatar.png') }}" alt="{{ $napi->nama }}">
                    </div>
                </div>
            </td>
            <td class="truncate w-full max-w-xs">{{ $napi->nama }} bin {{ $napi->nama_ayah }}</td>
            <td>
                <div class="flex gap-0.5 justify-end">
                    <button type="button" onclick="openValidateModal('{{ route('search.detail', ['id' => $napi->id]) }}')" class="btn btn-sm btn-success">
                        <x-lucide-eye class="w-4 lg:w-6 text-white" />
                    </button>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">Tidak Ada Data Narapidana.</td>
        </tr>
        @endforelse
    </table>
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
                    <div class="text-xs text-base-content/35">Sistem Informasi Pemasyarakatan dan Status Narapidana Indonesia Rangkasbitung</div>
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






<!-- modal -->
 <dialog id="validateModal" class="modal overflow-auto">
    <div class="modal-box overflow-visible">
        <h3 class="font-bold text-lg text-success">Validasi Narapidana</h3>
        
        <form method="POST" id="form-validate" action="">
            @csrf
            @method('POST')

            <p class="py-4">Masukkan tanggal lahir untuk memvalidasi data narapidana.</p>            
            <input type="text" id="my-datepicker" class="input input-bordered w-full max-w-xs text-base-content" placeholder="Tanggal Lahir Narapidana" name="tglahir" required />
            
            <div class="modal-action">
                <button type="button" class="btn" onclick="document.getElementById('validateModal').close()">Batal</button>
                <button type="submit" class="btn btn-success">Validasi</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>


<script>
    function openValidateModal(action) {
        const form = document.getElementById('form-validate');
        
        form.action = action;
        
        // 4. Munculkan modal DaisyUI
        document.getElementById('validateModal').showModal();
    }
</script>

@endsection