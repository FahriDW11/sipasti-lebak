@extends('layouts.admin', [
    'active' => 'kegiatan',
    'title' => 'Daftar Kegiatan'
])

@section('admin-content')

<!-- Bagian Atas -->
<div class="flex items-center justify-between mb-4"> 
    <!-- Form Pencarian -->
    <form action="{{ route('admin.kegiatan.index') }}" method="GET">
        <div class="flex gap-2">
            <input type="search" name="search" placeholder="Cari kegiatan..." value="{{ request('search') }}" class="input input-bordered input-sm w-full max-w-xs" />
            <button type="submit" class="btn btn-sm btn-primary text-xs tooltip tooltip-left" data-tip="Cari kegiatan">
                <x-lucide-search class="w-4 lg:w-6 text-white" />
            </button>
        </div>
    </form>
    <!-- Tombol Tambah -->
    <a href="{{ route('admin.kegiatan.create') }}" class="btn btn-primary btn-sm text-xs tooltip tooltip-left" data-tip="Tambah Kegiatan">
        <x-lucide-plus class="w-4 lg:w-6 text-white" />
    </a>
</div>

<!-- Bagian isi -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Kartu Kegiatan -->
    <!-- looping data kegiatan jadi kartu -->
    @forelse($kegiatans as $kegiatan)
        <div class="card bg-base-100 image-full shadow-sm w-full h-55">
            <figure>
                <img src="{{ $kegiatan->photo ? asset('storage/' . $kegiatan->photo) : asset('storage/images/default-image.jpg') }}" alt="{{ $kegiatan->nama }}"
                class="w-full h-full object-cover object-center">
            </figure>
            <div class="card-body">
                <h2 class="card-title">{{ $kegiatan->nama }}</h2>
                <p>{{ Str::limit($kegiatan->deskripsi, 100) }}</p>
                <div class="card-actions justify-end">
                    <a href="{{ route('admin.kegiatan.show', $kegiatan->id) }}" class="btn btn-sm btn-info"><x-lucide-eye class="w-4 lg:w-6 text-white" /></a>
                    <a href="{{ route('admin.kegiatan.edit', $kegiatan->id) }}" class="btn btn-sm btn-warning"><x-lucide-edit class="w-4 lg:w-6 text-white" /></a>
                    <button type="button" onclick="openDeleteModal('{{ route('admin.kegiatan.destroy', $kegiatan->id) }}', '{{ $kegiatan->nama }}')" class="btn btn-sm btn-error">
                        <x-lucide-trash class="w-4 lg:w-6 text-white" />
                    </button>
                </div>
            </div>
        </div>
    @empty
        <!-- kalau data kosong kasih info -->
        <div class="alert alert-info shadow-lg col-span-full">
            <x-lucide-info class="w-4 lg:w-6 text-white" />
            <span>Tidak ada kegiatan yang ditemukan.</span>
        </div>
    @endforelse
</div>
@include('layouts.partials.pagination',['datas'=>$kegiatans])


@endsection