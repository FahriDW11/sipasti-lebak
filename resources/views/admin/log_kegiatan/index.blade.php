@extends('layouts.admin', [
    'active' => 'log-kegiatan',
    'title' => 'Data Log Kegiatan'
])

@section('admin-content')

<div class="flex items-center justify-between mb-4"> 
    <form action="{{ route('admin.log-kegiatan.index') }}" method="GET">
        <div class="flex gap-2">
            <input type="search" name="search" placeholder="Cari Log Kegiatan..." value="{{ request('search') }}" class="input input-bordered input-sm w-full max-w-xs" />
            <button type="submit" class="btn btn-sm btn-primary text-xs tooltip tooltip-left" data-tip="Cari Log Kegiatan">
                <x-lucide-search class="w-4 lg:w-6 text-white" />
            </button>
        </div>
    </form>
</div>

<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
    <table class="table">
        <tr>
            <th>Warga Binaan</th>
            <th>Kegiatan</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
        @forelse($logs as $log)
        <tr>
            <td class="truncate w-full max-w-xs">{{ $log->napi->nama }} bin {{ $log->napi->nama_ayah }}</td>
            <td>{{ $log->kegiatan->nama }}</td>
            <td class="whitespace-nowrap">{{ $log->tanggal_format }}</td>
            <td>
                <div class="flex gap-1 justify-end">
                    <a href="{{ route('admin.log-kegiatan.show', $log->id) }}" class="btn btn-sm btn-info rounded-xl">
                        <x-lucide-eye class="w-4 text-white" />
                    </a>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center">Tidak Ada Data Log Kegiatan.</td>
        </tr>
        @endforelse
    </table>
</div>
@include('layouts.partials.pagination',['datas'=>$logs])

@endsection