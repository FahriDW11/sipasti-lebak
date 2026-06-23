@extends('layouts.admin', [
    'active' => 'kegiatan',
    'title' => $kegiatan->nama
])

@section('admin-content')

<div class="flex flex-col items-center gap-4 mb-4">
    <a class="btn btn-accent self-start" href="{{ route('admin.kegiatan.index') }}">
        <x-lucide-arrow-left class="w-4 lg:w-6 text-white"/>
    </a>

    <div class="w-full max-w-lg h-70 overflow-hidden rounded-lg">
        <img src="{{ $kegiatan->photo ? asset('storage/' . $kegiatan->photo) : asset('storage/images/default-image.jpg') }}" alt="{{ $kegiatan->nama }}"
        class="w-full h-full object-cover object-center">
    </div>

    <!-- isi data -->
    <div class="w-full max-w-lg text-center">
        <h2 class="text-xl font-bold mb-2">{{ $kegiatan->nama }}</h2>
        <p class="text-base-content/70">{{ $kegiatan->deskripsi }}</p>
    </div>
</div>

<div class="divider"></div>

<div class="w-full mt-6">
    <h3 class="text-lg font-semibold mx-4">Log Kegiatan</h3>
    <table class="table table-sm mt-2 md:table-md">
        <tr>
            <th>Nama Warga Binaan</th>
            <th>Tanggal Kegiatan</th>
        </tr>
        @forelse($kegiatan->log_kegiatans->sortByDesc('tanggal')->take(15) as $log)
        <tr>
            <td>{{ $log->napi->nama }}</td>
            <td>{{ $log->tanggal_format }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="2" class="text-center">Belum ada warga binaan yang mengikuti kegiatan ini.</td>
        </tr>
        @endforelse
    </table>
</div>






@endsection